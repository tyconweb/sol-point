<!DOCTYPE html>
<html>
    <!-- head -->
    @include('administrator.layouts.head')
    <!-- /head -->
    <body class="hold-transition skin-blue-light sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">

            <!-- header -->
            @include('administrator.layouts.header')
            <!-- /header -->

            <!-- Left side column. contains the side bar -->
            @include('administrator.layouts.left_side_bar')
            <!-- /Left Side Bar -->

            <!-- Content Wrapper. Contains page content -->
            @yield('main_content')
            <!-- /content-wrapper -->

            <!-- Footer. contains the footer -->
            @include('administrator.layouts.footer')
            <!-- /Footer -->

            <!-- Add the side bar's background. This div must be placed immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->

        <!-- Scripts. contains the script -->
        @include('administrator.layouts.scripts')
        <!-- /Scripts -->
        
        <div class="modal" id="logo-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Logo</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <img src="{{ __('/public/backend/img/corporatelogo.png') }}" width="100" height="100" id="logo-image">
                        <hr>
                        <div id="message"></div>
                        <form id="logo-form" action="{{ route('logo.update') }}" enctype="multipart/form-data" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="logo_url">Upload logo Image:</label>
                                <input type="file" class="form-control-file" id="logo_image" name="logo_image">
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        
    </body>


</html>
