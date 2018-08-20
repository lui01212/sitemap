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
    <div class="block-header col-md-6">
        <a href="{{ route('storydetail.index',['id'=>$id]) }}" class="btn btn-success waves-effect">
            <i class="material-icons">assignment_return</i>
            <span>TRỞ VỀ LIST CHAPTER </span>
        </a>
    </div>
    <form method="POST" action="{{ route('autoloadchapter.store',['id'=>$id]) }}">
        {{ csrf_field() }}
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>{{$stories ->story_name}}</h2>
                </div>
                <div class="body">
                    <div class="row clearfix demo-icon-container">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="demo-google-material-icon"> <i class="material-icons">account_box</i> <span class="icon-name">Tác giả : {{$stories ->author_name}}</span></div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="demo-google-material-icon"> <i class="material-icons">video_call</i> <span class="icon-name">Nguồn : {{$stories ->story_source}}</span></div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="demo-google-material-icon"> <i class="material-icons">add_to_photos</i> <span class="icon-name">Số chương : {{$stories ->story_sum_chapter}}</span> </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">skip_next</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control" value="{{$stories ->story_sum_chapter + 1}}"  name="chapter" placeholder="Nhập chương tiếp theo" required>
                                </div>
                                @if ($errors->has('chapter'))
                                <label id="email-error" class="error" for="email">{{ $errors->first('chapter') }}</label>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">link</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="chapter_link" value="{{$link_next}}" required>
                                </div>
                        </div>
                            </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <button type="submit" class="btn btn-primary m-t-5 m-b-15 waves-effect">ADD CHAPTER</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </form>
    <form method="POST" action="{{ route('autoloadchapter.autoupload',['id'=>$id]) }}">
        {{ csrf_field() }}
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">
                    <div class="row clearfix demo-icon-container">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                            <div class="col-md-6">
                                <label for="chapter_to">Từ chương</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="story_name"  value="{{$stories ->story_sum_chapter + 1}}"  name="chapter_to" class="form-control" >
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="chapter_from">Tới chương</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text"  value="{{$stories ->story_sum_chapter + 5 }}" name="chapter_from" class="form-control" placeholder="Nhập chương cuối..." >
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">link</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="chapter_link" value="{{$link_next}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <button type="submit" id="i_autoloadchapter"class="btn btn-primary m-t-5 m-b-15 waves-effect">AUTO LOADING CHAPTER</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </form>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <button id="i_stopautoloadchapter"class="btn btn-primary m-t-5 m-b-15 waves-effect">STOP</button>   
    </div>
    <br>
</div>
@endsection
<!-- #END# Content -->

<!-- Custom Js -->
@section('customJs')
<!-- Jquery Core Js -->
<script src="{{ asset('plugins/jquery-cookie/jquery.cookie.js') }}"></script>
<script src="{{ asset('js/admin.js') }}"></script>
<script src="{{ asset('js/admin.autoloadingChapter.js') }}"></script>
@endsection
<!-- #END# Custom Js -->
