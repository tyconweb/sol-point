@extends('administrator.master')
@section('title', __(date('F Y',strtotime(request()->date ?? date('F Y')))  .' DETAILED PAYROLL REPORT'))
@section('main_content')
<div class="content-wrapper wow fadeInDown" data-wow-duration=".5s" data-wow-delay=".2s">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        {{ __('Employees Detailed Report') }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('Employee') }}</a></li>
            <li class="active">{{ __('Employees Detailed Report') }}</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Salary List') }}</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                 <div class="col-md-6">
                    <div class="my-2">
                        <form action="{{ URL::current(); }}" method="GET">
                            <div class="mb-3" style="display: flex;">
                                <input type="date" class="form-control" style="margin-top: 10px;" name="date" value="{{ request()->date ?? '' }}">
                                <button class="btn btn-primary" style="margin: 10px;" type="submit">GET</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- /.Notification Box -->
                <div id="printable_area" class="col-md-12 table-responsive">
                    <table  class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('Full Name') }}</th>
                                <th>{{ __(' B. SALARY') }}</th>
                                <th>{{ __(' T. ALLOWANCES') }}</th>
                                <th>{{ __(' PAYE') }}</th>
                                <th>{{ __(' NSSF') }}</th>
                                <th>{{ __(' NHIF') }}</th>
                                <th>{{ __(' LOAN') }}</th>
                                <th>{{ __(' GROSS PAY') }}</th>
                                <th>{{ __(' T.DEDS') }}</th>
                                <th>{{ __(' NET SALARY') }}</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @php($sl = 1)
                            @php($totalBasicSalary = 0)
                            @php($tAllowance = 0)
                            @php($totalPaye = 0)
                            @php($totalNssf = 0)
                            @php($totalNhif = 0)
                            @php($totalloan = 0)
                            @php($totalGrossPay = 0)
                            @php($totalDeduction = 0)
                            @php($totalNetSalary = 0)
                            @foreach($employees as $employee)
                            @php($debits = 0)
                            @php($credits = 0)
                            @php($al = 0)
                            @php($loanAmm = 0)
                            @php($credits += ($employee['house_rent_allowance'] + $employee['medical_allowance'] + $employee['special_allowance'] + $employee['other_allowance']))
                            @php($debits += $employee['tax_deduction'] + $employee['provident_fund_deduction'] + $employee['other_deduction'] + $employee['nhif'] + $employee['nssf'])
                            @php($debits += $employee['paye'])
                            @foreach($bonuses as $bonus)
                                @if($employee['user_id'] == $bonus['user_id'])
                                    @php($credits += $bonus['bonus_amount'])
                                @endif
                            @endforeach

                            @foreach($deductions as $deduction)
                                @if($employee['user_id'] == $deduction['user_id'])
                                    @php($debits += $deduction['deduction_amount'])
                                @endif
                            @endforeach
                            @foreach($allowances as $allowance)
                                @if($employee['user_id'] == $allowance['user_id'])
                                    @php($credits += $allowance['deduction_amount'])
                                @endif
                            @endforeach

                            @foreach($loans as $loan)
                                @if($employee['user_id'] == $loan['user_id'])
                                    @php($installment = $loan['loan_amount'] / $loan['remaining_installments'])
                                    @php($loanAmm += $installment)
                                @endif
                            @endforeach
                            <tr>
                                <td>{{ $employee['name'].' '.$employee['mother_name'] .' '.$employee['father_name'] }}</td>
                                {{-- FOR TOTAL BASIC SALARY --}}
                                @php($totalBasicSalary += $employee['basic_salary'])
                                <td>{{ number_format ($employee['basic_salary'], 2, '.', ',') }}</td>
                                {{-- FOR TOTAL ALL ALLOWANCE --}}
                                @php($tAllowance += $credits)
                                <td>{{ number_format ($credits, 2, '.', ',') }}</td>
                                {{-- FOR TOTAL ALL PAYE --}}
                                @php($totalPaye += $employee['paye'])
                                <td>{{ number_format ($employee['paye'], 2, '.', ',') }}</td>
                                {{-- FOR TOTAL ALL NSSF --}}
                                @php($totalNssf += $employee['nssf'])
                                <td>{{ number_format ($employee['nssf'], 2, '.', ',') }}</td>
                                {{-- FOR TOTAL ALL NHIF --}}
                                @php($totalNssf += $employee['nhif'])
                                <td>{{ number_format ($employee['nhif'], 2, '.', ',') }}</td>
                                {{-- FOR TOTAL ALL LOAN AMOUT --}}
                                @php($totalloan += $loanAmm)
                                <td>{{ number_format ($loanAmm, 2, '.', ',') }}</td>
                                {{-- FOR TOTAL ALL GROSS PAY --}}
                                @php($totalGrossPay += $credits+$employee['basic_salary'])
                                <td>{{ number_format ($credits+$employee['basic_salary'], 2, '.', ',') }}</td>
                                {{-- FOR TOTAL ALL LOAN AMOUT --}}
                                @php($totalDeduction += $debits)
                                <td>{{ number_format ($debits, 2, '.', ',') }}</td>
                                {{-- FOR TOTAL ALL NET PAY --}}
                                @php($totalNetSalary += $employee['net_pay'])
                                <td>{{ number_format ($employee['net_pay'], 2, '.', ',') }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td>Total</td>
                                <td>{{ 'KES '.number_format($totalBasicSalary,2,'.',',') }}</td>
                                <td>{{ 'KES '.number_format($tAllowance,2,'.',',') }}</td>
                                <td>{{ 'KES '.number_format($totalPaye,2,'.',',') }}</td>
                                <td>{{ 'KES '.number_format($totalNssf,2,'.',',') }}</td>
                                <td>{{ 'KES '.number_format($totalNssf,2,'.',',') }}</td>
                                <td>{{ 'KES '.number_format($totalloan,2,'.',',') }}</td>
                                <td>{{ 'KES '.number_format($totalGrossPay,2,'.',',') }}</td>
                                <td>{{ 'KES '.number_format($totalDeduction,2,'.',',') }}</td>
                                <td>{{ 'KES '.number_format($totalNetSalary,2,'.',',') }}</td>  
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
@endsection