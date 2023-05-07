<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $employee->name }} {{ __('Details') }}</title>

    

</head>
<body>
    <div class="header">
        <img src="{{ url('public/backend/img/corporatelogo.png') }}">
    </div>
    <div class="footer"><p>{{ __('Page:') }} <span class="pagenum"></span></p></div>
    <div class="container">
        <table>
            <tr>
                <td>
                    <p>
                        {{ $employee->name }}
                        <br>
                        {{ $employee->employee_id }}
                        <br>
                        {{ $employee->designation }}
                    </p>
                </td>
                <td>
                    @if(!empty($employee->avatar))
                    <img src="{{ url('public/profile_picture/' . $employee->avatar) }}" class="img-responsive img-thumbnail">
                    @else
                    <img src="{{ url('public/profile_picture/blank_profile_picture.png') }}" alt="blank_profile_picture" class="img-responsive img-thumbnail">
                    @endif
                </td>
            </tr>
        </table>
        <br>
        <table>
            <tbody>
                <tr>
                    <td>{{ __('Last`s Name') }}</td>
                    <td>{{ $employee->father_name }}</td>
                </tr>
                <tr>
                    <td>{{ __('Present Address') }}</td>
                    <td>{{ $employee->present_address }}</td>
                </tr>
                <tr>
                    <td>{{ __('Permanent Address') }}</td>
                    <td>{{ $employee->permanent_address }}</td>
                </tr>
                <tr>
                    <td>{{ __('Home District') }}</td>
                    <td>{{ $employee->home_district }}</td>
                </tr>
                <tr>
                    <td>{{ __('Email') }}</td>
                    <td>{{ $employee->email }}</td>
                </tr>
                <tr>
                    <td>{{ __('Web') }}</td>
                    <td>{{ $employee->web }}</td>
                </tr>
                <tr>
                    <td>{{ __('Contact No') }}</td>
                    <td>{{ $employee->contact_no_one }}</td>
                </tr>
                <tr>
                    <td>{{ __('Emergency Contact') }}</td>
                    <td>{{ $employee->emergency_contact }}</td>
                </tr>
                <tr>
                    <td>{{ __('ID Name') }}</td>
                    <td>
                        @if($employee->id_name == 1)
                        {{ __('NID') }}
                        @elseif($employee->id_name == 2)
                       {{ __('Passport') }} 
                        @elseif($employee->id_name == 3)
                       {{ __('Driving License') }} 
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>{{ __('ID Number') }}</td>
                    <td>{{ $employee->id_number }}</td>
                </tr>
                <tr>
                    <td>{{ __('Gender') }}</td>
                    <td>
                        @if($employee->gender == 'm')
                        {{ __('Male') }}
                        @else
                       {{ __('Female') }} 
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>{{ __('Date of Birth') }}</td>
                    <td>
                        @if($employee->date_of_birth != NULL)
                        {{ date("d F Y", strtotime($employee->date_of_birth)) }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>{{ __('Joining Position') }}</td>
                    <td>
                        @foreach($designations as $designation)
                        @if($employee->joining_position == $designation->id)
                        {{ $designation->designation }}
                        @endif
                        @endforeach
                    </td>
                </tr>

                <tr>
                    <td>{{ __('Joining Date') }}</td>
                    <td>{{ date("D d F Y", strtotime($employee->joining_date)) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>