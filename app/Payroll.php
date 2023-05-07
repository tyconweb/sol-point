<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model {
	protected $fillable = [
		'created_by', 'user_id', 'employee_type', 'basic_salary', 'house_rent_allowance', 'medical_allowance', 'special_allowance', 'provident_fund_contribution', 'provident_fund', 'other_allowance', 'tax_deduction', 'provident_fund_deduction', 'other_deduction', 'activation_status','nhif','nssf',
		'taxable_pay','income_tax','nhif_relief','persnol_relief','paye','pay_after_tax','net_pay'

	];
}
