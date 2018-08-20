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
    <div class="block-header">
        <a href="{{ route('storydetail.index',['id'=>$stories ->story_id]) }}" class="btn btn-success waves-effect">
            <i class="material-icons">assignment_return</i>
            <span>TRỞ VỀ LIST CHAPTER </span>
        </a>
    </div>
    <form method="POST" action="{{ route('storydetail.update',['id'=>$stories ->story_id,'chapter_id'=> $storyListDetail ->chapter_id]) }}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
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
                                    <input type="text" class="form-control" value="{{$storyListDetail ->chapter}}"  name="chapter" placeholder="Nhập chương">
                                </div>
                                @if ($errors->has('chapter'))
                                <label id="email-error" class="error" for="email">{{ $errors->first('chapter') }}</label>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">subject</i>
                                </span>
                                <div class="form-line">

                                    <input type="text"  value="{{ $storyListDetail->chapter_name }}" class="form-control" name="chapter_name" placeholder="Nhập tên chương">
                                </div>
                                @if ($errors->has('chapter_name'))
                                <label id="email-error" class="error" for="email">{{ $errors->first('chapter_name') }}</label>
                                @endif
                            </div>
                            <div class="input-group">
                                <input type="radio" name="flag"  value="1" id="flag1" class="with-gap" @if($storyListDetail ->flag ==1) checked @endif>
                                <label for="flag1">true</label>

                                <input type="radio" name="flag" value="2" id="flag2" class="with-gap" @if($storyListDetail ->flag ==2) checked @endif > 
                                <label for ="flag2" class="m-l-20">false</label>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>  
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        NỘI DUNG CHAPTER
                    </h2>
                </div>
                <div class="body">
                    <textarea id="tinymce" name="chapter_content">
                        {{ $storyListDetail->chapter_content }}
                    </textarea>
                @if ($errors->has('chapter_content'))
                <h6 id="story_intro-error" class="error col-pink" for="story_intro">{{ $errors->first('chapter_content') }}</h6>
                @endif
                </div>
            </div>
            <button type="submit" class="btn btn-primary m-t-5 m-b-15 waves-effect">SỬA CHAPTER</button>
        </div>
    </form>
    <br>
</div>
@endsection
<!-- #END# Content -->

<!-- Custom Js -->
@section('customJs')
<!-- TinyMCE -->
<script src="{{ asset('plugins/tinymce/tinymce.js') }}"></script>
<script src="{{ asset('js/admin.js') }}"></script>
<script language="javascript">
    //TinyMCE
    tinymce.init({
        selector: "textarea#tinymce",
        theme: "modern",
        height: 300,
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true
    });
    tinymce.suffix = ".min";
    tinyMCE.baseURL = "{{ asset('plugins/tinymce') }}";
</script>
<script src="{{ asset('js/admin.stories.js') }}"></script>
@endsection
<!-- #END# Custom Js -->
