<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable {

	use Notifiable;
	use EntrustUserTrait;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'created_by', 'employee_id', 'name', 'father_name', 'mother_name', 'spouse_name', 'email', 'password', 'present_address', 'permanent_address', 'home_district', 'id_name', 'id_number', 'contact_no_one', 'contact_no_two', 'emergency_contact', 'web', 'gender', 'date_of_birth', 'marital_status', 'avatar', 'client_type_id', 'designation_id', 'access_label', 'joining_position', 'activation_status', 'academic_qualification', 'professional_qualification', 'experience', 'reference', 'joining_date', 'deletion_status', 'role','nssf_no','nhif_no','passport_picture','kra_no','kin_details_name','kin_details_relation','kin_details_phone','account_name','bank_acc_no','bank_name','bank_branch','bank_sort_code'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];
    public function getEmployeeIdAttribute($value)
    {
        return sprintf('%04s',$value);
    }
// 	public function getEmployeeId($value) {
// 	    sprintf('%04s', 
// 	}

}
