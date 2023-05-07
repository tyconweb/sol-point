<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ __('Reset Password') }}</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{ asset('public/backend/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('public/backend/bower_components/font-awesome/css/font-awesome.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{ asset('public/backend/bower_components/Ionicons/css/ionicons.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('public/backend/dist/css/AdminLTE.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/backend/dist/css/shiplo.css') }}">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{ asset('public/backend/plugins/iCheck/square/blue.css') }}">
        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet">
    </head>
    <body class="hold-transition login-page">
        
        <section class="LoginBg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 force_mar">
                        <div class="content_Foinny">
                            <div class="row m-auto m-0" style="margin: 0 auto;">
                                <div class="col-lg-12 col-md-12 mt-5" style="margin-bottom: 3rem;">
                                    <div class="Login_form">
                                        @if(session()->has('error'))
                                            <div class="alert alert-danger" id="notification_box">
                                                {{ session()->get('error') }}
                                            </div>
                                        @endif
                                        <div class="Heading text-center">
                                            <h3>{{ env('COM_FULLNAME','NANLINE COMPANY') }} <span>{{ __('LTD') }}</span></h3>
                                        </div>
                                        <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                                            {{ csrf_field() }}

                                            <input type="hidden" name="token" value="{{ $token }}">

                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                                                <div class="col-md-12">
                                                    <label for="email">{{ __('E-Mail Address') }}</label>
                                                    <input id="email" type="email" class="form-control" placeholder="Enter Your Email" name="email" value="{{ $email or old('email') }}" required autofocus>

                                                    @if ($errors->has('email'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                                                <div class="col-md-12">
                                                    <label for="password">{{ __('Password') }}</label>
                                                    <input id="password" type="password" class="form-control" name="password" placeholder="Enter New Password" required>

                                                    @if ($errors->has('password'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                                <div class="col-md-12">
                                                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                                    <input id="password-confirm" type="password" class="form-control" placeholder="Enter Confirm Password" name="password_confirmation" required>

                                                    @if ($errors->has('password_confirmation'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="row col-md-12" style="margin: 0 auto;">
                                                <!-- /.col -->
                                                <div class="form-group Buttons text-center">
                                                    <button type="submit" class="btn Admin">Update Password</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /.login-box -->
    <!-- jQuery 3 -->
    <script src="{{ asset('public/backend/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('public/backend/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('public/backend/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
    $(function () {
    $('input').iCheck({
    checkboxClass: 'icheckbox_square-blue',
    radioClass: 'iradio_square-blue',
    increaseArea: '20%' // optional
    });
    });
    </script>
</body>
</html>