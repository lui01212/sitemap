@extends('layouts.masterAdmin')

<!-- Custom Css Js-->
@section('customCssJs')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<!-- Bootstrap Select Css -->
<link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endsection
<!-- #END# Custom Css Js -->

<!-- Content -->
@section('content')
<div class="container-fluid">
    <div class="block-header col-md-10">
       <span>LIST STORY</span>
        <a  class="btn btn-success waves-effect align-right m-l-10 btn-stop">
        <i class="material-icons">autorenew</i>
        <span class="hidden-span">STOP</span>
        </a>
    </div>
    <div class="block-header col-md-2">

        <a  class="btn btn-success waves-effect align-right btn-autoload-all">
        <i class="material-icons">autorenew</i>
        <span class="hidden-span">AUTOLOADINGALL</span>
        </a>

    </div>
    @foreach($stories as $story)
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>{{$story ->story_name}}</h2>
            </div>
            <div class="body">
                <form method="POST" action="{{ route('autoloadlist.store',['id'=>$story ->story_id]) }}" id="form{{$story ->story_id}}" >
                {{ csrf_field() }}
                    <div class="input-group">
                        <div class="form-line">
                            <input type="text" class="form-control" value="{{$story ->auto_chapter_link}}"  name="auto_chapter_link" placeholder="Nhập link chương" id="input{{$story ->story_id}}" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary m-t-5 m-b-15 waves-effect btn-autoloadlist" id="{{$story ->story_id}}">Auto Load</button>
                    <a  class="btn btn-success waves-effect align-right m-l-10 m-b-15 btn-stop">
                    <span class="hidden-span">STOP</span>
                    </a>
                    <div class="preloader pl-size-xs" id="preloader{{$story ->story_id}}">
                        <div class="spinner-layer pl-red">
                            <div class="circle-clipper left">
                                <div class="circle"></div>
                            </div>
                            <div class="circle-clipper right">
                                <div class="circle"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
<!-- #END# Content -->

<!-- Custom Js -->
@section('customJs')
<!-- Jquery Core Js -->
<script src="{{ asset('plugins/jquery-cookie/jquery.cookie.js') }}"></script>
<script src="{{ asset('js/admin.js') }}"></script>
<script src="{{ asset('js/admin.autoloadingList.js') }}"></script>
@endsection
<!-- #END# Custom Js -->
