@extends('administrator.master')
@section('title', __('Employee'))

@section('main_content')
<div class="content-wrapper wow fadeInDown" data-wow-duration=".5s" data-wow-delay=".2s">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ __('Employee') }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('Employee') }}</a></li>
            <li class="active">{{ __('Employee') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Manage Employee') }}</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="d-flex-inline">
                    <!--<div  class="col-md-3">-->
                    <!--    <a href="{{ url('/people/employees/create') }}" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i>{{ __(' Add') }} </a>-->
                    <!--</div>           -->
                    <div  class="col-md-9">
                        <input type="text" id="myInput" class="form-control" placeholder="{{ __('Search..') }}">
                    </div>
                </div>

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
                                <th>{{ __(' SL#') }}</th>
                                <th>{{ __(' ID') }}</th>
                                <th>{{ __('Full Name') }}</th>
                                <th>{{ __(' ID No') }}</th>
                                <th>{{ __(' Phone No') }}</th>
                                <th>{{ __(' Designation') }}</th>
                                <th>{{ __(' Status') }}</th>
                                <th class="text-center">{{ __('Added') }}</th>
                                <th class="text-center">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @php $sl = 1; @endphp
                            @foreach($employees as $employee)
                            <tr>
                                <td><a href="/people/employees/details/{{ $employee['id'] }}">{{ $sl++ }}</a></td>
                                <td>{{ $employee['id'] }}</td>
                                <td>{{ $employee['name'].' '.$employee['mother_name'] .' '.$employee['father_name'] }}</td>
                                <td>{{ $employee['id_number'] }}</td>
                                <td>{{ $employee['contact_no_one'] }}</td>
                                <td>{{ $employee['designation'] }}</td>
                                <td>
                                    @if ($employee['activation_status'] == 1)
                                    <div class="btn-group">
                                        <a href="{{ url('/people/employees/deactive/' . $employee['id'])}}" class="tip btn btn-success btn-flat" data-toggle="tooltip" data-original-title="Click to disable">
                                            <i class="fa fa-arrow-down"></i>
                                            <span class="hidden-sm hidden-xs"> {{ __('Activated') }}</span>
                                        </a>
                                    </div>
                                    @else
                                    <div class="btn-group">
                                        <a href="{{ url('/people/employees/active/' . $employee['id'])}}" class="tip btn btn-warning btn-flat" data-toggle="tooltip" data-original-title="Click to active">
                                            <i class="fa fa-arrow-up"></i>
                                            <span class="hidden-sm hidden-xs"> {{ __('Disabled') }}</span>
                                        </a>
                                    </div>
                                    @endif
                                </td>  
                                <td class="text-center">{{ date("d F Y", strtotime($employee['created_at'])) }}</td>
                               
                                <td class="text-center">
                                   <a href="{{ url('/people/employees/edit/' . $employee['id']) }}"><i class="icon fa fa-edit"></i> {{ __('Edit') }}</a>
                                </td>
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