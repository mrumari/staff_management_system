<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Chameleon Admin is a modern Bootstrap 4 webapp &amp; admin dashboard html template with a large number of components, elegant design, clean and organized code.">
    <meta name="keywords" content="admin template, Chameleon admin template, dashboard template, gradient admin template, responsive admin template, webapp, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title>Dashboard Analytics - Chameleon Admin - Modern Bootstrap 4 WebApp & Dashboard HTML Template + UI Kit</title>
    <link rel="apple-touch-icon" href="{{ asset('admin-theme/app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin-theme/app-assets/images/ico/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-theme/app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-theme/app-assets/vendors/css/charts/chartist.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-theme/app-assets/vendors/css/charts/chartist-plugin-tooltip.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-theme/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-theme/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-theme/app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-theme/app-assets/css/components.css') }}">

    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-theme/app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-theme/app-assets/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-theme/app-assets/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-theme/app-assets/css/pages/chat-application.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-theme/app-assets/css/pages/dashboard-analytics.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-theme/assets/css/style.css') }}">
    <!-- END: Custom CSS-->
    @yield('stylesheet')
</head>


<body class="vertical-layout vertical-menu 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-purple-blue" data-col="2-columns">

         @include('includes.header_admin')
         @yield('content')

         <a class="btn btn-try-builder btn-bg-gradient-x-purple-red btn-glow white" href="https://www.themeselection.com/layout-builder/horizontal" target="_blank">Try Layout Builder</a>
         <footer class="footer footer-static footer-light navbar-border navbar-shadow">
             <div class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">2019 &copy; Copyright <a class="text-bold-800 grey darken-2" href="https://themeselection.com" target="_blank">ThemeSelection</a></span>
                 <ul class="list-inline float-md-right d-block d-md-inline-blockd-none d-lg-block mb-0">
                     <li class="list-inline-item"><a class="my-1" href="https://themeselection.com/" target="_blank"> More themes</a></li>
                     <li class="list-inline-item"><a class="my-1" href="https://themeselection.com/support" target="_blank"> Support</a></li>
                 </ul>
             </div>
         </footer>



         <!-- BEGIN: Vendor JS-->
         <script src="{{ asset('admin-theme/app-assets/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
         <!-- BEGIN Vendor JS-->

         <!-- BEGIN: Page Vendor JS-->
         <script src="{{ asset('admin-theme/app-assets/vendors/js/charts/chartist.min.js') }}" type="text/javascript"></script>
         <script src="{{ asset('admin-theme/app-assets/vendors/js/charts/chartist-plugin-tooltip.min.js') }}" type="text/javascript"></script>
         <!-- END: Page Vendor JS-->

         <!-- BEGIN: Theme JS-->
         <script src="{{ asset('admin-theme/app-assets/js/core/app-menu.js') }}" type="text/javascript"></script>
         <script src="{{ asset('admin-theme/app-assets/js/core/app.js') }}" type="text/javascript"></script>
         <!-- END: Theme JS-->

         <!-- BEGIN: Page JS-->
{{--         <script src="{{ asset('admin-theme/app-assets/js/scripts/pages/dashboard-analytics.js') }}" type="text/javascript"></script>--}}
         <!-- END: Page JS-->


      @yield('javascript')


</body>
</html>
