@extends('administrator.master')
@section('title', __('Add Leave Application'))

@section('main_content')
<div class="content-wrapper wow fadeInDown" data-wow-duration=".5s" data-wow-delay=".2s">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      {{ __('Add Leave Application') }}
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
      <li><a>{{ __('Setting') }}</a></li>
      <li><a href="{{ url('/hrm/leave_application') }}">{{ __('Add Leave Application') }}</a></li>
      <li class="active">{{ __('Add Leave Application') }}</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- SELECT2 EXAMPLE -->
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">{{ __('Add Leave Application') }}</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      <form action="{{ url('/hrm/leave_application/store') }}" method="post" name="add_form_leave_application">
        {{ csrf_field() }}
        <div class="box-body">
          <div class="row">
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
              @else
              <p class="text-yellow">{{ __('Enter New Application details. All field are required.') }} </p>
              @endif
            </div>
            <!-- /.Notification Box -->

            <div class="col-md-6">
              <label for="leave_category">{{ __('Leave Category ') }} <span class="count-leave"></span><span class="text-danger">*</span></label>
              <div class="form-group{{ $errors->has('leave_category') ? ' has-error' : '' }} has-feedback">
                <select name="leave_category_id" id="leave_category_id"  class="form-control">
                  <option value="" selected disabled>{{ __('Select one') }}</option>
                  @foreach( $leave_categorys as $leave_category)
                  <option value="{{ $leave_category->id }}"> {{ $leave_category->leave_category }} </option>
                  @endforeach
                </select>
                @if ($errors->has('leave_category'))
                <span class="help-block">
                  <strong>{{ $errors->first('leave_category') }}</strong>
                </span>
                @endif
              </div>
              <!-- /.form-group -->
              <div class="row">
                <p class="text-yellow">{{ __('Sunday will not be count in leave days.') }} </p>
                <div class="col-md-6">
                  <div class="form-group">
                  <label>{{ __('Start Date:') }}</label>

                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="date" min="{{ date('Y-m-d') }}" value-x="{{ date('Y-m-d') }}" name="start_date" title="Please Select Category First" class="form-control pull-right" disabled id="my-datepicker">
                  </div>
                  <!-- /.input group -->
                  <span class="Leave_Duration"></span>
                </div>

                </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>{{ __('End Date:') }}</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="date" name="end_date" min="{{ date('Y-m-d') }}" title="Please Select Category First" value-x="{{ date('Y-m-d') }}" class="form-control pull-right" disabled id="my-datepicker2">
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
                
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-12">
              <label for="reason">{{ __('Reason') }} <span class="text-danger">*</span></label>
              <div class="form-group{{ $errors->has('reason') ? ' has-error' : '' }} has-feedback">
                <textarea class="textarea text-description" name="reason"  placeholder="{{ __('Enter reason Details..') }}">{{ old('reason') }}</textarea>
                @if ($errors->has('reason'))
                <span class="help-block">
                  <strong>{{ $errors->first('reason') }}</strong>
                </span>
                @endif
              </div>
              <!-- /.form-group -->


                <label for="during_leave">{{ __('Bottom Section') }} <span class="text-danger"></span></label>
              <div class="form-group{{ $errors->has('during_leave') ? ' has-error' : '' }} has-feedback">
                <input type="text" name="during_leave" id="during_leave" class="form-control" value="{{ old('during_leave') }}" placeholder="{{ __('Therefore, I request you to kindly grant me leave for .. Enter here') }}">
                @if ($errors->has('during_leave'))
                <span class="help-block">
                  <strong>{{ $errors->first('during_leave') }}</strong>
                </span>
                @endif
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <input type="hidden" name="leave_count">   
        <!-- /.box-body -->
        <div class="box-footer">
          <a href="{{ url('/hrm/leave_application') }}" class="btn btn-danger btn-flat"><i class="icon fa fa-close"></i> {{ __('Cancel') }}</a>
          <button type="submit" class="btn btn-primary btn-flat submitBtn"><i class="icon fa fa-plus"></i> {{ __('Add leave application') }}</button>
        </div>
      </form>
    </div>
    <!-- /.box -->
    <input type="hidden" class="remainLeaves">

  </section>
  <!-- /.content -->
</div>
@endsection
@section('script.bottom')
<script>
    $('#leave_category_id').on('change',function(){
       let id =  $(this).val();
       if($('#leave_category_id').parent().hasClass('has-error')){
           $('#leave_category_id').parent().removeClass('has-error')
       }
       $.get('{{ route('leave.count') }}',{id: id}).then(function(response){
            $('.count-leave').text(`(${response.current}/${response.max})`);
            if(response.current == response.max){
                $('#leave_category_id').parent().addClass('has-error');
                $('.submitBtn').attr('disabled',true);
            }
            $('.remainLeaves').val(response.max - response.current);
            $('.submitBtn').attr('disabled',false);
            $("[name='start_date'] , [name='end_date']").attr('disabled',false).attr('title','');
            
       }).catch(function(error){
           console.log(error);
       });
    });
    $(document).ready(function(){
        $("[name='start_date'] , [name='end_date']").on('change',function(){
            checkHalfDay();
        });
        // checkHalfDay();
        function checkHalfDay(){
           let startDate = $('[name="start_date"]').val();
           let endDate = $('[name="end_date"]').val();
           let remainLeaves = $('.remainLeaves').val();
           var date1 = new Date(endDate);
           var date2 = new Date(startDate);
           var timeDiff = Math.abs(date2.getTime() - date1.getTime());
           var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

           // handle the case when the start and end dates are the same and the leave duration is half a day
           if (diffDays == 0 && startDate != endDate) {
               var startHalfDay = $('[name="start_half_day"]').is(':checked');
               var endHalfDay = $('[name="end_half_day"]').is(':checked');
               if ((startHalfDay && !endHalfDay) || (!startHalfDay && endHalfDay)) {
                   diffDays = 0.5;
               }
           }

           // handle the case when the start and end dates are the same and the leave duration is a full day
           if (diffDays == 0 && startDate == endDate) {
               var startHalfDay = $('[name="start_half_day"]').is(':checked');
               var endHalfDay = $('[name="end_half_day"]').is(':checked');
               if (!startHalfDay && !endHalfDay) {
                   diffDays = 1;
               }
           }

           // loop over the dates between date1 and date2, excluding Sundays
           if (diffDays > 0) {
               for (var i = date2.getTime(); i <= date1.getTime(); i += (24 * 60 * 60 * 1000)) {
                   var d = new Date(i);
                   if (d.getDay() === 0) {
                       diffDays--;
                   }
               }
           }

           if(diffDays > remainLeaves){
               $("[name='start_date'] , [name='end_date']").parent().addClass('has-error');
               $('.submitBtn').attr('disabled',true);
           }else{
               $('.submitBtn').attr('disabled',false);
               $("[name='start_date'] , [name='end_date']").parent().removeClass('has-error');
           }

           $('[name="leave_count"]').val(diffDays != 0 ? diffDays : 0.5);

           if(diffDays == 0){
               $('.Leave_Duration').text('');
               $("[name='end_date']").parent().parent().parent().after(`<div class="col-md-6 half-show">
               <div class="form-group"><label for="">{{ __('Select Half day leave ') }} <span class="text-danger">*</span></label>
               <select name="" id=""  class="form-control">
                 <option value="" selected disabled>{{ __('Select one') }}</option>
                 <option value="">{{ __('8AM to 12PM') }}</option>
                 <option value="">{{ __('12PM to 5PM') }}</option>
               </select>
             </div></div>`);
           }else{
               $('.half-show').remove();
               $('.Leave_Duration').text(`${diffDays != 0 ? diffDays : 'Half'} ${diffDays > 1 ? 'Days' : 'Day'}`);
           }

        }
    });
</script>
@endsection