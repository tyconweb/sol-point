<?php

namespace App\Http\Controllers;

use App\Payroll;
use App\User;
use Illuminate\Http\Request;

class PayrollController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$employees = User::query()
			->leftjoin('designations as designations', 'users.designation_id', '=', 'designations.id')
			->orderBy('users.name', 'ASC')
			->where('users.access_label', '>=', 2)
			->where('users.access_label', '<=', 3)
			->get(['designations.designation', 'users.name', 'users.id','users.father_name'])
			->toArray();

		return view('administrator.hrm.payroll.manage_salary', compact('employees'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function go(Request $request) {
		request()->validate([
			'user_id' => 'required',
		], [
			'user_id.required' => 'The employee name field is required',
		]);
		return redirect('/hrm/payroll/manage-salary/' . $request->user_id);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create($user_id) {
		$employee_id = $user_id;

		$employees = User::query()
			->leftjoin('designations as designations', 'users.designation_id', '=', 'designations.id')
			->orderBy('users.name', 'ASC')
			->where('users.access_label', '>=', 2)
			->where('users.access_label', '<=', 3)
			->get(['designations.designation', 'users.name', 'users.id'])
			->toArray();

		$salary = Payroll::where('user_id', $employee_id)
			->first();

		$employeeData = User::where('id',$employee_id)->first();
		// echo "<pre>";print_r($employee['nssf_no']); exit;
		if (!empty($salary)) {
			return view('administrator.hrm.payroll.edit_salary', compact('employees', 'employee_id', 'salary','employeeData'));
		} else {
			return view('administrator.hrm.payroll.create_salary', compact('employees', 'employee_id','employeeData'));
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$salary = request()->validate([
			'employee_type' => 'required',
			'basic_salary' => 'required|numeric',
			'house_rent_allowance' => 'nullable|numeric',
			'medical_allowance' => 'nullable|numeric',
			'special_allowance' => 'nullable|numeric',
			'provident_fund_contribution' => 'nullable|numeric',
			'other_allowance' => 'nullable|numeric',
			'tax_deduction' => 'nullable|numeric',
			'provident_fund_deduction' => 'nullable|numeric',
			'nhif' => 'nullable|numeric',
			'nssf' => 'nullable|numeric',
			'other_deduction' => 'nullable|numeric',
			'taxable_pay' => 'nullable',
			'income_tax' => 'nullable',
			'nhif_relief' => 'nullable',
			'persnol_relief' => 'nullable',
			'paye' => 'nullable',
			'pay_after_tax' => 'nullable',
			'net_pay' => 'nullable',
		]);

		$result = Payroll::create($salary + ['created_by' => auth()->user()->id, 'user_id' => $request->user_id]);
		$inserted_id = $result->id;

		if (!empty($inserted_id)) {
			return redirect('/hrm/payroll/salary-list')->with('message', 'Add successfully.');
		}
		return redirect('/hrm/payroll/salary-list')->with('exception', 'Operation failed !');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function list() {
		$salaries = Payroll::query()
			->leftjoin('users', 'payrolls.user_id', '=', 'users.id')
			->leftjoin('designations', 'users.designation_id', '=', 'designations.id')
			->orderBy('users.name', 'ASC')
			->where('users.deletion_status', 0)
			->get([
				'payrolls.*',
				'users.name',
				'users.mother_name',
				'users.father_name',
				'designations.designation',
			])
			->toArray();
		return view('administrator.hrm.payroll.salary_list', compact('salaries'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Payroll  $payroll
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		$salary = Payroll::query()
			->leftjoin('users', 'payrolls.user_id', '=', 'users.id')
			->leftjoin('designations', 'users.designation_id', '=', 'designations.id')
			->leftjoin('departments', 'designations.department_id', '=', 'departments.id')
			->orderBy('users.name', 'ASC')
			->where('payrolls.id', $id)
			->where('users.deletion_status', 0)
			->first([
				'payrolls.*',
				'users.name',
				'users.avatar',
				'designations.designation',
				'departments.department',
			])
			->toArray();
		return view('administrator.hrm.payroll.salary_details', compact('salary'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Payroll  $payroll
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$salary = Payroll::find($id);
		request()->validate([
			'employee_type' => 'required',
			'basic_salary' => 'required|numeric',
			'house_rent_allowance' => 'nullable|numeric',
			'medical_allowance' => 'nullable|numeric',
			'special_allowance' => 'nullable|numeric',
			'provident_fund_contribution' => 'nullable|numeric',
			'other_allowance' => 'nullable|numeric',
			'tax_deduction' => 'nullable|numeric',
			'provident_fund_deduction' => 'nullable|numeric',
			'other_deduction' => 'nullable|numeric',
			'nhif' => 'nullable|numeric',
			'nssf' => 'nullable|numeric',
			'taxable_pay' => 'nullable',
			'income_tax' => 'nullable',
			'nhif_relief' => 'nullable',
			'persnol_relief' => 'nullable',
			'paye' => 'nullable',
			'pay_after_tax' => 'nullable',
			'net_pay' => 'nullable',
		]);

		$salary->employee_type = $request->get('employee_type');
		$salary->basic_salary = $request->get('basic_salary');
		$salary->house_rent_allowance = $request->get('house_rent_allowance');
		$salary->medical_allowance = $request->get('medical_allowance');
		$salary->special_allowance = $request->get('special_allowance');
		$salary->provident_fund_contribution = $request->get('provident_fund_contribution');
		$salary->other_allowance = $request->get('other_allowance');
		$salary->tax_deduction = $request->get('tax_deduction');
		$salary->provident_fund_deduction = $request->get('provident_fund_deduction');
		$salary->nhif = $request->get('nhif');
		$salary->nssf = $request->get('nssf');
		$salary->other_deduction = $request->get('other_deduction');
		$salary->taxable_pay = $request->get('taxable_pay');
		$salary->income_tax = $request->get('income_tax');
		$salary->nhif_relief = $request->get('nhif_relief');
		$salary->persnol_relief = $request->get('persnol_relief');
		$salary->paye = $request->get('paye');
		$salary->pay_after_tax = $request->get('pay_after_tax');
		$salary->net_pay = $request->get('net_pay');
		$affected_row = $salary->save();

		if (!empty($affected_row)) {
			return redirect('/hrm/payroll/salary-list')->with('message', 'Update successfully.');
		}
		return redirect('/hrm/payroll/salary-list')->with('exception', 'Operation failed !');

		$result = Payroll::create($salary + ['created_by' => auth()->user()->id, 'user_id' => $request->user_id]);
		$inserted_id = $result->id;

		if (!empty($inserted_id)) {
			return redirect('/hrm/payroll/salary-list')->with('message', 'Add successfully.');
		}
		return redirect('/hrm/payroll/salary-list')->with('exception', 'Operation failed !');
	}
}
