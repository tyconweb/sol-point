@extends('administrator.master')
@section('title', __('Edit team member'))

@section('main_content')
<div class="content-wrapper wow fadeInDown" data-wow-duration=".5s" data-wow-delay=".2s">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           {{ __('TEAM') }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i>    {{ __('Dashboard') }}</a></li>
            <li><a href="{{ url('/people/employees') }}">   {{ __('Team') }}</a></li>
            <li class="active">   {{ __('Edit team member details') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="{{ url('people/employees/update/'.$employee['id']) }}" method="post" name="employee_edit_form" enctype="multipart/form-data">
        {{ csrf_field() }}
        <!-- SELECT2 EXAMPLE -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">   {{ __('Edit team member details') }}</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <!-- Notification Box -->
                            <div class="col-md-12">
                                @if (!empty(Session::get('message')))
                                <div class="alert alert-success alert-dismissible" id="notification_box">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <i class="icon fa fa-check"></i> {{ Session::get('message') }}
                                </div>
                                @elseif (!empty(Session::get('exception')))
                                <div class="alert alert-warning alert-dismissible" id="notification_box">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <i class="icon fa fa-warning"></i> {{ Session::get('exception') }}
                                </div>
                                @else
                                <p class="text-yellow">{{ __(' Enter team member details. All (*)field are required.') }}</p>
                                @endif
                            </div>
                            <!-- /.Notification Box -->

                            <div class="col-md-6">
                                <label for="employee_id">{{ __(' ID') }} <span class="text-danger">*</span></label>
                                <div class="form-group{{ $errors->has('employee_id') ? ' has-error' : '' }} has-feedback">
                                    <input type="hidden" name="employee_id" id="employee_id" class="form-control" value="{{ sprintf('%04s', $employee['employee_id']) }}">
                                    <input type="text" readonly name="employee_id_show" id="employee_id_show" class="form-control" value="{{ sprintf('%04s', $employee['employee_id']) }}">
                                    @if ($errors->has('employee_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('employee_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <!-- /.form-group -->
                                <label for="id_name">{{ __(' ID Name') }}</label>
                                <div class="form-group{{ $errors->has('id_name') ? ' has-error' : '' }} has-feedback">
                                    <select name="id_name" id="id_name" class="form-control">
                                        <option value="" selected disabled>{{ __(' Select one') }}</option>
                                        <option value="1">{{ __(' NID') }}</option>
                                        <option value="2">{{ __(' Passport') }}</option>
                                        <option value="3">{{ __(' Driving License') }}</option>
                                    </select>
                                    @if ($errors->has('id_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                
                                <!-- /.form-group -->

                                <label for="name">{{ __('First Name') }} <span class="text-danger">*</span></label>
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} has-feedback">
                                    <input type="text" name="name" id="name" class="form-control alphabets" value="{{ $employee['name'] }}">
                                    @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <!-- /.form-group -->
                                <label for="father_name">{{ __(' Last Name') }}</label>
                                <div class="form-group{{ $errors->has('father_name') ? ' has-error' : '' }} has-feedback">
                                    <input type="text" name="father_name" id="father_name" class="form-control alphabets" value="{{ $employee['father_name'] }}">
                                    @if ($errors->has('father_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('father_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <!-- /.form-group -->

                                <label for="designation_id">{{ __(' Designation') }} <span class="text-danger">*</span></label>
                                <div class="form-group{{ $errors->has('designation_id') ? ' has-error' : '' }} has-feedback">
                                    <select name="designation_id" id="designation_id" class="form-control">
                                        <option value="" selected disabled>{{ __(' Select one') }}</option>
                                        @foreach($designations as $designation)
                                        <option value="{{ $designation['id'] }}" {{ $employee['designation_id'] == $designation['id'] ? 'selected' : '' }}>{{ $designation['designation'] }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('designation_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('designation_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <!-- /.form-group -->

                                <label for="datepicker4">{{ __(' Joining Date') }}<span class="text-danger">*</span></label>
                                <div class="form-group{{ $errors->has('joining_date') ? ' has-error' : '' }} has-feedback">
                                    <div class="input-group date">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        <input type="text" name="joining_date" value="{{ $employee['joining_date'] }}" class="form-control pull-right" id="datepicker4">
                                    </div>
                                    @if ($errors->has('joining_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('joining_date') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <!-- /.form-group -->
                                
                                <label for="nhif_no">{{ __('NHIF No') }}</label>
                                <div class="form-group{{ $errors->has('nhif_no') ? ' has-error' : '' }} has-feedback">
                                    <input type="nhif_no" name="nhif_no" class="form-control digits" id="nhif_no" value="{{ $employee['nhif_no'] }}" placeholder="Enter NHIF No">
                                    @if ($errors->has('nhif_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nhif_no') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <!-- /.form-group -->
                                <label for="kra_no">{{ __('KRA PIN') }}</label>
                                <div class="form-group{{ $errors->has('kra_no') ? ' has-error' : '' }} has-feedback">
                                    <input type="kra_no" name="kra_no" class="form-control alpha-digits" value="{{ $employee['kra_no'] }}" id="kra_no" placeholder="Enter KRA PIN">
                                    @if ($errors->has('kra_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('kra_no') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <label for="passport_picture">{{ __('Passport Picture') }} <span class="text-danger">*</span></label>
                                <div class="form-group{{ $errors->has('passport_picture') ? ' has-error' : '' }} has-feedback">
                                    <input type="file" name="passport_picture" id="passport_picture" class="form-control">
                                    <input type="hidden" name="previous_pic" value="{{ $employee['passport_picture'] }}">
                                    @if ($errors->has('passport_picture'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('passport_picture') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                @if(!empty($employee['passport_picture']))
                                <img src="{{ url('/public/passport_picture/' . $employee['passport_picture']) }}" alt="{{ $employee['name'] }}" class="img-responsive img-thumbnail">
                                @else
                                <img src="{{ url('/public/passport_picture/blank_passport_picture.png') }}" alt="blank_profile_picture" class="img-responsive img-thumbnail">
                                @endif
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <div class="row">
                                <div class="col-md-6">
                                <input type="hidden" name="home_district" id="home_district" class="form-control" value="{{ $employee['home_district'] }}">
                                <label for="role">{{ __(' Role') }}<span class="text-danger">*</span></label>
                                <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }} has-feedback">
                                    <select name="role" id="role" class="form-control">
                                        <option value="" selected disabled>{{ __(' Select one') }}</option>
                                        @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ $employee['role'] == $role->name ? 'selected' : '' }}>{{ $role->display_name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('role'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <!-- /.form-group -->

                                <label for="id_number">{{ __(' ID Number') }}</label>
                                <div class="form-group{{ $errors->has('id_number') ? ' has-error' : '' }} has-feedback">
                                    <input type="text" name="id_number" id="id_number" class="form-control digits" value="{{ $employee['id_number'] }}">
                                    @if ($errors->has('id_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id_number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <!-- /.form-group -->

                                <label for="mother_name">{{ __('Middle Name') }} <span class="text-danger">*</span></label>
                                <div class="form-group{{ $errors->has('mother_name') ? ' has-error' : '' }} has-feedback">
                                    <input type="text" name="mother_name" id="mother_name" class="form-control alphabets" value="{{ $employee['mother_name'] }}" placeholder="{{ __('Enter Middle name..') }}">
                                    @if ($errors->has('mother_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mother_name') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <!-- /.form-group -->

                                <label for="joining_position">{{ __(' Job Group') }} <span class="text-danger">*</span></label>
                                <div class="form-group{{ $errors->has('joining_position') ? ' has-error' : '' }} has-feedback">
                                    <select name="joining_position" id="joining_position" class="form-control">
                                        <?php $departments= \App\Department::all();?>
                                        <option value="" disabled>{{ __(' Select one') }}</option>
                                        @foreach($departments as $department)
                                        <option value="{{ $department['id'] }}" {{ $employee['joining_position'] == $department['id'] ? 'selected' : '' }}>{{ $department['department'] }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('joining_position'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('joining_position') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <!-- /.form-group -->

                                <label for="gender">{{ __(' Gender') }} <span class="text-danger">*</span></label>
                                <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }} has-feedback">
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="" selected disabled>{{ __(' Select one') }}</option>
                                        <option value="m">{{ __(' Male') }}</option>
                                        <option value="f">{{ __(' Female') }}</option>
                                    </select>
                                    @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <!-- /.form-group -->
                                <label for="datepicker">{{ __(' Date of Birth') }}</label>
                                <div class="form-group{{ $errors->has('date_of_birth') ? ' has-error' : '' }} has-feedback">
                                    <div class="input-group date">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        <input type="date" name="date_of_birth" class="form-control pull-right" value="{{ $employee['date_of_birth'] }}" max="{{ date('Y-m-d',strtotime(date('Y-m-d').'-18 years')) }}">
                                        <!--<input type="text" name="date_of_birth" class="form-control pull-right" value="{{ $employee['date_of_birth'] }}" id="datepicker3">-->
                                    </div>
                                    @if ($errors->has('date_of_birth'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date_of_birth') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <!-- /.form-group -->

                                <label for="nssf_no">{{ __('NSSF No') }}</label>
                                <div class="form-group{{ $errors->has('nssf_no') ? ' has-error' : '' }} has-feedback">
                                    <input type="nssf_no" name="nssf_no" class="form-control digits" id="nssf_no" value="{{ $employee['nssf_no'] }}" placeholder="Enter NSSF No">
                                    @if ($errors->has('nssf_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nssf_no') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label for="kin_details_name">{{ __('Next of Kin Name') }}  <span class="text-danger">*</span></label>
                                <div class="form-group{{ $errors->has('kin_details_name') ? ' has-error' : '' }} has-feedback">
                                    <input type="kin_details_name" name="kin_details_name" class="form-control" value="{{ $employee['kin_details_name'] }}" id="kin_details_name" placeholder="Enter Next of Kin Name">
                                    @if ($errors->has('kin_details_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('kin_details_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label for="kin_details_relation">{{ __('Next of Kin Relationship') }}  <span class="text-danger">*</span></label>
                                <div class="form-group{{ $errors->has('kin_details_relation') ? ' has-error' : '' }} has-feedback">
                                    <input type="kin_details_relation" name="kin_details_relation" class="form-control" value="{{ $employee['kin_details_relation'] }}" id="kin_details_relation" placeholder="Enter Next of Kin Relationship">
                                    @if ($errors->has('kin_details_relation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('kin_details_relation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label for="kin_details_phone">{{ __('Next of Kin Phone No') }}  <span class="text-danger">*</span></label>
                                <div class="form-group{{ $errors->has('kin_details_phone') ? ' has-error' : '' }} has-feedback">
                                    <input type="kin_details_phone" name="kin_details_phone" class="form-control" value="{{ $employee['kin_details_phone'] }}" id="kin_details_phone" placeholder="Enter Next of Kin Phone No">
                                    @if ($errors->has('kin_details_phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('kin_details_phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <!-- /.form-group -->
                            </div>
                            </div>
                            <br>
                            <div class="col-md-6">
                                <h4>Contact Details</h4>
                                <label for="email">{{ __(' Email') }} <span class="text-danger">*</span></label>
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
                                    <input type="text" name="email" id="email" class="form-control" value="{{ $employee['email'] }}">
                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <!-- /.form-group -->
                                <label for="emergency_contact">{{ __(' Emergency Contact') }}</label>
                                <div class="form-group{{ $errors->has('emergency_contact') ? ' has-error' : '' }} has-feedback">
                                    <input type="text" name="emergency_contact" id="emergency_contact" class="form-control" value="{{ $employee['emergency_contact'] }}">
                                    @if ($errors->has('emergency_contact'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('emergency_contact') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <br>
                            <div class="col-md-6">
                                <label for="password">{{ __('Login PIN') }} <span class="text-danger">If you want to keep the same so leave it empty. </span></label>
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
                                    <input type="password" name="password" class="form-control" value="" id="password" placeholder="Enter Employee PIN">
                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label for="contact_no_one">{{ __(' Contact No') }}<span class="text-danger">*</span></label>
                                <div class="form-group{{ $errors->has('contact_no_one') ? ' has-error' : '' }} has-feedback">
                                    <input type="text" name="contact_no_one" id="contact_no_one" class="form-control digits" value="{{ $employee['contact_no_one'] }}">
                                    @if ($errors->has('contact_no_one'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contact_no_one') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.row -->
                        </div>

                </div>
            </div>
            <!-- /.box -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ __('Bank Details') }}</h3> 
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                            <div class="col-md-6">
                            <h4>&nbsp;</h4> 
                            <!-- /.form-group -->
                            <label for="account_name">{{ __('Account Name') }}  <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('account_name') ? ' has-error' : '' }} has-feedback">
                                <input type="account_name" name="account_name" class="form-control alphabets" value="{{ $employee['account_name'] }}" id="account_name" placeholder="Enter Account Name">
                                @if ($errors->has('account_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('account_name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <label for="bank_acc_no">{{ __('Bank Account Number') }}  <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('bank_acc_no') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="bank_acc_no" id="bank_acc_no" class="form-control digits" value="{{ $employee['bank_acc_no'] }}" placeholder="{{ __('Enter Bank Account No..') }}">
                                @if ($errors->has('bank_acc_no'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('bank_acc_no') }}</strong>
                                </span>
                                @endif
                            </div>
                            <label for="bank_name">{{ __('Bank Name') }}  <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('bank_name') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="bank_name" id="bank_name" class="form-control alphabets" value="{{ $employee['bank_name'] }}" placeholder="{{ __('Enter Bank Name..') }}">
                                @if ($errors->has('bank_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('bank_name') }}</strong>
                                </span>
                                @endif
                            </div>

                            <label for="bank_branch">{{ __('Bank Branch') }}  <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('bank_branch') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="bank_branch" id="bank_branch" class="form-control" value="{{ $employee['bank_branch'] }}" placeholder="{{ __('Enter Bank Branch..') }}">
                                @if ($errors->has('bank_branch'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('bank_branch') }}</strong>
                                </span>
                                @endif
                            </div>
                            
                            <label for="bank_sort_code">{{ __('Bank Sort Code (Bank+Branch Code) ') }}</label>
                            <div class="form-group{{ $errors->has('bank_sort_code') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="bank_sort_code" id="bank_sort_code" class="form-control" value="{{ $employee['bank_sort_code'] }}" placeholder="{{ __('Enter Sort Code..') }}">
                                @if ($errors->has('bank_sort_code'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('bank_sort_code') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- /.form-group -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{ url('/people/employees') }}" class="btn btn-danger btn-flat"><i class="icon fa fa-close"></i> {{ __(' Cancel') }}</a>
                        <button type="submit" class="btn btn-primary btn-flat"><i class="icon fa fa-plus"></i> {{ __(' Update') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>
<!-- /.content -->
<script type="text/javascript">
    document.forms['employee_edit_form'].elements['gender'].value = "{{ $employee['gender'] }}";
    document.forms['employee_edit_form'].elements['id_name'].value = "{{ $employee['id_name'] }}";
    document.forms['employee_edit_form'].elements['designation_id'].value = "{{ $employee['designation_id'] }}";
    document.forms['employee_edit_form'].elements['role'].value = "{{ $employee['role'] }}";
    document.forms['employee_edit_form'].elements['joining_position'].value = "{{ $employee['joining_position'] }}";
</script>
@endsection