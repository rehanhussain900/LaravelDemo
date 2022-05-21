<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="author" content="PIXINVENT">
    <title>Error 404 - Page not found</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
          rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('themes/admin/css/admin.css')}}">
    <!-- END: Vendor CSS-->

    <style>
        .misc-wrapper {
            display: flex;
            flex-basis: 100%;
            min-height: 100vh;
            width: 100%;
            align-items: center;
            justify-content: center;
        }

        .misc-wrapper .misc-inner {
            position: relative;
            max-width: 750px;
        }

        .misc-wrapper .brand-logo {
            display: flex;
            justify-content: center;
            position: absolute;
            top: 2rem;
            left: 2rem;
            margin: 0;
        }

        .misc-wrapper .brand-logo .brand-text {
            font-weight: 600;
        }
        .misc-wrapper .brand-logo img {
            height:50px
        }
    </style>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

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
            <!-- Error page-->
            <div class="misc-wrapper"><a class="brand-logo" href="javascript:void(0);">
                    <img src="{{asset('themes/admin/images/logo/logo-icon.png')}}" alt="logo"/>
                    <h2 class="brand-text text-primary ml-1 mt-1">{{config('app.name')}}</h2>
                </a>
                <div class="misc-inner p-2 p-sm-3">
                    <div class="w-100 text-center">
                        <h2 class="mb-1">Page Not Found 🕵🏻‍♀️</h2>
                        <p class="mb-2">Oops! 😖 The requested URL was not found on this server.</p><a
                                class="btn btn-primary mb-2 btn-sm-block" href="{{route('dashboard')}}">Back to home</a><img
                                class="img-fluid" src="{{asset('themes/admin/images/error.svg')}}" alt="Error page"/>
                    </div>
                </div>
            </div>
            <!-- / Error page-->
        </div>
    </div>
</div>
<!-- END: Content-->


<!-- BEGIN: Vendor JS-->
<script src="../../../app-assets/vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="../../../app-assets/js/core/app-menu.js"></script>
<script src="../../../app-assets/js/core/app.js"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<!-- END: Page JS-->

<script>
  $(window).on('load', function () {
    if (feather) {
      feather.replace({
        width: 14,
        height: 14
      })
    }
  })
</script>
</body>
<!-- END: Body-->

</html>