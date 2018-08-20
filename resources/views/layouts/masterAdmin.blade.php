<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon-->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- Custom Css Js-->
    @yield('customCssJs');

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ asset('css/themes/all-themes.css') }}" rel="stylesheet" />

</head>

<body class="theme-red">
    <!-- Page Loader -->
    @include('admin.custumMasterAdmin.pageLoader')
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    @include('admin.custumMasterAdmin.overlayForSidebars')
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    @include('admin.custumMasterAdmin.searchBar')
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    @include('admin.custumMasterAdmin.topBar')
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        @include('admin.custumMasterAdmin.leftSidebar',['user' =>$user])
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        @include('admin.custumMasterAdmin.rightSidebar')
        <!-- #END# Right Sidebar -->
    </section>

    <section class="content">
        <!-- Content -->
        @yield('content')
        <!-- #END# Content -->
    </section>

    <!-- Jquery Core Js -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    
    <!-- Bootstrap Core Js -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Select Plugin Js -->
    <script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{ asset('plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('plugins/node-waves/waves.js') }}"></script>

    <!-- Custom Js -->
    @yield('customJs')

    <!-- Demo Js -->
    <script src="{{ asset('js/dashboard.js') }}"></script>

</body>

</html>
