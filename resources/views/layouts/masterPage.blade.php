<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <link rel="canonical" href="{{ URL::current() }}"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Đọc Truyện Online|Truyện Hay Nhất') }}</title>

    <!-- Favicon-->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Custom Css Js-->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link href="{{ asset('css/common.css') }}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ asset('css/themes/theme-teal.css') }}" rel="stylesheet" />
    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "WebSite",
        "url": "{{ URL::current() }}/",
        "potentialAction": {
          "@type": "SearchAction",
          "target": "{{ URL::to('/') }}/search/{keyword}",
          "query-input": "required name=keyword"
        },
         "description": "Đọc truyện online hay nhất.Luôn cập nhật những truyện hay và truyện hot liên tục với các thể loại truyện Kiếm hiệp, Tiên hiệp, Sắc hiệp, Đô thị, Ngôn tình, Truyện Convert, Truyện VIP, Truyện Dịch Hoàn Thành Full."
    }
    </script>
    @yield('OpenGraph')
</head>

<body class="theme-teal">
    <!-- Page Loader -->
    @include('page.custumPage.pageLoader')
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    @include('page.custumPage.overlayForSidebars')
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    @include('page.custumPage.searchBar')
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    @include('page.custumPage.topBar')
    <!-- #Top Bar -->
    <!-- Alignments -->
    @yield('breadcrumb')
    <!-- #END  Alignments -->
    <section>
    <!-- Left Sidebar -->
    @include('page.custumPage.leftSidebar')
    <!-- #END# Left Sidebar -->
    <!-- Right Sidebar -->
    @include('page.custumPage.rightSidebar')
    <!-- #END# Right Sidebar -->
    </section>
    <!-- #END# Alignments -->
    <section class="content">
        <!-- Content -->
        @yield('content')
        <!-- #END# Content -->

    </section>
    <section>
        <div class="container-fluid footer m-t-25">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 align-center m-t-25">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-1 m-t-10">
                            <p class="align-left col-teal">
                                <b>Giới Thiệu</b>
                            </p>
                            <hr  width="30%" align="left" /> 
                            <div class="align-left">
                                Cuồng Truyện - Đọc truyện online, đọc truyện chữ, truyện hay. Website luôn cập nhật những bộ truyện mới thuộc các thể loại đặc sắc như truyện tiên hiệp, truyện kiếm hiệp, hay truyện ngôn tình một cách nhanh nhất. Hỗ trợ mọi thiết bị như di động và máy tính bảng.
                            </div>
                        </div>
                        <div class="col-md-5 m-t-10">
                            <p class="align-left col-teal">
                                <b>Liên Hệ Quảng Cáo</b>
                            </p>
                            <hr  width="30%" align="left" /> 
                            <div class="align-left" style="display: inline-flex; float: left;">
                                <i class="material-icons">email</i><span class="icon-name" style="margin-top: 3px;">webcuongtruyen@gmail.com</span>
                            </div>
                        </div>
                    </div>
                    <div class="legal m-t-30">
                        <div class="copyright col-teal">
                            &copy; 2018 <a href="javascript:void(0);">Admin - Cuongtruyen.com</a>.
                        </div>
                        <div class="version">
                            <b>Version: </b>1.0.0
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="backtotop" style="display: block;">Back To Top</div>
        <div id="fb-root"></div>
    <script>
        (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.1&appId=2161062837497350&autoLogAppEvents=1';
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
     </script>
    <!-- Jquery Core Js -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    
    <!-- Bootstrap Core Js -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('plugins/node-waves/waves.js') }}"></script>

    <!-- Custom Js -->
    @yield('customJs')

    <!-- Demo Js -->
    <script src="{{ asset('js/page.js') }}"></script>
    <!-- search -->
    <script src="{{ asset('js/search.js') }}"></script>

</body>

</html>
