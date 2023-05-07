<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ __('Employee Report') }}</title>
</head>
<body>
    <div class="header">
        <img src="{{ url('public/backend/img/corporatelogo.png') }}">
    </div>
    <div class="footer"><p>{{ __('Page:') }} <span class="pagenum"></span></p></div>
    <div class="container table-responsive">
        <table  class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>{{ __(' SL#') }}</th>
                    <th>{{ __(' ID') }}</th>
                    <th>{{ __(' Name') }}</th>
                    <th>{{ __(' Designation') }}</th>
                    <th>{{ __(' Contact No') }}</th>
                    <th class="text-center">{{ __('Added') }}</th>
                </tr>
            </thead>
            <tbody id="myTable">
                @php $sl = 1; @endphp
                @foreach($employees as $employee)
                <tr>
                    <td>{{ $sl++ }}</td>
                    <td>{{ $employee['employee_id'] }}</td>
                    <td>{{ $employee['name'] }}</td>
                    <td>{{ $employee['designation'] }}</td>
                    <td>{{ $employee['contact_no_one'] }}</td>
                    <td class="text-center">{{ date("d F Y", strtotime($employee['created_at'])) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div>
        <p>{{ __('Prepared By') }}</p>
        <p>{{ __('Authorised Signature') }}</p>
    </div>
</div>
</body>
</html>