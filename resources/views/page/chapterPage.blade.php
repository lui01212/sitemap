@extends('layouts.masterPage')

@section('OpenGraph')
<meta name="description" content="Bạn đang đọc truyện {{$chapter ->story_name}} {{$chapter ->chapter_name}} trên website đọc truyện online.">
<meta name="keywords" content="Truyện {{$chapter ->story_name}} , {{$chapter ->chapter_name}}">
<meta name="ROBOTS" content="INDEX, FOLLOW">
<meta property="og:locale" content="vi_VN">
<meta property="og:title" content="{{ __('Đọc Truyện Online|Truyện Hay Nhất') }}">
<meta property="og:description" content="Bạn đang đọc truyện {{$chapter ->story_name}} {{$chapter ->chapter_name}} trên website đọc truyện online.">
<meta property="og:url" content="{{ URL::current() }}">
<meta property="og:site_name" content="content">
<meta property="og:type" content="website">
<meta property="og:image" content="{{asset('images/logo.jpg')}}">
@endsection

@section('breadcrumb')
<div class="row clearfix" style="margin: 80px 0 0 0;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <ol class="breadcrumb align-center">
            <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb" ><a itemprop="url" href="{{ url('/') }}"><i class="material-icons">home</i><span itemprop="title">Home</span></a></li>
            <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a  itemprop="url" href="{{route('storydetailpage.index',['story'=>$chapter ->story_name_link])}}"><i class="material-icons">library_books</i><span itemprop="title">{{$chapter ->story_name}}</span></a></li>
            <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a   itemprop="url" href="{{ URL::current() }}"><i class="material-icons">archive</i><span itemprop="title">{{$chapter ->chapter_name}}</span></a></li>
        </ol>
    </div>
</div>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-l-30 p-r-30">
            <div class="align-center p-t-10">
                <button class="btn bg-purple btn-block btn-xs waves-effect full-page" style="width:  200px;" onclick="if($.cookie('ffullpage') == '1') {$.cookie('ffullpage',0,{ path: '/' });}else{$.cookie('ffullpage',1,{ path: '/' }); } ">Full Màn Hình</button>
            </div>
            <div class="align-center">
                <a href="{{route('storydetailpage.index',['story_name_link'=> $chapter ->story_name_link])}}" class="truyen-title not-hover" href="{{route('storydetailpage.index',['story'=>$chapter ->story_name_link])}}" title="Thực Nhân Hoa"><h2 class="col-teal">{{$chapter ->story_name}}</h2></a>
            </div>
            <div class="align-center">
                <span class="font-14"><h3 class="font-18">{{$chapter ->chapter_name}}</h3></span>
            </div>
            <div class="align-center m-t-10">
                <a @if($chapterPrev->chapter_name_link !=null) href="{{route('chapterpage.index',['story_name_link'=>$chapterPrev ->story_name_link,'chapter_name_link'=>$chapterPrev ->chapter_name_link])}}" @endif class="btn bg-pink waves-effect" @if($chapterPrev->chapter_name_link == null) disabled="disabled" @endif>
                    <i class="material-icons">navigate_before</i>
                    <span>TRƯỚC</span>
                </a>
                <button type="button" class="btn bg-pink waves-effect" data-toggle="modal" data-target="#defaultModal">
                                    <i class="material-icons">settings</i>
                                </button>
                <a @if($chapterNext->chapter_name_link !=null) href="{{route('chapterpage.index',['story_name_link'=>$chapterNext ->story_name_link,'chapter_name_link'=>$chapterNext ->chapter_name_link])}}" @endif class="btn bg-pink waves-effect" @if($chapterNext->chapter_name_link == null) disabled="disabled" @endif >
                    <span>SAU</span><i class="material-icons">navigate_next</i>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="container m-t-20">
    <div class="row custum-width" style="margin: 0 auto;">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-r-10 p-l-0">
            <div class="content-chapter font-24 align-justify">
                {!!$chapter ->chapter_content!!}
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-l-30 p-r-30">
            <div class="align-center m-t-10 m-b-10">
                <a @if($chapterPrev->chapter_name_link !=null) href="{{route('chapterpage.index',['story_name_link'=>$chapterPrev ->story_name_link,'chapter_name_link'=>$chapterPrev ->chapter_name_link])}}" @endif class="btn bg-pink waves-effect" @if($chapterPrev->chapter_name_link == null) disabled="disabled" @endif>
                    <i class="material-icons">navigate_before</i>
                    <span>TRƯỚC</span>
                </a>
                <button type="button" class="btn bg-pink waves-effect" data-toggle="modal" data-target="#defaultModal">
                                    <i class="material-icons">settings</i>
                                </button>
                <a @if($chapterNext->chapter_name_link !=null) href="{{route('chapterpage.index',['story_name_link'=>$chapterNext ->story_name_link,'chapter_name_link'=>$chapterNext ->chapter_name_link])}}" @endif class="btn bg-pink waves-effect" @if($chapterNext->chapter_name_link == null) disabled="disabled" @endif >
                    <span>SAU</span><i class="material-icons">navigate_next</i>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Default Size -->
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Cài Đặt Giao Diện</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label>Màu Nền</label>
                        <div class="form-group demo-radio-button">
                            <input name="group" type="radio" id="radio_1"  value ="#232323" />
                            <label for="radio_1">Màu Tối</label>
                            <input name="group" type="radio" id="radio_2" value ="#FFF"/>
                            <label for="radio_2">Màu Trắng</label>
                            <input name="group" type="radio" id="radio_3" value ="#EFEFAB"/>
                            <label for="radio_3">Vàng Ố</label>
                            <input name="group" type="radio" id="radio_4" value ="#FAFAC8"/>
                            <label for="radio_4">Vàng Đậm</label>
                            <input name="group" type="radio" id="radio_5" value ="#D5D8DC"/>
                            <label for="radio_5">Xanh Đậm</label>
                            <input name="group" type="radio" id="radio_6" value ="#EAE4D3"/>
                            <label for="radio_6">Màu sepia</label>
                            <input name="group" type="radio" id="radio_7" value ="#F4F4E4"/>
                            <label for="radio_7">Vàng Nhạc</label>
                            <input name="group" type="radio" id="radio_8" value ="#E9EBEE" checked/>
                            <label for="radio_8">Xanh Nhạc</label>
                            <input name="group" type="radio" id="radio_9" value ="#F4F4F4"/>
                            <label for="radio_9">Xám Nhạc</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label>Font Chữ </label>
                        <select class="form-control font-form-control">
                            <option value="'Times New Roman', sans-serif" selected="selected">Times New Roman</option> 
                            <option value="Verdana, sans-serif">Verdana</option> 
                            <option value="Tahoma, sans-serif">Tahoma</option> 
                            <option value="Arial, sans-serif">Arial</option>
                            <option value="'Segoe UI', sans-serif">Segoe UI</option>
                            <option value="Roboto, sans-serif">Roboto</option>
                            <option value="'Patrick Hand', sans-serif">Patrick Hand</option> 
                            <option value="'Noticia Text', sans-serif">Noticia Text</option> 
                            <option value="'Palatino Linotype', sans-serif">Palatino Linotype</option>
                            <option value="'Source Sans Pro', sans-serif">Source Sans Pro</option> 

                        </select>
                    </div>
                    <div class="col-md-12 m-t-20 p-l-0">
                        <label class="col-md-4 col-sm-12 col-xs-12">Cỡ Chữ</label>
                        <div class="btn-group group-size m-l-15" role="group">
                            <button type="button" class="btn bg-teal waves-effect" onclick="if($('.btn-text-size').text() > 10){$.cookie('csize',Number($('.btn-text-size').text()) - 1,{ path: '/' });$('.btn-text-size').text(Number($('.btn-text-size').text()) - 1);}"><i class="material-icons">remove</i></button>
                            <button type="button" class="btn btn-default waves-effect" style="width: 100px; height:37px;"><span class="btn-text-size">24</span></button>
                            <button type="button" class="btn bg-teal waves-effect" onclick="if($('.btn-text-size').text()<40){$.cookie('csize',Number($('.btn-text-size').text())+1,{ path: '/' });$('.btn-text-size').text(Number($('.btn-text-size').text()) + 1);}"><i class="material-icons">add</i></button>
                        </div>
                    </div>
                    <div class="col-md-12 m-t-20 p-l-0">
                        <label class="col-md-4 col-sm-12 col-xs-12">Chiều rộng Khung</label>
                        <div class="btn-group group-framesize m-l-15" role="group">
                            <button type="button" class="btn bg-teal waves-effect" onclick="if($('.btn-text-framesize').text()>50){$.cookie('cfull',Number($('.btn-text-framesize').text())-10,{ path: '/' });$('.btn-text-framesize').text(Number($('.btn-text-framesize').text()) - 10);}"><i class="material-icons">remove</i></button>
                            <button type="button" class="btn btn-default waves-effect" style="width: 100px; height:37px;"><span class="btn-text-framesize">100</span>%</button>
                            <button type="button" class="btn bg-teal waves-effect" onclick="if($('.btn-text-framesize').text()<100){$.cookie('cfull',Number($('.btn-text-framesize').text())+10,{ path: '/' });$('.btn-text-framesize').text(Number($('.btn-text-framesize').text()) + 10);}"><i class="material-icons">add</i></button>
                        </div>
                    </div>
                    <div class="col-md-12 m-t-20 p-l-0">
                        <label class="col-md-4 col-sm-12 col-xs-12">Dãn Dòng</label>
                        <div class="btn-group group-lineheight m-l-15" role="group">
                            <button type="button" class="btn bg-teal waves-effect" onclick="if($('.btn-text-lineheight').text()>100){$.cookie('cline',Number($('.btn-text-lineheight').text())-10,{ path: '/' });$('.btn-text-lineheight').text(Number($('.btn-text-lineheight').text()) - 10);}"><i class="material-icons">remove</i></button>
                            <button type="button" class="btn btn-default waves-effect" style="width: 100px; height:37px;"><span class="btn-text-lineheight">100</span>%</button>
                            <button type="button" class="btn bg-teal waves-effect" onclick="if($('.btn-text-lineheight').text()<200){$.cookie('cline',Number($('.btn-text-lineheight').text())+10,{ path: '/' });$('.btn-text-lineheight').text(Number($('.btn-text-lineheight').text()) + 10);}"><i class="material-icons" >add</i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect setting-default">Có Lợi Cho Mắt</button>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

@endsection
<!-- #END# Content -->

<!-- Custom Js -->
@section('customJs')
<script src="{{ asset('plugins/jquery-cookie/jquery.cookie.js') }}"></script>
<script src="{{ asset('js/chapter.js') }}"></script>
@endsection
<!-- #END# Custom Js -->
