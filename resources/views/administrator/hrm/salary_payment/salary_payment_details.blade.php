@extends('administrator.master')
@section('title', __('Salary Payment Details'))

@section('main_content')
<div class="content-wrapper wow fadeInDown" data-wow-duration=".5s" data-wow-delay=".2s">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      {{ __('PAYROLL') }}
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
      <li><a>{{ __('Salary') }}</a></li>
      <li class="active">{{ __('Salary Payment Details') }}</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- Default box -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">{{ __('Employee Details') }}</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <a href="{{ url('/hrm/salary-payments') }}" class="btn btn-primary btn-flat"><i class="fa fa-arrow-left"></i> {{ __('Back') }}</a>
            <a href="{{ url('/hrm/salary-payments/pdf/'.$user['id'].'/'.$salary_month) }}" class="btn btn-primary btn-flat"><i class="fa fa-print"></i><span class="hidden-sm hidden-xs"> {{ __('Print') }} </span></a>

            <!--<button type="button" class="btn btn-primary btn-flat" title="Print" data-original-title="Label Printer" onclick="printDiv('printable_area')"><i class="fa fa-print"></i><span class="hidden-sm hidden-xs"> {{ __('Print') }} </span></button>-->
           
            <hr>
            <div id="printable_area" class="table-responsive">
              <table class="table table-bordered">
                <tr>
                  <td>
                    <p>
                      {{ $user['employee_id'] }}
                      <br>
                      {{ $user['name'] }}
                      <br>
                      ({{ $user['designation'] }})
                      <br>
                      {{ __('Department of') }} {{ $user['department'] }}
                      <br>
                     {{ __('Joining Date:') }}  {{ date("d F Y", strtotime($user['created_at'])) }}
                    </p>
                  </td>
                  <td>
                    @if(!empty($user['avatar']))
                    <img src="{{ url('public/profile_picture/' . $user['avatar']) }}" class="img-responsive img-thumbnail">
                    @else
                    <img src="{{ url('public/profile_picture/blank_profile_picture.png') }}" alt="blank_profile_picture" class="img-responsive img-thumbnail">
                    @endif
                  </td>
                </tr>
              </table>
              <hr>

              <table class="table table-bordered">
                <tr class="bg-info">
                  <th>{{ __('sl#') }}</th>
                  <th>{{ __('Description') }}</th>
                  <th>{{ __('Debits') }}</th>
                  <th>{{ __('Credits') }}</th>
                </tr>
                @php($sl = 1)
                @php($amount = 0)
                @foreach($salary_payment_details as $data)
                <tr>
                  <td>{{ $sl++ }}</td>
                  <td>{{ $data->item_name }}</td>
                  <td>
                    @if($data->status == 'debits')
                    -{{ $data->amount }}
                    @endif
                  </td>
                  <td>
                    @if($data->status == 'credits')
                    {{ $data->amount }}
                        @if($sl != 2)
                            @php($amount += $data->amount)
                        @endif
                    @endif
                  </td>
                </tr>
                @endforeach
                <tr>
                  <td> &nbsp; </td>
                </tr>
                <tr class="success">
                  <td colspan="3"><strong class="pull-right">{{ __('Gross Salary:') }}</strong></td>
                  <td>
                    <strong>
                      {{ number_format($salary_payment->gross_salary, 2, '.', '') }}
                    </strong>
                  </td>
                </tr>
                <tr class="success">
                  <td colspan="3"><strong class="pull-right">{{ __('P.A.Y.E:') }}</strong></td>
                  <td><strong id="paye"></strong></td>
                </tr>
                <tr class="success">
                  <td colspan="3"><strong class="pull-right">{{ __('Persnol Relief:') }}</strong></td>
                  <td><strong id="persnol_relief"></strong></td>
                </tr>
                <tr class="success">
                  <td colspan="3"><strong class="pull-right">{{ __('NHIF Relief:') }}</strong></td>
                  <td><strong id="nhif_relief"></strong></td>
                </tr>
                <tr class="success">
                  <td colspan="3"><strong class="pull-right">{{ __('Total Allowance:') }}</strong></td>
                  <td><strong id="allowance">{{ $amount }}</strong></td>
                </tr>
                <tr class="success">
                  <td colspan="3"><strong class="pull-right">{{ __('Total Deduction:') }}</strong></td>
                  <td><strong id="deduction">0</strong></td>
                </tr>
                <tr class="success">
                  <td colspan="3"><strong class="pull-right">{{ __('Net Pay:') }}</strong></td>
                  <td><strong id="net_salary">0</strong></td>
                </tr>
                <tr class="success">
                  <td colspan="3"><strong class="pull-right">{{ __('Provident Fund:') }}</strong></td>
                  <td><strong>{{ number_format($salary_payment->provident_fund, 2, '.', '') }}</strong></td>
                </tr>
              </table>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
      </div>
      <!-- /.end.col -->

      <div class="col-md-12">
        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title"><strong>{{ __('Payment History') }}</strong></h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered">
             <tr class="bg-info">
              <th>{{ __('sl#') }}</th>
              <th>{{ __('Salary Month') }}</th>
              <th>{{ __('Gross Salary') }}</th>
              <th>{{ __('Total Deduction') }}</th>
              <th>{{ __('Net Salary') }}</th>
              <th>{{ __('Provident Fund') }}</th>
              <th>{{ __('Payment Amount') }}</th>
              <th>{{ __('Payment Type') }}</th>
              <th>{{ __('Note') }}</th>
            </tr>
            @php($sl = 1)
            @foreach($employee_salaries as $employee_salary)
            <tr>
              <td>{{ $sl++ }}</td>
              <td><a href="{{ url('/hrm/salary-payments/manage-salary/'.$employee_salary['user_id'].'/'.date("Y-m", strtotime($employee_salary['payment_month']))) }}">{{ date("F Y", strtotime($employee_salary['payment_month'])) }}</a></td>
              <td>{{ $employee_salary['gross_salary'] }}</td>
              <td>{{ $employee_salary['total_deduction'] }}</td>
              <td>{{ $employee_salary['net_salary'] }}</td>
              <td>{{ $employee_salary['provident_fund'] }}</td>
              <td>{{ $employee_salary['payment_amount'] }}</td>
              <td>
                @if($employee_salary['payment_type'] == 1)
               {{ __(' Cash Payment') }}
                @elseif($employee_salary['payment_type'] == 2)
               {{ __('Chaque Payment') }} 
                @else
               {{ __(' Bank Payment') }}
                @endif
              </td>
              <td>{{ $employee_salary['note'] }}</td>
            </tr>
            @endforeach
          </table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
    <!-- /.end.col -->
  </div>
  <!-- /.end.row -->
</section>
<!-- /.content -->
</div>
<script>
      //For Calculation
  $(document).ready(function() {
    calculation();
  });

  function calculation() {
    var sum = 0;
    var gross_salary = '{{ $salary_payment->gross_salary ?? '0' }}';
    var nhif = getNHIFRates(gross_salary);
    var nssf = getNSSFRate(gross_salary);

    var total_deduction = '{{ $salary_payment->total_deduction ?? '0' }}';

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
    var deduction = '{{ number_format($salary_payment->total_deduction, 2, '.', '') }}';
    var t_deduction = (+deduction + +paye);
    var net_salary = gross_salary-t_deduction;
    $("#deduction").text(parseInt(t_deduction));
    $("#paye").text(paye);
    $("#paye").text(paye);
    $("#net_salary").text(net_salary);
    $("#persnol_relief").text(persnol_relief);
    $("#nhif_relief").text(nhif_relief);
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