<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="">

    <title>Login</title>
    <link rel="apple-touch-icon" href="/themes/admin/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="/themes/admin/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
          rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{asset('themes/admin/css/admin.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('themes/admin/css/form-validation.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('themes/admin/css/page-auth.min.css')}}">
    <!-- END: Page CSS-->
    <style>
        .login-bg {
            background-image: url('{{asset("themes/admin/images/pages/LoginScreen-03.png")}}');
            background-repeat: no-repeat;
            background-size: cover;
            min-height: 100vh;
        }

        .bottom-right {
            right: 128px;
            position: absolute;
            bottom: 110px;
        }

        .font-weight-bold {
            font-weight: 500 !important;
        }

        .custom-font {
            font-weight: 800;
            font-size: 34px;
        }

        .custom-font2 {
            font-weight: 800;
            font-size: 42px;
        }

        .text-light {
            color: #f6f6f6 !important;
        }

    </style>
</head>
<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click"
      data-menu="vertical-menu-modern" data-col="blank-page">
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="auth-wrapper auth-v2">
                <div class="auth-inner row m-0">
                    <!-- Brand logo-->
                    <!-- /Brand logo-->
                    <!-- Left Text-->
                    <div class="d-none d-lg-flex p-0 col-lg-8">
                        <div class="w-100 d-lg-flex align-items-center justify-content-center px-5 login-bg">
                            <div class="bottom-right ">
                                <div class="font-weight-bold float-right"><h2 class="text-light custom-font">Welcome to
                                        the</h2></div>
                                <div class="font-weight-bold"><h1 class="text-light custom-font2">HomeTeam
                                        Dashboard</h1></div>
                            </div>
                        </div>
                    </div>
                    <!-- /Left Text-->
                    <!-- Login-->
                    <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                        <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                            <img src="{{asset('themes/admin/images/HTPDLogo.png')}}" alt="logo" class="">
                            <p class="card-text mb-2 mt-5">Please sign-in to your account and start the adventure</p>
                            <form class="auth-login-form mt-2" action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label" for="login-email">{{ __('Email') }}</label>
                                    <input class="form-control" id="login-email" type="email" name="email"
                                           placeholder="john@example.com" aria-describedby="login-email" autofocus=""
                                           tabindex="1" value="{{old('email')}}" required/>
                                </div>
                                <div class="form-group">
                                    <div class="d-flex justify-content-between">
                                        <label for="login-password">{{ __('Password') }}</label><a
                                                href="{{ route('password.request') }}"><small>{{ __('Forgot your password?') }}</small></a>
                                    </div>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input class="form-control form-control-merge" id="login-password"
                                               type="password" name="password" placeholder="············"
                                               aria-describedby="login-password" tabindex="2"/>
                                        <div class="input-group-append">
                                            <span class="input-group-text cursor-pointer">
                                                <i data-feather="eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" name="remember" id="remember_me"
                                               type="checkbox"
                                               tabindex="3"/>
                                        <label class="custom-control-label" for="remember_me"> Remember Me</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block" tabindex="4">Sign in</button>
                            </form>
                            {{--<p class="text-center mt-2"><a
                                        href="{{ route('register') }}"><span>{{__('Create an account')}}</span></a></p>--}}
                            <div class="divider my-2">
                                <div class="divider-text">or</div>
                            </div>
                            <div class="auth-footer-btn d-flex justify-content-center">
                                <a href="{{route('login.azure')}}" class="btn btn-primary btn-block">
                                    Sign in with Azure AD
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /Login-->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->


<!-- BEGIN: Vendor JS-->
<script src="{{asset('themes/admin/js/vendors.min.js')}}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('themes/admin/js/form-validation.min.js')}}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{asset('themes/admin/js/admin.js')}}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{asset('themes/admin/js/page-auth-login.min.js')}}"></script>
<!-- END: Page JS-->

<script>
  $(window).on('load', function () {
    if (feather) {
      feather.replace({
        width: 14,
        height: 14
      })
    }
      @if (session('status'))
      toastr.success({{ session('status') }}, 'Ok')
      @endif

      @if (session('login-error'))
      toastr.error({{ session('login-error') }}, 'Error')
      @endif
  })
</script>
</body>
<!-- END: Body-->

</html>