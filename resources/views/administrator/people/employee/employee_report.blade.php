@extends('administrator.master')
@section('title', __('Employee'))
@section('main_content')
<div class="content-wrapper wow fadeInDown" data-wow-duration=".5s" data-wow-delay=".2s">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        {{ __('Employees Report') }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('Employee') }}</a></li>
            <li class="active">{{ __('Employees Report') }}</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Employees List') }}</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                 <div class="col-md-6">
                    <div class="my-2">
                        <form action="{{ URL::current(); }}" method="GET">
                            <div class="mb-3" style="display: flex;">
                                <input type="date" class="form-control" style="margin-top: 10px;" name="start_date" value="{{ request()->start_date ?? '' }}">
                                <input type="date" class="form-control" style="margin: 10px;" name="end_date" value="{{ request()->end_date ?? '' }}">
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
                                <th>{{ __(' EMP-NO') }}</th>
                                <th>{{ __(' EMP Full Name') }}</th>
                                <th>{{ __(' ID No') }}</th>
                                <th>{{ __(' Designation') }}</th>
                                <th>{{ __(' Gender') }}</th>
                                <th>{{ __(' D.O.B') }}</th>
                                <th>{{ __(' NSSF No') }}</th>
                                <th>{{ __(' NHIF No') }}</th>
                                <th>{{ __(' KRA PIN') }}</th>
                                <th>{{ __(' Bank Name') }}</th>
                                <th>{{ __(' Account No') }}</th>
                                <th class="text-center">{{ __('Added') }}</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @foreach($employees as $employee)
                            <tr>
                                <td>{{ sprintf('%04s', $employee['employee_id']) }}</td>
                                <td>{{ $employee['name'].' '.$employee['mother_name'] .' '.$employee['father_name'] }}</td>
                                <td>{{ $employee['id_number'] }}</td>
                                <td>{{ $employee['designation'] }}</td>
                                <td>{{ ($employee['gender']=='m') ? 'Male' : 'Female' }}</td>
                                <td>{{ date("d F Y", strtotime($employee['date_of_birth'])) }}</td>
                                <td>{{ $employee['nssf_no'] }}</td>
                                <td>{{ $employee['nhif_no'] }}</td>
                                <td>{{ $employee['kra_no'] }}</td>
                                <td>{{ $employee['bank_name'] }}</td>
                                <td>{{ $employee['bank_acc_no'] }}</td>
                                <td class="text-center">{{ date("d F Y", strtotime($employee['created_at'])) }}</td>
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