@extends('administrator.master')
@section('title', __('NSSF Report'))

@section('main_content')
<div class="content-wrapper wow fadeInDown" data-wow-duration=".5s" data-wow-delay=".2s">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ __('NSSF') }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('NSSF') }}</a></li>
            <li class="active">{{ __('NSSF') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('NSSF Report') }}</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
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
            <div id="printable_area" class="col-md-12 table-responsive">
                   <table  class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="12%">{{ __(' PAYROLL NUMBER') }}</th>
                                <th>{{ __(' SURNAME') }}</th>
                                <th>{{ __(' OTHER NAMES') }}</th>
                                <th>{{ __(' ID NO') }}</th>
                                <th>{{ __(' KRA PIN') }}</th>
                                <th>{{ __(' NSSF NO') }}</th>
                                <th>{{ __(' GROSS PAY') }}</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @php $sl = 1; @endphp
                            @foreach($employees as $employee)
                            @php
                                $allowance = $employee['house_rent_allowance'] + $employee['medical_allowance'] + $employee['special_allowance'] + $employee['other_allowance'];
                                $gross_salary= $employee['basic_salary'] + $allowance;
                            @endphp
                            <tr>
                                <td>{{ $employee['employee_id'] }}</td>
                                <td>{{ $employee['name'] }}</td>
                                <td>{{ $employee['mother_name'] .' '.$employee['father_name'] }}</td>
                                <td>{{ $employee['id_number'] }}</td>
                                <td>{{ $employee['kra_no'] }}</td>
                                <td>{{ $employee['nssf_no'] }}</td>

                                <td>{{ $gross_salary }}</td>
                            </tr>
                            @endforeach
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