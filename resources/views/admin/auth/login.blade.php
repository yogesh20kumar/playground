<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }} | Admin Login</title> <!-- Styles -->
        <!-- <link href="{{ url('public/css/app.css') }}" rel="stylesheet"> -->
        <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
        <link rel="icon" type="image/png" sizes="16x16" href="favicon.png">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <style>.border{ border-top: 3px solid #007bff !important;}
        .project{ color:#6c757d; font-size: 20px; }
        </style>
    </head>

    <body class="login-page">
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card card-outline">
                <div class="card-header text-center border">
                    <!-- <a href="#">
                         <img src="{{ asset('public/img/logo.png') }}">
                    </a> -->
                    <b class="project">Online Booking</b>
                </div>
                <div class="card-body login-card-body">
                    <p class="login-box-msg">{{ trans('backend.start_session') }}</p>
                    @if(session()->has('msg'))
                    <div class="alert alert-warning">
                        {{ session()->get('msg') }}
                    </div>
                    @endif
                    @if(session()->has('msg-success'))
                    <div class="alert alert-success" style="background-color: #00AEAF !important;border: none;">
                        {{ session()->get('msg-success') }}
                    </div>
                    @endif
                    <form action="{{ route('admin.login.submit') }}" method="post">
                        {{ csrf_field() }}
                        <div class="input-group mb-3 {{ $errors->has('email') ? ' has-error' : '' }}">
                            @if ($errors->has('email'))
                            <label class="control-label text-danger" style="width:100%;" for="inputError"><i
                                    class="far fa-bell"></i> {{
                            $errors->first('email') }}</label>
                            @endif
                            <input type="email" name="email" class="form-control" placeholder="{{ trans('backend.email') }}"
                                   autocomplete="new-email" value="{{ old('email') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3 {{ $errors->has('password') ? ' has-error' : '' }}">
                            @if ($errors->has('password'))
                            <label class="control-label text-danger" style="width:100%;" for="inputError"><i
                                    class="far fa-bell"></i> {{
                            $errors->first('password') }}</label>
                            @endif
                            <input type="password" name="password" class="form-control"
                                   placeholder="{{ trans('backend.password') }}" autocomplete="new-password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8"></div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-block btn-secondary">
                                    {{ trans('backend.sign_in') }}
                                </button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->
        <!-- jQuery -->
        <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}">
        </script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    </body>
</html>
