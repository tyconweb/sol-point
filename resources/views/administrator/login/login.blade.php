<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ __('Admin Login') }}</title>
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
                    <div class="col-lg-10 force_mar">
                        <div class="content_Foinny">
                            <div class="row">
                                <div class="col-lg-5 col-md-6 mt-5">
                                    <div class="Login_form">
                                        @if(session()->has('error'))
                                            <div class="alert alert-danger" id="notification_box">
                                                {{ session()->get('error') }}
                                            </div>
                                        @endif
                                        <div class="Heading text-center">
                                            <h3>{{ env('COM_FULLNAME','NANLINE COMPANY') }} <span>{{ __('LTD') }}</span></h3>
                                        </div>
                                        <form action="{{ route('login') }}" method="post">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <div class="over_box">
                                                    <label for="InputEmail1" class="Label{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">{{ __('Email Address') }}</label>
                                                    <input type="email" name="email" class="Input" id="" value="admin@websvission.store" aria-describedby="emailHelp">
                                                    @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                    @endif
                                                    <div class="SideIcon"><img class="img-fluid" src="{{ asset('public/images/userLoginIcon01.png') }}" alt="Email Icon"></div>
                                                </div>
                                              
                                            </div>
                                            <div class="form-group">
                                                <div class="over_box">
                                                    <label for="InputPassword" class="{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">{{ __('Password') }}</label>
                                                    <input type="password" name="password"  value="admin123" class="Input" id="">
                                                    @if ($errors->has('password'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                    @endif
                                                    <div class="SideIcon"><img src="{{asset('public/images/userLoginIcon02.png')}}" alt="Password Icon"></div>
                                                </div>
                                            </div>
                                            <div class="form-group Buttons text-center">
                                                <button type="submit" class="btn Admin">{{__('Login')}}</button>
                                            </div>
                                        </form>
                                        <a class="btn btn-link" style="padding: 0px; padding-top: 10px;" href="{{ route('password.request') }}">
                                           {{ __('Forgot Your Password?') }} 
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-6">
                                    <div class="Right_side">
                                        <div class="SoftWare_name m-auto text-center">
                                            <img class="img-fluid" src="{{asset('public/images/Vector-Image.png')}}" alt="Software Image">
                                        </div>
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