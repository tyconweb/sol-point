@extends('administrator.master')
@section('title', __('Manage Salary'))

@section('main_content')
<div class="content-wrapper wow fadeInDown" data-wow-duration=".5s" data-wow-delay=".2s">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
     {{ __('PAYROLL') }} 
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i>{{ __('Dashboard') }} </a></li>
      <li><a>{{ __('Payroll') }}</a></li>
      <li class="active">{{ __('Manage Salary') }}</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- Default box -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">{{ __('Manage Salary') }}</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
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
              @endif
            </div>
            <!-- /.Notification Box -->
            <div class="col-md-12">
              <form class="form-horizontal" name="employee_select_form" action="{{ url('/hrm/payroll/go') }}" method="post">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
                  <label for="user_id" class="col-sm-3 control-label">{{ __('Employee Name') }}</label>
                  <div class="col-sm-6">
                    <select name="user_id" class="form-control" id="user_id">
                      <option selected disabled>{{ __('Select One') }}</option>
                      @foreach($employees as $employee)
                      <option value="{{ $employee['id'] }}">{{ $employee['name'] }}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('user_id'))
                    <span class="help-block">
                      <strong>{{ $errors->first('user_id') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="form-group{{ $errors->has('basic_salary') ? ' has-error' : '' }}">
                  <div class=" col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-info btn-flat"><i class="icon fa fa-arrow-right"></i> {{ __('Go') }}</button>
                  </div>
                </div>
              </form>
            </div>
            <!-- /. end col -->
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix"></div>
          <!-- /.box-footer -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.end.col -->

      <form name="employee_salary_form" id="employee_salary_form" action="{{ url('/hrm/payroll/store') }}" method="post">
        {{ csrf_field() }}

        <input type="hidden" name="user_id" value="{{ $employee_id }}">

        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">{{ __('Salary Details') }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="form-horizontal">
              <div class="box-body">
                <div class="form-group{{ $errors->has('employee_type') ? ' has-error' : '' }}">
                  <label for="employee_type" class="col-sm-3 control-label">{{ __('Employee Type') }}</label>
                  <div class="col-sm-6">
                    <select name="employee_type" class="form-control" id="employee_type">
                      <option selected disabled>{{ __('Select One') }}</option>
                      <option value="2">{{ __('Permanent') }}</option>
                      <option value="1">{{ __('Casual') }}</option>
                      <option value="3">{{ __('Contract') }}</option>
                      <option value="4">{{ __('Internship (three to six months)') }}</option>
                    </select>
                    @if ($errors->has('employee_type'))
                    <span class="help-block">
                      <strong>{{ $errors->first('employee_type') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
                <div class="form-group{{ $errors->has('basic_salary') ? ' has-error' : '' }}">
                  <label for="basic_salary" class="col-sm-3 control-label">{{ __('Basic Salary') }}</label>
                  <div class="col-sm-6">
                    <input type="number" name="basic_salary" class="form-control" id="basic_salary" value="{{ old('basic_salary') }}" placeholder="{{ __('Enter basic salary..') }}">
                    @if ($errors->has('basic_salary'))
                    <span class="help-block">
                      <strong>{{ $errors->first('basic_salary') }}</strong>
                    </span>
                    @endif
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
            </div>
          </div>
        </div>
        <!-- /.end.col -->
        <div class="col-md-6">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">{{ __('Allowances') }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group{{ $errors->has('house_rent_allowance') ? ' has-error' : '' }}">
                <label for="house_rent_allowance">{{ __('House Rent Allowance') }}</label>
                <input type="number" name="house_rent_allowance" value="{{ old('house_rent_allowance') }}" class="form-control" id="house_rent_allowance" placeholder="{{ __('Enter house rent allowance..') }}">
                @if ($errors->has('house_rent_allowance'))
                <span class="help-block">
                  <strong>{{ $errors->first('house_rent_allowance') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group{{ $errors->has('medical_allowance') ? ' has-error' : '' }}">
                <label for="medical_allowance">{{ __('Medical Allowance') }}</label>
                <input type="number" name="medical_allowance" value="{{ old('medical_allowance') }}" class="form-control" id="medical_allowance" placeholder="{{ __('Enter medical allowance..') }}">
                @if ($errors->has('medical_allowance'))
                <span class="help-block">
                  <strong>{{ $errors->first('medical_allowance') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group{{ $errors->has('special_allowance') ? ' has-error' : '' }}">
                <label for="special_allowance">{{ __('Special Allowance') }}</label>
                <input type="number" name="special_allowance" value="{{ old('special_allowance') }}" class="form-control" id="special_allowance" placeholder="{{ __('Enter special allowance..') }}">
                @if ($errors->has('special_allowance'))
                <span class="help-block">
                  <strong>{{ $errors->first('special_allowance') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group{{ $errors->has('provident_fund_contribution') ? ' has-error' : '' }}">
                <label for="provident_fund_contribution">{{ __('Provident Fund Contribution') }}</label>
                <input type="number" name="provident_fund_contribution" value="{{ old('provident_fund_contribution') }}" class="form-control" id="provident_fund_contribution" placeholder="{{ __('Enter provident fund contribution..') }}">
                @if ($errors->has('provident_fund_contribution'))
                <span class="help-block">
                  <strong>{{ $errors->first('provident_fund_contribution') }}</strong>
                </span>
                @endif
              </div>
              <input type="hidden" name="other_allowance" value="0" class="form-control" id="other_allowance">
                <a class="btn btn-primary btn-flat" target="_blank" href="/hrm/allowance">
                    Other Allowance
                </a>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- /.end.col -->
        <div class="col-md-6">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">{{ __('Deductions') }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group{{ $errors->has('tax_deduction') ? ' has-error' : '' }}">
                <label for="tax_deduction">{{ __('Tax Deduction') }}</label>
                <input type="number" name="tax_deduction" value="{{ old('tax_deduction') }}" class="form-control" id="tax_deduction" placeholder="{{ __('Enter tax deduction..') }}">
                @if ($errors->has('tax_deduction'))
                <span class="help-block">
                  <strong>{{ $errors->first('tax_deduction') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group{{ $errors->has('provident_fund_deduction') ? ' has-error' : '' }}">
                <label for="provident_fund_deduction">{{ __('Provident Fund Deduction') }}</label>
                <input type="number" name="provident_fund_deduction" value="{{ old('provident_fund_deduction') }}" class="form-control" id="provident_fund_deduction" placeholder="{{ __('Enter provident fund deduction..') }}">
                @if ($errors->has('provident_fund_deduction'))
                <span class="help-block">
                  <strong>{{ $errors->first('provident_fund_deduction') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group{{ $errors->has('nhif') ? ' has-error' : '' }}">
                <label for="nhif">{{ __('NHIF') }}</label>
                <input type="number" name="nhif" readonly value="0" class="form-control" id="nhif" placeholder="{{ __('Enter NHIF deduction..') }}">
                @if ($errors->has('nhif'))
                <span class="help-block">
                  <strong>{{ $errors->first('nhif') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group{{ $errors->has('nssf') ? ' has-error' : '' }}">
                <label for="nssf">{{ __('NSSF') }}</label>
                <input type="number" name="nssf" readonly value="0" class="form-control" id="nssf" placeholder="{{ __('Enter NSSF deduction..') }}">
                @if ($errors->has('nssf'))
                <span class="help-block">
                  <strong>{{ $errors->first('nssf') }}</strong>
                </span>
                @endif
              </div>
              <input type="hidden" name="other_deduction" value="0" class="form-control" id="other_deduction">
                <a class="btn btn-primary btn-flat" target="_blank" href="/hrm/deduction">
                    Other Deduction
                </a>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- /.end.col -->

        <div class="col-md-6">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">{{ __('Provident Fund') }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group">
                <label for="total_provident_fund">{{ __('Total Provident Fund') }}</label>
                <input type="number" class="form-control" id="total_provident_fund" readonly>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- /.end.col -->

        <div class="col-md-6">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">{{ __('Total Salary Details') }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group">
                <label for="gross_salary">{{ __('Gross Salary') }}</label>
                <input type="number" disabled value="0" class="form-control" id="gross_salary">
              </div>
              <div class="form-group">
                <label for="taxable_pay">{{ __('Taxable Pay (TP)') }}</label>
                <input type="number" readonly value="0" class="form-control" name="taxable_pay" id="taxable_pay">
              </div>
              <div class="form-group">
                <label for="income_tax">{{ __('Income Tax (IT)') }}</label>
                <input type="number" readonly value="0" class="form-control" name="income_tax" id="income_tax">
              </div>
              <div class="form-group">
                <label for="nhif_relief">{{ __('NHIF relief') }}</label>
                <input type="number" readonly value="0" class="form-control" name="nhif_relief" id="nhif_relief">
              </div>
              <div class="form-group">
                <label for="persnol_relief">{{ __('Personal Relief ') }}</label>
                <input type="number" readonly value="0" class="form-control" name="persnol_relief" id="persnol_relief">
              </div>
              <div class="form-group">
                <label for="paye">{{ __('PAYE') }}</label>
                <input type="number" readonly value="0" class="form-control" name="paye" id="paye">
              </div>
              <div class="form-group">
                <label for="pay_after_tax">{{ __('Pay After Tax') }}</label>
                <input type="number" readonly value="0" class="form-control" name="pay_after_tax" id="pay_after_tax">
              </div>
              <div class="form-group{{ $errors->has('total_deduction') ? ' has-error' : '' }}">
                <label for="total_allowance">{{ __('Total Allowance') }}</label>
                <input type="number" disabled value="0" class="form-control" id="total_allowance">
              </div>
              <div class="form-group{{ $errors->has('total_deduction') ? ' has-error' : '' }}">
                <label for="total_deduction">{{ __('Total Deduction') }}</label>
                <input type="number" disabled value="0" class="form-control" id="total_deduction">
              </div>
              <div class="form-group">
                <label for="net_pay">{{ __('Net Pay') }}</label>
                <input type="number" readonly value="0" class="form-control" name="net_pay" id="net_pay">
              </div>
              <div class="form-group">
                <label for="net_salary">{{ __('Net Salary') }}</label>
                <input type="hidden" disabled value="0" class="form-control" id="net_salary">
              </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" class="btn btn-primary btn-flat pull-right"><i class="fa fa-save"></i> {{ __('Save Details') }}</button>
            </div>
          </div>
        </div>
        <!-- /.end.col -->

      </form>

    </div>
  </section>
  <!-- /.content -->
</div>
<script type="text/javascript">
  // For Kepp Data After Reload
  document.forms['employee_select_form'].elements['user_id'].value = "{{ $employee_id }}";

  @if(!empty(old('employee_type')))
  document.forms['employee_salary_form'].elements['employee_type'].value = "{{ old('employee_type') }}";
  @endif

  $(document).ready(function(){
    // calculation();
  });


  //For Calculation
  $(document).on("keyup", "#employee_salary_form", function() {
    calculation();
  });

  function calculation() {
    var sum = 0;
    var basic_salary = $("#basic_salary").val();
    var house_rent_allowance = $("#house_rent_allowance").val();
    var medical_allowance = $("#medical_allowance").val();
    var special_allowance = $("#special_allowance").val();
    var provident_fund_contribution = $("#provident_fund_contribution").val();
    var other_allowance = $("#other_allowance").val();
    var tax_deduction = $("#tax_deduction").val();
    var provident_fund_deduction = $("#provident_fund_deduction").val();
    var other_deduction = $("#other_deduction").val();
    var other_deduction = $("#other_deduction").val();
    var taxable_pay = $("#taxable_pay").val();
    var persnol_relief = $("#persnol_relief").val();
    var paye = $("#paye").val();
    var allowance = (+house_rent_allowance + +medical_allowance + +special_allowance + +other_allowance);
    var gross_salary = (+basic_salary + allowance);
    var nhif = getNHIFRates(gross_salary);
    var nssf = getNSSFRate(gross_salary);

    var total_deduction = (+tax_deduction + +provident_fund_deduction + +other_deduction + +nhif + +nssf);
    $("#total_provident_fund").val(+provident_fund_contribution + +provident_fund_deduction);

    var taxable_pay = gross_salary - nssf;
    var nhif_relief = 0;
    var persnol_relief = 0;
    var paye = 0;
    var income_tax = 0;
    if(taxable_pay <= 24000){
      income_tax = taxable_pay*10/100;
    }
    if(taxable_pay > 24000){
      var a = 24000*10/100;
      var b = 8333*25/100;
      var c = taxable_pay-(+24000 + +8333);
      var c = c*30/100;
      // console.log(a);
      // console.log(b);
      // console.log(c);
      income_tax = (+a + +b + +c); 
      // console.log(income_tax);
      nhif_relief = nhif*15/100;
      persnol_relief = 2400;
      paye = income_tax-(+nhif_relief + +persnol_relief);
    }
    var pay_after_tax = taxable_pay - paye; 
    var net_pay = pay_after_tax - nhif; 

    $("#income_tax").val(income_tax);
    $("#pay_after_tax").val(pay_after_tax);
    $("#paye").val(paye);
    $("#persnol_relief").val(persnol_relief);
    $("#nhif_relief").val(nhif_relief);
    $("#taxable_pay").val(taxable_pay);
    $("#nhif").val(nhif);
    $("#nssf").val(nssf);
    $("#gross_salary").val(gross_salary);
    $("#total_allowance").val(allowance);
    $("#total_deduction").val((+total_deduction + +paye));
    $("#net_salary").val(+net_pay - +total_deduction + +nhif + +nssf);
    $("#net_pay").val(+net_pay - +total_deduction + +nhif + +nssf);
  }
  function getNHIFRates(x) {
    let nhif = 0;
    if(between(x, 0, 5999))
      nhif = 150;
    else if(between(x, 6000, 8999))
      nhif = 300;
    else if(between(x, 8000, 11999))
      nhif = 400;
    else if(between(x, 12000, 14999))
      nhif = 500;
    else if(between(x, 15000,19999))
      nhif = 600;
    else if(between(x, 20000 ,24999))
      nhif = 750;
    else if(between(x, 25000 ,29999))
      nhif = 850;
    else if(between(x, 30000 ,34999))
      nhif = 900;
    else if(between(x, 35000 ,39000))
      nhif = 950;
    else if(between(x, 40000 ,44999))
      nhif = 1000;
    else if(between(x, 45000 ,49000))
      nhif = 1100;
    else if(between(x, 50000 ,59999))
      nhif = 1200;
    else if(between(x, 60000 ,69999))
      nhif = 1300;
    else if(between(x, 70000 ,79999))
      nhif = 1400;
    else if(between(x, 80000 ,89999))
      nhif = 1500;
    else if(between(x, 90000 ,99999))
      nhif = 1600;
    else if(x>100000)
      nhif = 1700;
    else 
      nhif = 0;

    return nhif;
  }
  function getNSSFRate (x) {
    let NSSF = 0;
    if(between(x, 0, 18000) ){
      NSSF= x*6/100; //of Gross salary
    }else if (x > 18000){
      NSSF = 1080;
    }
    return NSSF;
  }
  function between(x, min, max) {
    return x >= min && x <= max;
  }
</script>
@endsection