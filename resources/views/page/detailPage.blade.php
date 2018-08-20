@extends('layouts.masterPage')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    @yield('list-content')
                </div>
                <div class="col-lg-4 col-md-4 col-sm-0 col-xs-0">
                    <!-- hot For Sidebars -->
                    @include('page.custumPage.hotSidebar')
                    <!-- #END# hot For Sidebars -->
                    @yield('description_Sidebar')
                </div>
            </div>
            <!-- #END# Badges -->
        </div>
    </div>
</div>
@endsection
<!-- #END# Content -->

<!-- Custom Js -->
@section('customJs')
<!-- <link href="{{ asset('plugins/rateit/src/rateit.css') }}" rel="stylesheet" />
<script src="{{ asset('plugins/rateit/src/jquery.rateit.min.js') }}"></script> -->
@endsection
<!-- #END# Custom Js -->
