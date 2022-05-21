<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <title>@yield('title') - {{config('app.name')}}</title>
    {{--<link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">--}}
    {{--<link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">--}}
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
          rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('themes/admin/css/admin.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('themes/admin/fonts/font-awesome/css/font-awesome.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('themes/admin/css/sweetalert2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('themes/admin/css/vertical-menu.css')}}">
    @stack('head')
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click"
      data-menu="vertical-menu-modern" data-col="">

<!-- BEGIN: Header-->
<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle tgl-btn" href="javascript:void(0);" data-target=".navbar-collapse"><i class="ficon"
                                                                                                   data-feather="menu"></i></a>
                </li>
            </ul>
            <ul class="nav navbar-nav bookmark-icons">
                {{--<li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-email.html" data-toggle="tooltip"
                                                          data-placement="top" title="Email"><i class="ficon"
                                                                                                data-feather="mail"></i></a>
                </li>--}}
                {{--<li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-chat.html" data-toggle="tooltip"
                                                          data-placement="top" title="Chat"><i class="ficon"
                                                                                               data-feather="message-square"></i></a>
                </li>--}}
                {{--<li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-calendar.html"
                                                          data-toggle="tooltip" data-placement="top" title="Calendar"><i
                                class="ficon" data-feather="calendar"></i></a></li>--}}
                {{--<li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-todo.html" data-toggle="tooltip"
                                                          data-placement="top" title="Todo"><i class="ficon"
                                                                                               data-feather="check-square"></i></a>
                </li>--}}
            </ul>
            <ul class="nav navbar-nav">
                {{--<li class="nav-item d-none d-lg-block"><a class="nav-link bookmark-star"><i class="ficon text-warning"
                                                                                            data-feather="star"></i></a>
                    <div class="bookmark-input search-input">
                        <div class="bookmark-input-icon"><i data-feather="search"></i></div>
                        <input class="form-control input" type="text" placeholder="Bookmark" tabindex="0"
                               data-search="search">
                        <ul class="search-list search-list-bookmark"></ul>
                    </div>
                </li>--}}
            </ul>
        </div>
        <ul class="nav navbar-nav align-items-center ml-auto">
            {{--<li class="nav-item dropdown dropdown-language">
                <a class="nav-link dropdown-toggle" id="dropdown-flag" href="javascript:void(0);" data-toggle="dropdown"
                                                               aria-haspopup="true" aria-expanded="false"><i
                            class="flag-icon flag-icon-us"></i><span class="selected-language">English</span></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-flag"><a class="dropdown-item"
                                                                                                  href="javascript:void(0);"
                                                                                                  data-language="en"><i
                                class="flag-icon flag-icon-us"></i> English</a><a class="dropdown-item"
                                                                                  href="javascript:void(0);"
                                                                                  data-language="fr"><i
                                class="flag-icon flag-icon-fr"></i> French</a><a class="dropdown-item"
                                                                                 href="javascript:void(0);"
                                                                                 data-language="de"><i
                                class="flag-icon flag-icon-de"></i> German</a><a class="dropdown-item"
                                                                                 href="javascript:void(0);"
                                                                                 data-language="pt"><i
                                class="flag-icon flag-icon-pt"></i> Portuguese</a></div>
            </li>--}}
            <li class="nav-item d-none d-lg-block">
                <a class="nav-link nav-link-style">
                    <i class="ficon" data-feather="moon"></i>
                </a>
            </li>
            <li class="nav-item nav-search">
                <a class="nav-link nav-link-search">
                    <i class="ficon" data-feather="search"></i>
                </a>
                <div class="search-input">
                    <div class="search-input-icon"><i data-feather="search"></i></div>
                    <input class="form-control input" type="text" placeholder="Search" tabindex="-1"
                           data-search="search">
                    <div class="search-input-close"><i data-feather="x"></i></div>
                    <ul class="search-list search-list-main"></ul>
                </div>
            </li>
            {{--<li class="nav-item dropdown dropdown-cart mr-25">
                <a class="nav-link" href="javascript:void(0);"
                                                                 data-toggle="dropdown"><i class="ficon"
                                                                                           data-feather="shopping-cart"></i><span
                            class="badge badge-pill badge-primary badge-up cart-item-count">6</span></a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                    <li class="dropdown-menu-header">
                        <div class="dropdown-header d-flex">
                            <h4 class="notification-title mb-0 mr-auto">My Cart</h4>
                            <div class="badge badge-pill badge-light-primary">4 Items</div>
                        </div>
                    </li>
                    <li class="scrollable-container media-list">
                        <div class="media align-items-center">
                            <img class="d-block rounded mr-1"
                                 src="../../../app-assets/images/pages/eCommerce/1.png"
                                 alt="donuts" width="62">
                            <div class="media-body"><i class="ficon cart-item-remove" data-feather="x"></i>
                                <div class="media-heading">
                                    <h6 class="cart-item-title"><a class="text-body" href="app-ecommerce-details.html">
                                            Apple watch 5</a></h6><small class="cart-item-by">By Apple</small>
                                </div>
                                <div class="cart-item-qty">
                                    <div class="input-group">
                                        <input class="touchspin-cart" type="number" value="1">
                                    </div>
                                </div>
                                <h5 class="cart-item-price">$374.90</h5>
                            </div>
                        </div>
                        <div class="media align-items-center"><img class="d-block rounded mr-1"
                                                                   src="../../../app-assets/images/pages/eCommerce/7.png"
                                                                   alt="donuts" width="62">
                            <div class="media-body"><i class="ficon cart-item-remove" data-feather="x"></i>
                                <div class="media-heading">
                                    <h6 class="cart-item-title"><a class="text-body" href="app-ecommerce-details.html">
                                            Google Home Mini</a></h6><small class="cart-item-by">By Google</small>
                                </div>
                                <div class="cart-item-qty">
                                    <div class="input-group">
                                        <input class="touchspin-cart" type="number" value="3">
                                    </div>
                                </div>
                                <h5 class="cart-item-price">$129.40</h5>
                            </div>
                        </div>
                        <div class="media align-items-center"><img class="d-block rounded mr-1"
                                                                   src="../../../app-assets/images/pages/eCommerce/2.png"
                                                                   alt="donuts" width="62">
                            <div class="media-body"><i class="ficon cart-item-remove" data-feather="x"></i>
                                <div class="media-heading">
                                    <h6 class="cart-item-title"><a class="text-body" href="app-ecommerce-details.html">
                                            iPhone 11 Pro</a></h6><small class="cart-item-by">By Apple</small>
                                </div>
                                <div class="cart-item-qty">
                                    <div class="input-group">
                                        <input class="touchspin-cart" type="number" value="2">
                                    </div>
                                </div>
                                <h5 class="cart-item-price">$699.00</h5>
                            </div>
                        </div>
                        <div class="media align-items-center"><img class="d-block rounded mr-1"
                                                                   src="../../../app-assets/images/pages/eCommerce/3.png"
                                                                   alt="donuts" width="62">
                            <div class="media-body"><i class="ficon cart-item-remove" data-feather="x"></i>
                                <div class="media-heading">
                                    <h6 class="cart-item-title"><a class="text-body" href="app-ecommerce-details.html">
                                            iMac Pro</a></h6><small class="cart-item-by">By Apple</small>
                                </div>
                                <div class="cart-item-qty">
                                    <div class="input-group">
                                        <input class="touchspin-cart" type="number" value="1">
                                    </div>
                                </div>
                                <h5 class="cart-item-price">$4,999.00</h5>
                            </div>
                        </div>
                        <div class="media align-items-center"><img class="d-block rounded mr-1"
                                                                   src="../../../app-assets/images/pages/eCommerce/5.png"
                                                                   alt="donuts" width="62">
                            <div class="media-body"><i class="ficon cart-item-remove" data-feather="x"></i>
                                <div class="media-heading">
                                    <h6 class="cart-item-title"><a class="text-body" href="app-ecommerce-details.html">
                                            MacBook Pro</a></h6><small class="cart-item-by">By Apple</small>
                                </div>
                                <div class="cart-item-qty">
                                    <div class="input-group">
                                        <input class="touchspin-cart" type="number" value="1">
                                    </div>
                                </div>
                                <h5 class="cart-item-price">$2,999.00</h5>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown-menu-footer">
                        <div class="d-flex justify-content-between mb-1">
                            <h6 class="font-weight-bolder mb-0">Total:</h6>
                            <h6 class="text-primary font-weight-bolder mb-0">$10,999.00</h6>
                        </div>
                        <a class="btn btn-primary btn-block" href="app-ecommerce-checkout.html">Checkout</a>
                    </li>
                </ul>
            </li>--}}
            {{--<li class="nav-item dropdown dropdown-notification mr-25"><a class="nav-link" href="javascript:void(0);"
                                                                         data-toggle="dropdown"><i class="ficon"
                                                                                                   data-feather="bell"></i><span
                            class="badge badge-pill badge-danger badge-up">5</span></a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                    <li class="dropdown-menu-header">
                        <div class="dropdown-header d-flex">
                            <h4 class="notification-title mb-0 mr-auto">Notifications</h4>
                            <div class="badge badge-pill badge-light-primary">6 New</div>
                        </div>
                    </li>
                    <li class="scrollable-container media-list"><a class="d-flex" href="javascript:void(0)">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <div class="avatar"><img
                                                src="../../../app-assets/images/portrait/small/avatar-s-15.jpg"
                                                alt="avatar" width="32" height="32"></div>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading"><span
                                                class="font-weight-bolder">Congratulation Sam 🎉</span>winner!</p><small
                                            class="notification-text"> Won the monthly best seller badge.</small>
                                </div>
                            </div>
                        </a><a class="d-flex" href="javascript:void(0)">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <div class="avatar"><img
                                                src="../../../app-assets/images/portrait/small/avatar-s-3.jpg"
                                                alt="avatar" width="32" height="32"></div>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading"><span class="font-weight-bolder">New message</span>&nbsp;received
                                    </p><small class="notification-text"> You have 10 unread messages</small>
                                </div>
                            </div>
                        </a><a class="d-flex" href="javascript:void(0)">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <div class="avatar bg-light-danger">
                                        <div class="avatar-content">MD</div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading"><span class="font-weight-bolder">Revised Order 👋</span>&nbsp;checkout
                                    </p><small class="notification-text"> MD Inc. order updated</small>
                                </div>
                            </div>
                        </a>
                        <div class="media d-flex align-items-center">
                            <h6 class="font-weight-bolder mr-auto mb-0">System Notifications</h6>
                            <div class="custom-control custom-control-primary custom-switch">
                                <input class="custom-control-input" id="systemNotification" type="checkbox" checked="">
                                <label class="custom-control-label" for="systemNotification"></label>
                            </div>
                        </div>
                        <a class="d-flex" href="javascript:void(0)">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <div class="avatar bg-light-danger">
                                        <div class="avatar-content"><i class="avatar-icon" data-feather="x"></i></div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading"><span class="font-weight-bolder">Server down</span>&nbsp;registered
                                    </p><small class="notification-text"> USA Server is down due to hight CPU
                                        usage</small>
                                </div>
                            </div>
                        </a><a class="d-flex" href="javascript:void(0)">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <div class="avatar bg-light-success">
                                        <div class="avatar-content"><i class="avatar-icon" data-feather="check"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading"><span class="font-weight-bolder">Sales report</span>&nbsp;generated
                                    </p><small class="notification-text"> Last month sales report generated</small>
                                </div>
                            </div>
                        </a><a class="d-flex" href="javascript:void(0)">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <div class="avatar bg-light-warning">
                                        <div class="avatar-content"><i class="avatar-icon"
                                                                       data-feather="alert-triangle"></i></div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading"><span class="font-weight-bolder">High memory</span>&nbsp;usage
                                    </p><small class="notification-text"> BLR Server using high memory</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="dropdown-menu-footer"><a class="btn btn-primary btn-block" href="javascript:void(0)">Read
                            all notifications</a></li>
                </ul>
            </li>--}}
            <li class="nav-item dropdown dropdown-user">
                <a class="nav-link dropdown-toggle dropdown-user-link"
                   id="dropdown-user" href="javascript:void(0);"
                   data-toggle="dropdown" aria-haspopup="true"
                   aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none">
                        <span class="user-name font-weight-bolder">{{Auth::user()->name}}</span>
                        <span class="user-status">{{Auth::user()->title}}</span>
                    </div>
                    <span class="avatar">
                        <img class="round" src="{{asset('themes/admin/images/logo/logo-icon.png')}}"
                             alt="avatar" height="40" width="40">
                        <span class="avatar-status-online"></span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                    @can('edit own profile')
                        <a class="dropdown-item" href="{{route('admin.users.profile')}}">
                            <i class="mr-50" data-feather="user"></i> Profile
                        </a>
                    @endcan
                    {{--<a class="dropdown-item" href="app-email.html">
                        <i class="mr-50" data-feather="mail"></i>
                        Inbox
                    </a>--}}
                    {{--<a class="dropdown-item" href="app-todo.html">
                        <i class="mr-50" data-feather="check-square"></i>
                        Task
                    </a>--}}
                    {{--<a class="dropdown-item" href="app-chat.html">
                        <i class="mr-50" data-feather="message-square"></i>
                        Chats
                    </a>--}}
                    {{--<div class="dropdown-divider"></div>--}}
                    {{--<a class="dropdown-item" href="page-account-settings.html">
                        <i class="mr-50" data-feather="settings"></i>
                        Settings
                    </a>--}}
                    {{--<a class="dropdown-item" href="page-pricing.html">
                        <i class="mr-50" data-feather="credit-card"></i>
                        Pricing
                    </a>--}}
                    {{--<a class="dropdown-item" href="page-faq.html">
                        <i class="mr-50" data-feather="help-circle"></i>
                        FAQ
                    </a>--}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                            <i class="mr-50" data-feather="power"></i> Logout</a>
                    </form>

                </div>
            </li>
        </ul>
    </div>
</nav>
<ul class="main-search-list-defaultlist d-none">
    <li class="d-flex align-items-center"><a href="javascript:void(0);">
            <h6 class="section-label mt-75 mb-0">Files</h6>
        </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100"
                                   href="app-file-manager.html">
            <div class="d-flex">
                <div class="mr-75"><img src="{{asset('themes/admin/images/icons/xls.png')}}" alt="png" height="32">
                </div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Two new item submitted</p><small class="text-muted">Marketing
                        Manager</small>
                </div>
            </div>
            <small class="search-data-size mr-50 text-muted">&apos;17kb</small>
        </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100"
                                   href="app-file-manager.html">
            <div class="d-flex">
                <div class="mr-75"><img src="{{asset('images/icons/jpg.png')}}" alt="png" height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">52 JPG file Generated</p><small class="text-muted">FontEnd
                        Developer</small>
                </div>
            </div>
            <small class="search-data-size mr-50 text-muted">&apos;11kb</small>
        </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100"
                                   href="app-file-manager.html">
            <div class="d-flex">
                <div class="mr-75"><img src="{{asset('themes/admin/images/icons/file-icons/pdf.png')}}" alt="png"
                                        height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">25 PDF File Uploaded</p><small class="text-muted">Digital
                        Marketing Manager</small>
                </div>
            </div>
            <small class="search-data-size mr-50 text-muted">&apos;150kb</small>
        </a></li>
</ul>
<ul class="main-search-list-defaultlist-other-list d-none">
    <li class="auto-suggestion justify-content-between">
        <a class="d-flex align-items-center justify-content-between w-100 py-50">
            <div class="d-flex justify-content-start"><span class="mr-75" data-feather="alert-circle"></span><span>No results found.</span>
            </div>
        </a>
    </li>
</ul>
<!-- END: Header-->
<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow navbar-collapse" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand"
                   href="{{route('dashboard')}}">
                    <span class="brand-logo">
                        <img alt="HomeTeam Logo" src="{{asset('themes/admin/images/logo/logo-icon.png')}}"/></span>
                    <h2 class="brand-text">{{config('app.name')}}</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                    <i class="d-block d-xl-none text-primary toggle-icon font-medium-4 tgl-btn" data-feather="x">
                    </i>
                    <i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary"
                       data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            @can('access dashboard')
                <li class="nav-item{{Request::is('admin')?' active':''}}">
                    <a class="d-flex align-items-center" href="{{route('dashboard')}}">
                        <i data-feather="home"></i>
                        <span class="menu-title text-truncate" data-i18n="Dashboards">{{__('Dashboards')}}</span>
                    </a>
                </li>
            @endcan

            <li class=" navigation-header">
                <span data-i18n="Modules">Modules</span>
                <i data-feather="more-horizontal"></i>
            </li>

            @can('access contracts')
                <li class="nav-item{{Request::is('admin/contracts*')?' active':''}}">
                    <a class="d-flex align-items-center" href="{{route('admin.contracts')}}">
                        <span class="iconify" data-icon="mdi:file-sign"></span>
                        <span class="menu-title text-truncate"
                              data-i18n="Contracts">{{__('Contracts')}}</span>
                    </a>
                </li>
            @endcan

            @can('access misc deposits')
                <li class="nav-item{{Request::is('admin/deposits*')?' active':''}}">
                    <a class="d-flex align-items-center" href="{{route('admin.misc_deposits')}}">
                        <span class="iconify" data-icon="mdi:cash-fast"></span>
                        <span class="menu-title text-truncate"
                              data-i18n="Contracts">{{__('Misc Deposits')}}</span>
                    </a>
                </li>
            @endcan
            @can('access dpr')
                <li class="nav-item{{Request::is('admin/daily-production-reports*')?' active':''}}"
                    data-title="Daily Production Reports">
                    <a class="d-flex align-items-center" href="{{route('admin.dpr')}}">
                        <span class="iconify" data-icon="mdi:finance"></span>
                        <span class="menu-title text-truncate"
                              data-i18n="Contracts">{{__('Daily Production Reports')}}</span>
                    </a>
                </li>
            @endcan
            @can('access qas')
                {{-- <li class="nav-item{{Request::is('admin/quality-assurance-survey*')?' active':''}}"
                    data-title="Quality Assurance Survey">
                    <a class="d-flex align-items-center" href="{{route('admin.qas')}}">
                        <i data-feather="check-circle"></i>
                        <span class="menu-title text-truncate"
                              data-i18n="Contracts">{{__('Quality Assurance Survey')}}</span>
                    </a>
                </li> --}}
            @endcan
            @can('access qas')
            <li class="nav-item {{Request::is('admin/quality-assurance-survey*')?' active':''}}"><a class="d-flex align-items-center" href="#"><i data-feather="check-circle"></i><span class="menu-title text-truncate">{{__('Quality Assurance Survey')}}</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{route('admin.qas')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" >{{__('Field Audit')}}</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{route('admin.qas.sentricon')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" >{{__('Sentricon Audit')}}</span></a>
                    </li>
                </ul>
            </li>
            @endcan
            <li class="navigation-header">
                <span data-i18n="Administration">{{__('Administration')}}</span>
                <i data-feather="more-horizontal"></i>
            </li>

            @can('manage settings')
                <li class="nav-item{{Request::is('admin/settings*')?' active':''}}">
                    <a class="d-flex align-items-center" href="{{route('admin.settings')}}">
                        <i data-feather='settings'></i>
                        <span class="menu-title text-truncate" data-i18n="Settings">{{__('Settings')}}</span>
                    </a>
                </li>
            @endcan
            @can('access roles')
                <li class="nav-item{{Request::is('admin/roles*')?' active':''}}">
                    <a class="d-flex align-items-center" href="{{route('admin.roles')}}">
                        <span class="iconify" data-icon="mdi:shield-account-outline" data-width="24"
                              data-height="24"></span>
                        <span class="menu-title text-truncate" data-i18n="Roles">{{__('Roles')}}</span>
                    </a>
                </li>
            @endcan
            @can('access users')
                <li class="nav-item{{Request::is('admin/users*')?' active':''}}">
                    <a class="d-flex align-items-center" href="{{route('admin.users')}}">
                        <i data-feather='users'></i>
                        <span class="menu-title text-truncate" data-i18n="Users">{{__('Users')}}</span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</div>
<!-- END: Main Menu-->

<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">@yield('heading')</h2>
                        @hasSection('breadcrumb')
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a>
                                    </li>
                                    @yield('breadcrumb')
                                </ol>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block">
                @yield('buttons')
            </div>
        </div>
        <div class="content-body">
            @yield('content')
        </div>
    </div>
</div>
<!-- END: Content-->

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light">
    <p class="clearfix mb-0">
        <span class="float-md-left d-block d-md-inline-block mt-25">
            COPYRIGHT &copy; {{date('Y')}}
            <a class="ml-25" href="#" target="_blank">HomeTeam</a>
            <span class="d-none d-sm-inline-block">, All rights Reserved</span>
        </span>
        <span class="float-md-right d-none d-md-block">
        </span>
    </p>
</footer>
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
<!-- END: Footer-->


<!-- BEGIN: Vendor JS-->
<script src="{{asset('themes/admin/js/vendors.min.js')}}"></script>
<script src="{{asset('themes/admin/js/admin.js?ver='.date('ymdhi'))}}"></script>
<script src="{{asset('themes/admin/js/datatables.min.js')}}"></script>
<script src="{{asset('themes/admin/js/buttons.server-side.js')}}"></script>
<script src="{{asset('themes/admin/js/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script src="https://code.iconify.design/2/2.0.4/iconify.min.js"></script>

<script>
  AdminApp.initEvents()
  $(document).on('refresh.icons', function () {
    $('[data-title]')
      .tooltip()
    if (feather) {
      feather.replace({
        width: 14,
        height: 14
      })
    }
  })
  $(window).on('load', function () {
    $(document).trigger('refresh.icons')
    $(window).trigger('resize')
  })
  AdminApp.$body.on('click', '.dtr-control,label,input', function () {
    setTimeout(function () {
      $(document).trigger('refresh.icons')
    }, 100)
  })

  var isOpen = false;
  AdminApp.$body.on('click', '.tgl-btn', function () {

    if(isOpen){
        $('.main-menu').css('width' , '0px');
        isOpen = false;
    }
    else{
        $('.main-menu').css('width' , '260px');
        isOpen = true;
    }
    
  })

 
</script>
@stack('footer')
</body>
</html>
