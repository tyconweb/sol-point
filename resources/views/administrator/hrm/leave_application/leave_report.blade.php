@extends('administrator.master')
@section('title', __('Leave Application Lists'))

@section('main_content')
<div class="content-wrapper wow fadeInDown" data-wow-duration=".5s" data-wow-delay=".2s">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           {{ __('Leave Reports') }} 
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('Leave') }}</a></li>
            <li class="active">{{ __('Leave Application lists') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Leave Application lists') }}</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-6">
                    <div class="my-2">
                        <form action="{{ URL::current(); }}" method="GET">
                            <div class="mb-3" style="display: flex;">
                                <input type="date" class="form-control" style="margin: 10px;" name="start_date" value="{{ request()->start_date ?? '' }}">
                                <input type="date" class="form-control" style="margin: 10px;" name="end_date" value="{{ request()->end_date ?? '' }}">
                                <button class="btn btn-primary" style="margin: 10px;" type="submit">GET</button>
                            </div>
                        </form>
                    </div>
                </div>
                <br><br>
                <div id="printable_area" class="col-md-12">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('SL') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Designation') }}</th> 
                                <th>{{ __('Applied Leave (Approved)') }}</th>
                                <th>{{ __('Requested Leave') }}</th>
                                <th>{{ __('Total Leave') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($sl = 1)
                            @php($total_leave = 0)
                            @php($total_requested_leave = 0)
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $sl++ }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->employee_id }}</td>
                                <td>{{ $user->designation }}</td>
                                <td>
                                    @foreach($applied_leaves as $applied_leave)
                                    @if($user->id == $applied_leave->created_by)
                                    {{ $applied_leave->leave_application }}
                                    @php($total_leave += $applied_leave->leave_application)
                                    @endif
                                    @endforeach

                                </td>
                                <td>
                                    @foreach($requested_leaves as $requested_leave)
                                    @if($user->id == $requested_leave->created_by)
                                    {{ $requested_leave->leave_application }}
                                    @php($total_requested_leave += $requested_leave->leave_application)
                                    @endif
                                    @endforeach
                                </td>
                                <td>
                                    {{ $total_leave+$total_requested_leave }}
                                    @php($total_leave = 0)
                                    @php($total_requested_leave = 0)
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
