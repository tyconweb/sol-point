<?php

namespace App\Http\Controllers;

use App\Designation;
use App\Role;
use App\User;
use App\Department;
use App\Payroll;
use App\Bonus;
use App\Deduction;
use App\Loan;
use App\SalaryPayment;
use DB;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;

class EmplController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		$employees = User::query()
			->join('designations', 'users.designation_id', '=', 'designations.id')
			->whereBetween('users.access_label', [2, 3])
			->where('users.deletion_status', 0)
			->select('employee_id', 'users.*', 'designations.designation')
			->orderBy('users.employee_id', 'ASC')
			->get()
			->toArray();
		return view('administrator.people.employee.manage_employees', compact('employees'));
	}

	public function print() {
		$employees = User::query()
			->join('designations', 'users.designation_id', '=', 'designations.id')
			->whereBetween('users.access_label', [2, 3])
			->where('users.deletion_status', 0)
			->select('users.id', 'users.*', 'designations.designation')
			->orderBy('users.id', 'DESC')
			->get()
			->toArray();
		return view('administrator.people.employee.employees_print', compact('employees'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$designations = Designation::where('deletion_status', 0)
			->where('publication_status', 1)
			->orderBy('designation', 'ASC')
			->select('id', 'designation')
			->get()
			->toArray();
		$roles = Role::all();

		return view('administrator.people.employee.add_employee', compact('designations', 'roles')); 
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//return $request;
		$url = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';

		$employee = request()->validate([
			'employee_id' => 'required|max:250',
			'name' => 'required|max:100',
			'father_name' => 'required|max:100',
			'mother_name' => 'required|max:100',
			'spouse_name' => 'nullable|max:100',
			'email' => 'required|email|unique:users|max:100',
			'contact_no_one' => 'required|max:20',
			'emergency_contact' => 'nullable|max:20',
			'web' => 'nullable|max:150|regex:' . $url,
			'gender' => 'required',
			'date_of_birth' => 'nullable|date',
			'present_address' => 'nullable|max:250',
			'permanent_address' => 'nullable|max:250',
			'home_district' => 'nullable|max:250',
			'academic_qualification' => 'nullable',
			'professional_qualification' => 'nullable',
			'experience' => 'nullable',
			'joining_date' => 'nullable',
			'designation_id' => 'required|numeric',
			'joining_position' => 'required|numeric',
			'marital_status' => 'nullable',
			'id_name' => 'nullable',
			'id_number' => 'nullable|max:100',
			'role' => 'required',
			'password' => 'required',
			'nssf_no' => 'required|numeric',
			'nhif_no' => 'required|numeric',
			'kra_no' => 'required',
			'kin_details_name' => 'required',
			'kin_details_relation' => 'required',
			'kin_details_phone' => 'required',
			'account_name' => 'required',
			'bank_acc_no' => 'required',
			'bank_name' => 'required',
			'bank_branch' => 'required',
			'bank_sort_code' => 'nullable',
			'passport_picture' => 'required',
		], [
			'designation_id.required' => 'The designation field is required.',
			'contact_no_one.required' => 'The contact no field is required.',
			'name.regex' => 'No number is allowed.',
			'web.regex' => 'The URL format is invalid.',
			'access_label' => 'The position field is required.',
		]);
		$passport_picture = time() . '.' . request()->passport_picture->getClientOriginalExtension();
		request()->passport_picture->move(public_path('passport_picture'), $passport_picture);
		unset($employee['password']);
		unset($employee['passport_picture']);
		$result = User::create($employee + ['created_by' => auth()->user()->id, 'access_label' => 2, 'password' => bcrypt($request->password) ,'passport_picture' => $passport_picture]);
		$inserted_id = $result->id;

		$result->attachRole(Role::where('name', $request->role)->first());

		if (!empty($inserted_id)) {
			return redirect('/people/employees/create')->with('message', 'Add successfully.');
		}
		return redirect('/people/employees/create')->with('exception', 'Operation failed !');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function active($id) {
		$affected_row = User::where('id', $id)
			->update(['activation_status' => 1]);

		if (!empty($affected_row)) {
			return redirect('/people/employees')->with('message', 'Activated successfully.');
		}
		return redirect('/people/employees')->with('exception', 'Operation failed !');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function deactive($id) {
		$affected_row = User::where('id', $id)
			->update(['activation_status' => 0]);

		if (!empty($affected_row)) {
			return redirect('/people/employees')->with('message', 'Disabled successfully.');
		}
		return redirect('/people/employees')->with('exception', 'Operation failed !');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//$employee_type = User::find($id)->toArray();
		$employee = DB::table('users')
			->join('designations', 'users.designation_id', '=', 'designations.id')
			->select('users.*', 'designations.designation')
			->where('users.id', $id)
			->first();
		$created_by = User::where('id', $employee->created_by)
			->select('id', 'name')
			->first();
		$designations = Designation::where('deletion_status', 0)
			->select('id', 'designation')
			->get();
		$departments = Department::where('deletion_status', 0)
			->select('id', 'department')
			->get();	
		return view('administrator.people.employee.show_employee', compact('employee', 'created_by', 'designations', 'departments'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function pdf($id) {
		$employee = DB::table('users')
			->join('designations', 'users.designation_id', '=', 'designations.id')
			->select('users.*', 'designations.designation')
			->where('users.id', $id)
			->first();

		$created_by = User::where('id', $employee->created_by)
			->select('id', 'name')
			->first();

		$designations = Designation::where('deletion_status', 0)
			->select('id', 'designation')
			->get();

		$pdf = PDF::loadView('administrator.people.employee.pdf', compact('employee', 'created_by', 'designations'));
		$file_name = 'EMP-' . $employee->id . '.pdf';
		return $pdf->download($file_name);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$employee = User::find($id)->toArray();
		$designations = Designation::where('deletion_status', 0)
			->where('publication_status', 1)
			->orderBy('designation', 'ASC')
			->select('id', 'designation')
			->get()
			->toArray();
		$roles = Role::all();
		return view('administrator.people.employee.edit_employee', compact('employee', 'roles', 'designations'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$employee = User::find($id);

		$url = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';

		request()->validate([
			'employee_id' => 'required|max:250',
			'name' => 'required|max:100',
			'father_name' => 'required|max:100',
			'mother_name' => 'required|max:100',
			'spouse_name' => 'nullable|max:100',
			'email' => 'required|email|max:100',
			'contact_no_one' => 'required|max:20',
			'emergency_contact' => 'nullable|max:20',
			'web' => 'nullable|max:150|regex:' . $url,
			'gender' => 'required',
			'date_of_birth' => 'nullable|date',
			'present_address' => 'nullable|max:250',
			'permanent_address' => 'nullable|max:250',
			'home_district' => 'nullable|max:250',
			'academic_qualification' => 'nullable',
			'professional_qualification' => 'nullable',
			'experience' => 'nullable',
			'reference' => 'nullable',
			'joining_date' => 'nullable',
			'designation_id' => 'required|numeric',
			'joining_position' => 'required|numeric',
			'marital_status' => 'nullable',
			'id_name' => 'nullable',
			'id_number' => 'nullable|max:100',
			'role' => 'required',
			'nssf_no' => 'required|numeric',
			'nhif_no' => 'required|numeric',
			'kra_no' => 'required',
			'kin_details_name' => 'required',
			'kin_details_relation' => 'required',
			'kin_details_phone' => 'required',
			'account_name' => 'required',
			'bank_acc_no' => 'required',
			'bank_name' => 'required',
			'bank_branch' => 'required',
			'bank_sort_code' => 'nullable',
			'passport_picture' => 'nullable',
		], [
			'designation_id.required' => 'The designation field is required.',
			'contact_no_one.required' => 'The contact no field is required.',
			'web.regex' => 'The URL format is invalid.',
			'name.regex' => 'No number is allowed.',
			'access_label' => 'The position field is required.',
		]);

		if (!empty($request->passport_picture)) {
			$passport_picture = time() . '.' . request()->passport_picture->getClientOriginalExtension();
			request()->passport_picture->move(public_path('passport_picture'), $passport_picture);
		} else {
			$passport_picture = $request->get('previous_pic');
		}

		$employee->employee_id = $request->get('employee_id');
		$employee->name = $request->get('name');
		$employee->father_name = $request->get('father_name');
		$employee->mother_name = $request->get('mother_name');
		$employee->spouse_name = $request->get('spouse_name');
		$employee->email = $request->get('email');
		$employee->contact_no_one = $request->get('contact_no_one');
		$employee->emergency_contact = $request->get('emergency_contact');
		$employee->web = $request->get('web');
		$employee->gender = $request->get('gender');
		$employee->date_of_birth = $request->get('date_of_birth');
		$employee->present_address = $request->get('present_address');
		$employee->permanent_address = $request->get('permanent_address');
		$employee->home_district = $request->get('home_district');
		$employee->academic_qualification = $request->get('academic_qualification');
		$employee->professional_qualification = $request->get('professional_qualification');
		$employee->experience = $request->get('experience');
		$employee->reference = $request->get('reference');
		$employee->joining_date = $request->get('joining_date');
		$employee->designation_id = $request->get('designation_id');
		$employee->joining_position = $request->get('joining_position');
		$employee->access_label = 2;
		$employee->marital_status = $request->get('marital_status');
		$employee->id_name = $request->get('id_name');
		$employee->id_number = $request->get('id_number');
		$employee->role = $request->get('role');
		$employee->nssf_no = $request->get('nssf_no');
		$employee->nhif_no = $request->get('nhif_no');
		if(!empty($request->get('password'))){
    		$employee->password = \Hash::make($request->get('password'));
		}
		$employee->kra_no = $request->get('kra_no');
		$employee->kin_details_name = $request->get('kin_details_name');
		$employee->kin_details_relation = $request->get('kin_details_relation');
		$employee->kin_details_phone = $request->get('kin_details_phone');
		$employee->account_name = $request->get('account_name');
		$employee->bank_acc_no = $request->get('bank_acc_no');
		$employee->bank_name = $request->get('bank_name');
		$employee->bank_branch = $request->get('bank_branch');
		$employee->bank_sort_code = $request->get('bank_sort_code');
		$employee->passport_picture = $passport_picture;
		$affected_row = $employee->save();

		DB::table('role_user')
			->where('user_id', $id)
			->update(['role_id' => $request->input('role')]);

		if (!empty($affected_row)) {
			return redirect('/people/employees')->with('message', 'Update successfully.');
		}
		return redirect('/people/employees')->with('exception', 'Operation failed !');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$affected_row = User::where('id', $id)
			->update(['deletion_status' => 1]);

		if (!empty($affected_row)) {
			return redirect('/people/employees')->with('message', 'Delete successfully.');
		}
		return redirect('/people/employees')->with('exception', 'Operation failed !');
	}
	public function report(Request $request){
		$start_date = Carbon::parse(request()->start_date)->toDateTimeString();
        $end_date = Carbon::parse(request()->end_date)->toDateTimeString();

		$employees = User::query()
			->join('designations', 'users.designation_id', '=', 'designations.id')
			->whereBetween('users.access_label', [2, 3])
			->where('users.deletion_status', 0)
			->select('employee_id', 'users.*', 'designations.designation')
			->orderBy('users.employee_id', 'ASC');
		if ($request->start_date || $request->end_date) {
			$employees = $employees->whereBetween('users.created_at', [$start_date , $end_date]);
		}
		$employees = $employees->get()->toArray();

		return view('administrator.people.employee.employee_report', compact('employees'));	
	}
	public function reportPdf(Request $request){
		$start_date = Carbon::parse(request()->start_date)->toDateTimeString();
        $end_date = Carbon::parse(request()->end_date)->toDateTimeString();

		$employees = User::query()
			->join('designations', 'users.designation_id', '=', 'designations.id')
			->whereBetween('users.access_label', [2, 3])
			->where('users.deletion_status', 0)
			->select('employee_id', 'users.id', 'users.name', 'users.contact_no_one', 'users.created_at', 'users.activation_status', 'designations.designation')
			->orderBy('users.employee_id', 'ASC');
		if ($request->start_date || $request->end_date) {
			$employees = $employees->whereBetween('users.created_at', [$start_date , $end_date]);
		}
		$employees = $employees->get()->toArray();

		$pdf = PDF::loadView('administrator.people.employee.employee_report_pdf', compact('employees'));
		$file_name = 'employees_report.pdf';
		// return ($pdf->stream($file_name));die;
		return $pdf->download($file_name);
	}
	public function reportDetail(){		
		if (request()->date) {
			$date = request()->date;
		}
		$date = date('m-Y');
		$salary_month = $date;
		$month = date("m", strtotime($date));
		$year = date("Y", strtotime($date));
		$user = \Auth::user();
		$employees = Payroll::query()
		->leftjoin('users', 'payrolls.user_id', '=', 'users.id')
		->leftjoin('designations as designations', 'users.designation_id', '=', 'designations.id')
		->orderBy('users.name', 'ASC')
		->where('users.access_label', '>=', 2)
		->where('users.access_label', '<=', 3);
		$bonuses = Bonus::whereYear('bonus_month', '=', $year)
		->whereMonth('bonus_month', '=', $month)
		->where('deletion_status', '=', 0);
		$deductions = Deduction::whereYear('deduction_month', '=', $year)
		->whereMonth('deduction_month', '=', $month)
		->where('deletion_status', '=', 0)
		->where('type', 'deduction');
		$allowances = Deduction::whereYear('deduction_month', '=', $year)
		->whereMonth('deduction_month', '=', $month)
		->where('deletion_status', '=', 0)
		->where('type', 'allowance');
		$loans = Loan::where('remaining_installments', '>', 0);
		$salary_payments = SalaryPayment::whereYear('payment_month', '=', $year)
		->whereMonth('payment_month', '=', $month);
		if ($user->access_label != 1) {
			$employees = $employees->where('user_id', $user->id);
			$bonuses = $bonuses->where('user_id', $user->id);
			$deductions = $deductions->where('user_id', $user->id);
			$loans = $loans->where('user_id', $user->id);
			$salary_payments = $salary_payments->where('user_id', $user->id);
		}
		$employees	= $employees->get(['payrolls.*', 'designations.designation', 'users.name','users.mother_name','users.father_name', 'users.id as user_id'])
					  ->toArray();
		$bonuses = $bonuses->get(['bonus_name', 'bonus_amount', 'user_id'])->toArray();
		$deductions = $deductions->get(['deduction_name', 'deduction_amount', 'user_id'])->toArray();
		$allowances = $allowances->get(['deduction_name', 'deduction_amount', 'user_id'])->toArray();
		$loans = $loans->get(['id', 'user_id', 'loan_name', 'loan_amount', 'remaining_installments', 'number_of_installments'])->toArray();
		$salary_payments = $salary_payments->get(['user_id'])->toarray();

		return view('administrator.people.employee.employees_detail_report', compact('employees', 'salary_month', 'bonuses', 'deductions','allowances', 'loans', 'salary_payments'));
	}
	public function nssfReport(){
		$employees = User::query()
			->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
			->leftJoin('payrolls', 'users.id', '=', 'payrolls.user_id')
			->whereBetween('users.access_label', [2, 3])
			->where('users.deletion_status', 0)
			->select('employee_id', 'users.*', 'designations.designation','payrolls.*')
			->orderBy('users.employee_id', 'ASC')
			->get()
			->toArray();
		// print_r($employees);die;
		return view('administrator.people.employee.nssf_report', compact('employees'));		
	}	
	public function nhifReport(){
		$employees = User::query()
			->leftJoin('designations', 'users.designation_id', '=', 'designations.id')
			->leftJoin('payrolls', 'users.id', '=', 'payrolls.user_id')
			->whereBetween('users.access_label', [2, 3])
			->where('users.deletion_status', 0)
			->select('employee_id', 'users.*', 'designations.designation','payrolls.*')
			->orderBy('users.employee_id', 'ASC')
			->get()
			->toArray();
		// print_r($employees);die;
		return view('administrator.people.employee.nhif_report', compact('employees'));		
	}
	public function payeReport(){
		$employees = Payroll::query()
			->leftjoin('users', 'payrolls.user_id', '=', 'users.id')
			->leftjoin('designations as designations', 'users.designation_id', '=', 'designations.id')
			->orderBy('users.name', 'ASC')
			->where('users.access_label', '>=', 2)->get(['payrolls.*', 'designations.designation', 'users.name','users.mother_name','users.father_name', 'users.id as user_id','users.kra_no'])
					  ->toArray();
		// print_r($employees);die;
		return view('administrator.people.employee.paye_report', compact('employees'));		
	}	
	public function pNineReport(Request $request){
		$months = [];
		for ($i = 1; $i <= 12; $i++) {
		    $months[$i] = date("Y-$i");
		}
		$user = \Auth::user();
		if($user->access_label != 1){
		    if(isset($request->employee) && $user->id != $request->employee){
		        abort(404);
		    }
		}
		// print_r($request->employee); exit;
		$date = date('m-Y');
		$salary_month = $date;
		$month = date("m", strtotime($date));
		$year = date("Y", strtotime($date));
		$allEmployees = User::query()
			->leftjoin('payrolls', 'users.id', '=', 'payrolls.user_id')
			->leftjoin('designations', 'users.designation_id', '=', 'designations.id')
			->whereBetween('users.access_label', [2, 3])
			->where('users.deletion_status', 0)
			->where('payrolls.user_id','<>','')
			->select('employee_id', 'users.*', 'designations.designation')
			->orderBy('users.employee_id', 'ASC')
			->get();
		$selectedUser = User::where('id', $request->employee)->select('name','father_name','mother_name','kra_no')->first();
		$employee = Payroll::query()->where('user_id', $request->employee)->first();
		$bonuses = Bonus::whereYear('bonus_month', '=', $year)
		// ->whereMonth('bonus_month', '=', $month)
		->where('user_id', $request->employee)
		->where('deletion_status', '=', 0);
		$deductions = Deduction::whereYear('deduction_month', '=', $year)
		// ->whereMonth('deduction_month', '=', $month)
		->where('deletion_status', '=', 0)
		->where('user_id', $request->employee)
		->where('type', 'deduction');
		$allowances = Deduction::whereYear('deduction_month', '=', $year)
		// ->whereMonth('deduction_month', '=', $month)
		->where('deletion_status', '=', 0)
		->where('user_id', $request->employee)
		->where('type', 'allowance');
		$loans = Loan::where('remaining_installments', '>', 0);
		$salary_payments = SalaryPayment::all()
		->where('user_id', $request->employee);
		// ->whereMonth('payment_month', '=', $month);
// 		if ($user->access_label != 1) {
// 			$employee = $employee->where('user_id', $user->id);
// 			$bonuses = $bonuses->where('user_id', $user->id);
// 			$deductions = $deductions->where('user_id', $user->id);
// 			$loans = $loans->where('user_id', $user->id);
// 			$salary_payments = $salary_payments->where('user_id', $user->id);
// 		}
		// $employee	= $employee->first();
		$bonuses = $bonuses->get(['bonus_name', 'bonus_amount', 'user_id'])->toArray();
		$deductions = $deductions->get(['deduction_name', 'deduction_amount', 'user_id'])->toArray();
		$allowances = $allowances->get(['deduction_name', 'deduction_amount', 'user_id'])->toArray();
		$loans = $loans->get(['id', 'user_id', 'loan_name', 'loan_amount', 'remaining_installments', 'number_of_installments'])->toArray();

		// $salary_payments = $salary_payments->get();
		// echo "<pre>";print_r($employee['nssf']);die;
		// print_r($selectedUser); exit;
		return view('administrator.people.employee.p9_report', compact('employee', 'salary_month', 'bonuses', 'deductions','allowances', 'loans', 'salary_payments','months','allEmployees','selectedUser'));
	}
}
