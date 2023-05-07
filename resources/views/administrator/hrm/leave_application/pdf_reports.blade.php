<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ __('Leave Report') }}</title>
</head>
<body>
    <div class="header">
        <img src="{{ url('public/backend/img/corporatelogo.png') }}">
    </div>
    <div class="footer"><p>{{ __('Page:') }} <span class="pagenum"></span></p></div>
    <div class="container table-responsive">
       <table>
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

    <div>
        <p>{{ __('Prepared By') }}</p>
        <p>{{ __('Authorised Signature') }}</p>
    </div>
</div>
</body>
</html>