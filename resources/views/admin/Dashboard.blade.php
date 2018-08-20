@extends('layouts.masterAdmin')

<!-- Custom Css Js -->
@section('customCssJs')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endsection
<!-- #END# Custom Css Js -->

<!-- Content -->
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>Dashboard</h2>
    </div>
</div>
@endsection
<!-- #END# Content -->

<!-- Custom Js -->
@section('customJs')
<script src="{{ asset('js/admin.js') }}"></script>
@endsection
<!-- #END# Custom Js -->
