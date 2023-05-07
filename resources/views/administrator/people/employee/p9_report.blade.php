@extends('administrator.master')
@section('title',(isset($selectedUser) ? ucfirst($selectedUser->name .' '. $selectedUser->father_name) : '').' P9 REPORT')
@section('main_content')
<style type="text/css">
    div.dt-buttons {
        float: right;
    }
</style>
<div class="content-wrapper wow fadeInDown" data-wow-duration=".5s" data-wow-delay=".2s">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        {{ __('P9 Report') }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('Reports') }}</a></li>
            <li class="active">{{ __('P9 Report') }}</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('P9 Report') }}</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                @if(\Auth::user()->access_label == 1)
                 <div class="col-md-6">
                    <div class="my-2">
                        <form action="{{ URL::current(); }}" method="GET">
                            <div class="mb-3" style="display: flex;">
                                <select name="employee" id="" class="form-control" style="margin-top: 10px;">
                                    <option value="">Select Employee</option>
                                    @foreach ($allEmployees as $employeeData)
                                        <option value="{{  $employeeData->id }}" {{ (request()->employee == $employeeData->id) ? 'selected' : '' }}>{{ $employeeData->name }}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-primary" style="margin: 10px;" type="submit">GET</button>
                            </div>
                        </form>
                    </div>
                </div>
                @endif
                @if(request()->employee)
                 <div class="col-md-8">
                    <div class="my-2">
                        <div class="mb-3" style="">
                            <div class="col-md-6">
                                <h4 style="margin: 5px;">Employer's Name: <span>{{ env('EMP_NAME', 0) }}</span></h4>
                                <h4 style="margin: 5px;">Employee Name: <span>{{ ucfirst($selectedUser->name .' '. $selectedUser->mother_name .' '. $selectedUser->father_name) }}</span></h4>
                            </div>
                            <div class="col-md-6">
                                <h4 style="margin: 5px;">Employer's Pin: <span>{{ env('EMP_NUMBER', 0) }}</span></h4>
                                <h4 style="margin: 5px;">Employee's KRA Pin: <span>{{ $selectedUser->kra_no }}</span></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.Notification Box -->
                <div id="customTable" class="col-md-12 table-responsive">

                    <table  class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('Month') }}</th>
{{--                                 <th>{{ __('GROSS SALARY <br> A') }}</th>
                                <th>{{ __('BENEFITS NON CASH <br> B') }}</th>
                                <th>{{ __('VALUE OF QUARTERS <br> C') }}</th>
                                <th>{{ __('TOTAL GROSS PAY <br> D (A+B+C)') }}</th>
                                <th>{{ __('NSSF CONTIBUTION BENEFIT  <br> G') }}</th>
                                <th>{{ __('CHARGEABLE PAY <br> H') }}</th>
                                <th>{{ __('TAX CHARGED <br> J') }}</th>
                                <th>{{ __('PERSONAL RELIEF <br> K') }}</th>
                                <th>{{ __('INSURANCE RELIEF <br> (15% nhif contribution)') }}</th>
                                <th>{{ __('PAYE TAX <br> L(J-K)') }}</th> --}}
                                <th>{{ __('GROSS SALARY') }}</th>
                                <th>{{ __('BENEFITS NON CASH') }}</th>
                                <th>{{ __('VALUE OF QUARTERS') }}</th>
                                <th>{{ __('TOTAL GROSS PAY') }}</th>
                                <th>{{ __('NSSF CONTIBUTION BENEFIT ') }}</th>
                                <th>{{ __('CHARGEABLE PAY') }}</th>
                                <th>{{ __('TAX CHARGED') }}</th>
                                <th>{{ __('PERSONAL RELIEF') }}</th>
                                <th>{{ __('INSURANCE RELIEF') }}</th>
                                <th>{{ __('PAYE TAX') }}</th>

                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @php($sl = 1)
                            @php($monthGross = [])
                            @php($total = [])
                            @php($total['gross'] = 0)
                            @php($total['nssf'] = 0)
                            @php($total['income'] = 0)
                            @php($total['persnol'] = 0)
                            @php($total['nhif_relief'] = 0)
                            @php($total['paye'] = 0)
                            @foreach($months as $month)
                            @php($monthGross[$month] = 0)
                            @php($sl++)
                            @php($p = $salary_payments->sum('gross_salary'))
                            @php($monthGross[$month . 'gross'] = 0)
                            @php($monthGross[$month . 'nssf'] = 0)
                            @php($monthGross[$month . 'income'] = 0)
                            @php($monthGross[$month . 'persnol'] = 0)
                            @php($monthGross[$month . 'nhif_relief'] = 0)
                            @foreach ($salary_payments as $salaray_payment)
                                @if(date('F',strtotime($salaray_payment->payment_month)) == date('F',strtotime($month)))
                                    <?php
                                      $sum             = 0.0;
                                      $gross_salary    = $salaray_payment->gross_salary;
                                      $nhif            = getNHIFRates($gross_salary);
                                      $nssf            = getNSSFRate($gross_salary);
                                      $total_deduction = $salaray_payment->total_deduction;
                                      $taxable_pay     = to_number($gross_salary) - to_number($nssf);
                                      $nhif_relief     = 0.0;
                                      $persnol_relief  = 0.0;
                                      $paye            = 0.0;
                                      $income_tax      = 0.0;

                                      if ($taxable_pay <= 24000.0) {
                                          $income_tax = to_number($taxable_pay) * 10.0/ 100.0;
                                      }
                                      if ($taxable_pay > 24000.0) {
                                          $a              = (24000.0 * 10.0/ 100.0);
                                          $b              = (8333.0 * 25.0/ 100.0);
                                          $c              = to_number($taxable_pay) - (to_number(24000.0) + to_number(8333.0));
                                          $c              = (to_number($c) * 30.0 / 100.0);
                                          $income_tax     = (to_number($a) +  to_number($b) + to_number($c));
                                          $nhif_relief    = (to_number($nhif) * 15.0/ 100.0);
                                          $persnol_relief = 2400.0;
                                          $paye           = to_number($income_tax) - (to_number($nhif_relief) + to_number($persnol_relief));
                                      }
                                      
                                      // exit(between(5000,0,5000));
                                      $pay_after_tax = to_number($taxable_pay) - to_number($paye);
                                      $net_pay       = to_number($pay_after_tax) - to_number($nhif);
                                      $deduction     = $salaray_payment->total_deduction;
                                      $t_deduction   = (to_number($deduction) + to_number($paye));
                                      $net_salary    = to_number($gross_salary) - to_number($t_deduction);
                                    ?>
                                    @php($monthGross[$month . 'gross'] = $salaray_payment->gross_salary)
                                    @php($monthGross[$month . 'nssf'] = $nssf)
                                    @php($monthGross[$month . 'income'] = $income_tax)
                                    @php($monthGross[$month . 'paye'] = $paye)
                                    @php($monthGross[$month . 'persnol'] = $persnol_relief)
                                    @php($monthGross[$month . 'nhif_relief'] = $nhif_relief)

                                    @php($total['gross'] += $salaray_payment->gross_salary)
                                    @php($total['nssf'] += $nssf)
                                    @php($total['income'] += $income_tax)
                                    @php($total['paye'] += $paye)
                                    @php($total['persnol'] += $persnol_relief)
                                    @php($total['nhif_relief'] += $nhif_relief)
                                    {{-- @php($taxable_pay = $salaray_payment->gross_salary - $employee['nssf']) --}}
                                @endif
                            @endforeach

                            <tr>
                                <td>{{ date('F',strtotime($month)) }}</td>
                                <td>{{ number_format($monthGross[$month . 'gross'] ?? 0,2) }}</td>
                                <td>0</td>
                                <td>0</td>
                                <td>{{ number_format($monthGross[$month . 'gross'] ?? 0,2) }}</td>
                                <td>{{ number_format($monthGross[$month . 'nssf'] ?? 0 ?? 0,2) }}</td>
                                <td>{{ number_format(($monthGross[$month . 'gross'] ?? 0) - ($monthGross[$month . 'nssf'] ?? 0) ,2) }}</td>
                                <td>{{ number_format($monthGross[$month . 'income'] ?? 0 ?? 0,2) }}</td>
                                <td>{{ number_format($monthGross[$month . 'persnol'] ?? 0 ?? 0,2) }}</td>
                                <td>{{ number_format($monthGross[$month . 'nhif_relief'] ?? 0 ?? 0,2) }}</td>
                                <td>{{ number_format($monthGross[$month . 'paye'] ?? 0 ?? 0,2) }}</td>
                            </tr>
                            @php($nssf = 0)
                            @php($taxable_pay = 0)
                            @endforeach
                            <tr>
                                <td>{{ __('Total') }}</td>
                                <td>{{ number_format($total['gross'] ?? 0,2) }}</td>
                                <td>0</td>
                                <td>0</td>
                                <td>{{ number_format($total['gross'] ?? 0,2) }}</td>
                                <td>{{ number_format($total['nssf'] ?? 0 ?? 0,2) }}</td>
                                <td>{{ number_format(($total['gross'] ?? 0) - ($total['nssf'] ?? 0) ,2) }}</td>
                                <td>{{ number_format($total['income'] ?? 0 ?? 0,2) }}</td>
                                <td>{{ number_format($total['persnol'] ?? 0 ?? 0,2) }}</td>
                                <td>{{ number_format($total['nhif_relief'] ?? 0 ?? 0,2) }}</td>
                                <td>{{ number_format($total['paye'] ?? 0 ?? 0,2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<?php
    function getNHIFRates($x = null)
    {
        $nhif = 0.0;
        if (between($x, 0.0, 5999.0)) {
            $nhif = 150.0;
        } else if (between($x, 6000.0, 8999.0)) {
            $nhif = 300.0;
        } else if (between($x, 8000.0, 11999.0)) {
            $nhif = 400.0;
        } else if (between($x, 12000.0, 14999.0)) {
            $nhif = 500.0;
        } else if (between($x, 15000.0, 19999.0)) {
            $nhif = 600.0;
        } else if (between($x, 20000.0, 24999.0)) {
            $nhif = 750.0;
        } else if (between($x, 25000.0, 29999.0)) {
            $nhif = 850.0;
        } else if (between($x, 30000.0, 34999.0)) {
            $nhif = 900.0;
        } else if (between($x, 35000.0, 39000.0)) {
            $nhif = 950.0;
        } else if (between($x, 40000.0, 44999.0)) {
            $nhif = 1000.0;
        } else if (between($x, 45000.0, 49000.0)) {
            $nhif = 1100.0;
        } else if (between($x, 50000.0, 59999.0)) {
            $nhif = 1200.0;
        } else if (between($x, 60000.0, 69999.0)) {
            $nhif = 1300.0;
        } else if (between($x, 70000.0, 79999.0)) {
            $nhif = 1400.0;
        } else if (between($x, 80000.0, 89999.0)) {
            $nhif = 1500.0;
        } else if (between($x, 90000.0, 99999.0)) {
            $nhif = 1600.0;
        } else if ($x > 100000.0) {
            $nhif = 1700.0;
        } else {
            $nhif = 0.0;
        }
        return $nhif;
    }
    function getNSSFRate($x = null)
    {
        $NSSF = 0.0;
        if (between($x, 0.0, 18000.0)) {
            $NSSF = (to_number($x) * 6.0/ 100.0);
        } else if ($x > 18000.0) {
            $NSSF = 1080.0;
        }
        
        return $NSSF;
    };
    function between ($x = null, $min = null, $max = null)
    {
        return ($x >= $min && $x <= $max) ? true : false;
    };
    function to_number($x) {
        return $x;
    }
?>

@endsection
@section('script.bottom')
<script type="text/javascript">
    $(function () {
     $('#customTable').find('table').DataTable({
         dom: 'Bfrtip',
         buttons: [
             'copy', 'csv', 'excel', 'pdf', 'print'
         ],
         'paging'      : false,
         'lengthChange': false,
         'searching'   : false,
         'ordering'    : false,
         'info'        : true,
         'autoWidth'   : false
     })
    })
</script>
@endsection