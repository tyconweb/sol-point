@extends('administrator.master')
@section('title', __('NHIF Report'))

@section('main_content')
<div class="content-wrapper wow fadeInDown" data-wow-duration=".5s" data-wow-delay=".2s">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ __('NHIF') }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('NHIF') }}</a></li>
            <li class="active">{{ __('NHIF Report') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('NHIF Report') }}</h3>

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
                    <div class="row">
                        <div class="col-md-12" style="margin: 10px 0;">
                            {{-- <h5><b>EMPLOYER CODE</b>   75988</h5> --}}
                            <h5><b>EMPLOYER NAME</b>   SOL POINT BASE LTD</h5>
                            <h5>
                                <b>MONTH OF CONTRIBUTION</b>   {{ date('F Y ') }}
                            </h5>
                        </div>
                    </div>
                        <thead>
                            <tr>
                                <th width="10%">{{ __(' PAYROLL NO') }}</th>
                                <th>{{ __(' FIRST NAME') }}</th>
                                <th>{{ __(' LAST NAME') }}</th>
                                <th>{{ __(' ID NO') }}</th>
                                <th>{{ __(' NHIF NO') }}</th>
                                <th>{{ __(' NHIF Amount') }}</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @php $sl = 1; @endphp
                            @php $total = 0; @endphp
                            @foreach($employees as $employee)
                            @php
                                $nhif = $employee['nhif'];
                            @endphp
                            <tr>
                                <td>{{ $employee['employee_id'] }}</td>
                                <td>{{ $employee['name'] }}</td>
                                <td>{{ $employee['mother_name'] .' '.$employee['father_name'] }}</td>
                                <td>{{ $employee['id_number'] }}</td>
                                <td>{{ $employee['nhif_no'] }}</td>
                                <td>{{ $nhif }}</td>
                                @php $total += $nhif; @endphp
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                              <td> &nbsp; </td>
                              <td> &nbsp; </td>
                              <td> &nbsp; </td>
                              <td> &nbsp; </td>
                              <td> &nbsp; </td>
                              <td> &nbsp; </td>
                            </tr>
                            <tr class="info">
                              <td> &nbsp; </td>
                              <td> &nbsp; </td>
                              <td> &nbsp; </td>
                              <td> &nbsp; </td>
                              <td><strong>{{ __('Total:') }}</strong></td>
                              <td>{{ $total }}</td>
                            </tr>
                        </tfoot>
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