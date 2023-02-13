<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Happy Cape') }} | Forgot Password</title>  

        <!-- Styles -->
        <!-- <link href="{{ url('public/css/app.css') }}" rel="stylesheet"> -->
        <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
        <link rel="icon" type="image/png" sizes="16x16" href="favicon.png">  
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="{{asset('assets/admin/bootstrap/css/bootstrap.min.css')}}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('assets/admin/dist/css/AdminLTE.min.css')}}">
    </head>
    <body class="hold-transition login-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="login-box">
                        <div class="login-box-body" style="background-color:#fff;">
                            <p style="font-weight: 600;" class="login-box-msg"><img src="{{URL::asset('public/images/logo.png')}}" alt="Happy Cape"/></p>

                            @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                            @endif
                            @if ($errors->has('email'))
                            <div id="error_email" class="alert alert-danger" style="">
                                <span>{{ trans('backend.email_address_not_found') }}</span>
                            </div>
                            @endif

                            <form class="form-horizontal" method="POST" action="{{ route('admin.password.email') }}">
                                {{ csrf_field() }}
                                <div class="form-group text-center">
                                    <div class="col-md-12">
                                        <b>{{ trans('backend.reset_password_form_label') }}</b><br>
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <input id="email" type="email" class="form-control" placeholder="{{ trans('backend.email_address') }}" name="email" value="{{ old('email') }}" required autofocus>
                                        @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group text-right">
                                    <div class="col-md-12">
                                             <!--    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me -->
                                        <a class="btn btn-link" href="{{ route('admin.login') }}">
                                            <i class="fa fa-angle-left"></i> {{ trans('backend.back') }}
                                        </a>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-block btn-flat" style="width:100%;">
                                            {{ trans('backend.send_link') }}
                                        </button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
