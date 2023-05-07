<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>{{ $user['name'] }} {{ __('Details') }}</title>
  <style>
      h3{
          margin-top: 10px;
      }
      .text-center h3{
          padding-bottom: 20px;
      }
      .text-center{
          text-align: center;
          width: 50%;
          /*padding: 30px;*/
      }
      
      body{
          width: 100% !important;
          margin: 0px;
      }
      table{
          width: 60% !important;
      }
  </style>
</head>
<body>
  <?php
    $sum             = 0.0;
    $gross_salary    = $salary_payment->gross_salary;
    $nhif            = getNHIFRates($gross_salary);
    $nssf            = getNSSFRate($gross_salary);
    $total_deduction = $salary_payment->total_deduction;
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
    $deduction     = $salary_payment->total_deduction;
    $t_deduction   = (to_number($deduction) + to_number($paye));
    $net_salary    = to_number($gross_salary) - to_number($t_deduction);
    
    
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
  <!--<div class="header">-->
  <!--  <img src="{{ url('public/backend/img/corporatelogo.png') }}">-->
  <!--</div>-->
  <!--<div class="footer"><p>{{ __('Page:') }} <span class="pagenum"></span></p></div>-->
  <div class="container">
    <div class="text-center">
      <h3 class=""> <b>{{ env('APP_NAME') }}</b> <br> {{ __('PAYSLIP') }}</h3>
    </div>
    <table>
      <tr>
        <td class="h3-display">
          <tr>
            <td>Full Name: </td>
            <td>{{ $user['name'] .' '. $user['father_name'] .' ' . $user['mother_name'] }}</td>
          </tr>
          <tr>
            <td>KRA PIN: </td>
            <td>
              {{ $user['kra_no'] }}
            </td>
          </tr>
          <tr>
            <td>NHIF No: </td>
            <td>
              {{ $user['nhif_no'] }}
            </td>
          </tr>
          <tr>
            <td>NSSF No: </td>
            <td>
              {{ $user['nssf_no'] }}
            </td>
          </tr>
          <tr>
            <td>Designation: </td>
            <td>
              ({{ $user['designation'] }})
            </td>
          </tr>
          <tr>
            <td>{{ __('Department of') }} </td>
            <td>
              {{ $user['department'] }}
            </td>
          </tr>
          <tr>
            <td>{{ __('Payroll No: ') }} </td>
            <td>
               {{ $salary_payment->id }}
            </td>
          </tr>
          <tr>
            <td>{{ __('Currency: ') }} </td>
            <td>
              {{ __('KES') }}
            </td>
          </tr>
          <tr>
            <td>{{ __('Month: ') }}</td>
            <td>
              {{ date("F Y", strtotime(now())) }}
            </td>
          </tr>
        <!--<td>-->
        <!--  @if(!empty($user['avatar']))-->
        <!--  <img src="{{ url('public/profile_picture/' . $user['avatar']) }}" class="img-responsive img-thumbnail" width="140px">-->
        <!--  @else-->
        <!--  <img src="{{ url('public/profile_picture/blank_profile_picture.png') }}" alt="blank_profile_picture" class="img-responsive img-thumbnail" width="160px">-->
        <!--  @endif-->
        <!--</td>-->
      </tr>
    </table>
    <table>
        <tr>
          <td>
            <h3>
              Earnings:
            </h3>
          </td>
      </tr>
      @php($sl = 1)
      @php($amount = 0)
      @foreach($salary_payment_details->where('status','credits') as $data)
      <tr>
        <td>{{ $data->item_name }}</td>
        <td>&nbsp;</td>
        <td>
          @if($data->status == 'credits')
          {{ $data->amount }}
            @if($sl != 1)
                @php($amount += $data->amount)
            @endif
            @php($sl++)
          @endif
        </td>
      </tr>
      @endforeach
          
      <tr>
        <td>
            <h3>Deductions:</h3>
        </td>
      </tr>
            
      @foreach($salary_payment_details->where('status','debits') as $data)
      <tr>
        <td>{{ $data->item_name }}</td>
        <td>&nbsp;</td>
        <td>

          @if($data->status == 'debits')
          -{{ $data->amount }}
          @endif
        </td>
      </tr>
      @endforeach
      <!--<tr>-->
      <!--  <td>{{ __('NHIF') }}</td>-->
      <!--  <td>&nbsp;</td>-->
      <!--  <td>-->
      <!--      -{{ __($nhif) }}-->
      <!--  </td>-->
      <!--</tr>-->
      <!--<tr>-->
      <!--  <td>{{ __('NSSF') }}</td>-->
      <!--  <td>&nbsp;</td>-->
      <!--  <td>-->
      <!--      -{{ __($nssf) }}-->
      <!--  </td>-->
      <!--</tr>-->
      <tr>
        <td> &nbsp; </td>
      </tr>
      <tr class="success">
        <td><strong class="pull-right">{{ __('Gross Salary:') }}</strong></td>
        <td>&nbsp;</td>
        <td>
          <strong>
            {{ number_format($salary_payment->gross_salary, 2, '.', '') }}
          </strong>
        </td>
      </tr>
      <tr class="success">
        <td><strong class="pull-right">{{ __('Persnol Relief:') }}</strong></td>
        <td>&nbsp;</td>
        <td>
          <strong>
            {{ number_format($persnol_relief, 2, '.', '') }}
          </strong>
        </td>
      </tr>
      <tr class="success">
        <td><strong class="pull-right">{{ __('NHIF Relief:') }}</strong></td>
        <td>&nbsp;</td>
        <td>
          <strong>
            {{ number_format($nhif_relief, 2, '.', '') }}
          </strong>
        </td>
      </tr>
      
      <tr class="success">
        <td><strong class="pull-right">{{ __('P.A.Y.E:') }}</strong></td>
        <td>&nbsp;</td>
        <td><strong>{{ number_format($paye, 2, '.', '') }}</strong></td>
      </tr>
      <tr class="success">
        <td><strong class="pull-right">{{ __('Total Allowance:') }}</strong></td>
        <td>&nbsp;</td>
        <td><strong>{{ number_format($amount, 2, '.', '') }}</strong></td>
        </tr>
      <tr class="success">
        <td><strong class="pull-right">{{ __('Total Deduction:') }}</strong></td>
        <td>&nbsp;</td>
        <td><strong>{{ number_format($t_deduction, 2, '.', '') }}</strong></td>
      </tr>
      <tr class="success">
        <td><strong class="pull-right">{{ __('Net Pay:') }}</strong></td>
        <td>&nbsp;</td>
        <td><strong>{{ number_format($net_salary, 2, '.', '') }}</strong></td>
      </tr>
      <tr class="success">
        <td><strong class="pull-right">{{ __('Provident Fund:') }}</strong></td>
        <td>&nbsp;</td>
        <td><strong>{{ number_format($salary_payment->provident_fund, 2, '.', '') }}</strong></td>
    <tr>

    </table>

    <table>
      <tr>
        <td>{{ __('Prepared By') }}</td>
        <td>{{ __('Receiver Signature') }}</td>
        <td>{{ __('Approval Signature') }}</td>
      </tr>
    </table>
  </div>
</body>
</html>