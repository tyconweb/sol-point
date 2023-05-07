<div id="mainMenu">
    <ul class="sidebar-menu" data-widget="tree">
        <li><a href="{{ url('/dashboard')}}"><i class="fa fa-dashboard"></i> <span>{{ __('Dashboard') }}</span></a></li>
        
        @permission('people')
        <li class="treeview">
            <a href="#">
                <i class="fa fa-users"></i> <span>{{ __('Employee Management') }}</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
        <ul class="treeview-menu">
                @permission('manage-employee')
                <li><a href="{{ url('/people/employees/create') }}"><i class="fa fa-circle-o"></i>{{ __(' New Employee') }}</a></li>
                <li><a href="{{ url('/people/employees') }}"><i class="fa fa-circle-o"></i> {{ __('Manage Employee') }}</a></li>
                @endpermission
            </ul>
        </li>
        @endpermission
      
        @permission('payroll-management')
        <li class="treeview">
            <a href="#">
                <i class="fa fa-dollar"></i> <span>{{ __('Payroll Management') }}</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                @permission('manage-salary')
                <li><a href="{{ url('/hrm/payroll') }}"><i class="fa fa-circle-o"></i> {{ __('Manage Salary') }}</a></li>
                @endpermission
                @permission('salary-list')
                <li><a href="{{ url('/hrm/payroll/salary-list') }}"><i class="fa fa-circle-o"></i> {{ __('Salary List') }}</a></li>
                @endpermission

                <li><a href="{{ url('/hrm/payroll/increment/search') }}"><i class="fa fa-circle-o"></i>{{ __(' New Increment') }}</a></li>
                <li><a href="{{ url('/hrm/payroll/increment/list') }}"><i class="fa fa-circle-o"></i> {{ __('Increment List') }}</a></li>

                @permission('make-payment')
                <li><a href="{{ url('/hrm/salary-payments') }}"><i class="fa fa-circle-o"></i>{{ __(' Make Payment') }}</a></li>
                @endpermission
                @permission('generate-payslip')
                <li><a href="{{ url('/hrm/generate-payslips/') }}"><i class="fa fa-circle-o"></i> {{ __(' Generate Payslip') }}</a></li>
                @endpermission

                @permission('manage-bonus')
                <li><a href="{{ url('/hrm/bonuses') }}"><i class="fa fa-circle-o"></i> {{ __('Manage Bonus') }}</a></li>
                @endpermission
                @permission('manage-deduction')
                <li><a href="{{ url('/hrm/allowance') }}"><i class="fa fa-circle-o"></i> {{ __('Manage Allowance') }}</a></li>
                <li><a href="{{ url('/hrm/deduction') }}"><i class="fa fa-circle-o"></i> {{ __('Manage Deduction') }}</a></li>
                @endpermission
                @permission('loan-management')
                <li><a href="{{ url('/hrm/loans') }}"><i class="fa fa-circle-o"></i>{{ __(' Loan Management') }}</a></li>
                @endpermission
                @permission('provident-fund')
                <li><a href="{{ url('/hrm/provident-funds') }}"><i class="fa fa-circle-o"></i>{{ __(' Provident Fund') }}</a></li>
                @endpermission
            </ul>
        </li>
        @endpermission       
        @permission('leave-application')
        <li class="treeview">
            <a href="#">
                <i class="glyphicon glyphicon-send"></i> <span>{{ __('Leave Management') }}</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
             
                @permission('manage-leave-application')
                <li><a href="{{ url('/setting/leave_categories/create') }}"><i class="fa fa-circle-o"></i>{{ __('New Leave Category') }}</a></li>
                <li><a href="{{ url('/setting/leave_categories') }}"><i class="fa fa-circle-o"></i>{{ __('Leave Category List') }}</a></li>
                <li><a href="{{ url('/hrm/application_lists') }}"><i class="fa fa-circle-o"></i> <span>{{ __('Leave Application List') }}</span></a></li>
                @endpermission
                @permission('my-leave-application')
                <li><a href="{{ url('/hrm/leave_application/create') }}"><i class="fa fa-circle-o"></i> <span>{{ __('New Leave Application') }}</span></a></li>
                <li><a href="{{ url('/hrm/leave_application') }}"><i class="fa fa-circle-o"></i> <span>{{ __('Leave Application Manage') }}</span></a></li>
                @endpermission
            </ul>
        </li>
        @endpermission



         @permission('manage-award')
        <li class="treeview">
            <a href="#">
                <i class="fa fa-file-text"></i> <span>{{ __('NOC/Ex. Certificate') }}</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                @permission('manage-award')
                <li><a href="{{ url('/hrm/noc/add') }}"><i class="fa fa-circle-o"></i> <span>{{ __('NOC/Certificate Add') }}</span></a></li>
                <li><a href="{{ url('/hrm/noc/list') }}"><i class="fa fa-circle-o"></i> <span>{{ __('NOC List') }}</span></a></li>
                <li><a href="{{ url('/hrm/certificate/list') }}"><i class="fa fa-circle-o"></i> <span>{{ __('Experience Certificate') }}</span></a></li>
                @endpermission
            </ul>
        </li>
         @endpermission
        @permission('notice')
        <li class="treeview">
            <a href="#">
                <i class="glyphicon glyphicon-bell"></i> <span>{{ __('Notice Board') }}</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
               
                @permission('manage-notice')
                 <li><a href="{{ url('hrm/notice/create') }}"><i class="fa fa-circle-o"></i>{{ __('New Notice') }}</a></li>
                <li><a href="{{ url('/hrm/notice') }}"><i class="fa fa-circle-o"></i>{{ __('Manage Notice') }}</a></li>
                @endpermission
                @permission('notice-board')
                <li><a href="{{url('/hrm/notice/show')}}"><i class="fa fa-circle-o"></i> <span>{{ __('Notice list') }}</span></a></li>
                @endpermission
            </ul>
        </li>
        @endpermission
        @permission('file-upload')
        <li><a href="{{ url('/hrm/salary/statement/search') }}"><i class="fa fa-certificate"></i> <span>{{ __('Salary Statement') }}</span></a></li>
        @endpermission

        @permission('hrm-setting')
        <li class="treeview">
            <a href="#">
                <i class="fa fa-cog"></i> <span>{{ __('Configuration') }}</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ url('/setting/departments') }}"><i class="fa fa-circle-o"></i>{{ __('Manage Job Groups') }} </a></li>
                <li><a href="{{ url('/setting/designations') }}"><i class="fa fa-circle-o"></i>{{ __('Manage Designations') }} </a></li>
                <li><a href="{{ url('/setting/leave_categories') }}"><i class="fa fa-circle-o"></i>{{ __('Manage Leave Categories') }} </a></li>
                <li><a href="{{ url('/setting/working-days') }}"><i class="fa fa-circle-o"></i> {{ __('Set Working Day') }}</a></li>
                <li><a href="{{ url('/setting/holidays') }}"><i class="fa fa-circle-o"></i>{{ __('Holiday List') }} </a></li>
                @permission('role')
                <li><a href="{{ route('setting.role.index') }}"><i class="fa fa-circle-o"></i>{{ __('Role') }}</a></li>
                @endpermission
            </ul>
        </li>
        @endpermission
        @if(\Auth::user()->access_label != 1)
        <!--<li><a href="{{ url('/hrm/salary/sheet/search') }}"><i class="fa fa-money"></i> {{ __('Salary Report') }}</a></li>-->
        <li><a href="{{ url('/hrm/p9-report?employee='.\Auth::id()) }}"><i class="fa fa-file-powerpoint-o"></i> {{ __('P9 Report') }}</a></li>
        <li><a href="{{ url('/hrm/generate-payslips/') }}"><i class="fa fa-file-text"></i> {{ __(' Generate Payslip') }}</a></li>
        @endif
        @if(\Auth::user()->access_label == 1)   
        <li class="treeview">
            <a href="#">
                <i class="fa fa-pie-chart"></i> <span>{{ __('Reports') }}</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                @permission('manage-employee')
                <li><a href="{{ url('/people/employees-report') }}"><i class="fa fa-circle-o"></i> {{ __('Employee Report') }}</a></li>
                @endpermission
                <li><a href="{{ url('/hrm/payroll-report-detail') }}"><i class="fa fa-circle-o"></i> {{ __('Detailed Payroll Report') }}</a></li>
                <li><a href="{{ url('/hrm/nssf-report') }}"><i class="fa fa-circle-o"></i> {{ __('NSSF Report') }}</a></li>
                <li><a href="{{ url('/hrm/nhif-report') }}"><i class="fa fa-circle-o"></i> {{ __('NHIF Report') }}</a></li>
                <li><a href="{{ url('/hrm/paye-report') }}"><i class="fa fa-circle-o"></i> {{ __('PAYE Report') }}</a></li>
                <li><a href="{{ url('/hrm/salary/sheet/search') }}"><i class="fa fa-circle-o"></i> {{ __('Salary Report') }}</a></li>
                <li><a href="{{ url('/hrm/p9-report') }}"><i class="fa fa-circle-o"></i> {{ __('P9 Report') }}</a></li>
                @permission('leave-reports')
                <li><a href="{{ url('/hrm/leave-reports') }}"><i class="fa fa-circle-o"></i> <span>{{ __('Leave Reports') }}</span></a></li>
                @endpermission
            </ul>
        </li>
        @endif
        <li><a href="{{ url('/profile/user-profile') }}"><i class="fa fa-user"></i> <span>{{ __('Profile') }}</span></a></li>
        <li><a href="{{ url('/profile/change-password') }}"><i class="fa fa-key"></i> <span>{{ __('Change Password') }}</span></a></li>
        <li>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-lock"></i> <span>{{ __('Logout') }}</span></a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                {{ csrf_field() }}
            </form>
        </li>
    </ul>
</div>