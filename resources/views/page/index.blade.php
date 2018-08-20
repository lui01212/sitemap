@extends('layouts.masterPage')

@section('description','Đọc truyện online hay nhất.Luôn cập nhật những truyện hay và truyện hot liên tục với các thể loại truyện Kiếm hiệp, Tiên hiệp, Sắc hiệp, Đô thị, Ngôn tình, Truyện Convert, Truyện VIP, Truyện Dịch Hoàn Thành Full')

@section('keywords','Đọc truyện, truyện hay,doc truyen online,truyen chu,truyện tiên hiệp')

@section('breadcrumb')
<div class="row clearfix" style="margin: 80px 0 0 0;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <ol class="breadcrumb align-center">
            <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="{{ url('/') }}"><i class="material-icons">home</i><span itemprop="title" >Home</span></a></li>
        </ol>
    </div>
</div>
@endsection

@section('OpenGraph')
<meta name="ROBOTS" content="INDEX, FOLLOW">
<meta property="og:locale" content="vi_VN">
<meta property="og:title" content="{{ __('Đọc Truyện Online|Truyện Hay Nhất') }}">
<meta property="og:description" content="Đọc truyện online hay nhất.Luôn cập nhật những truyện hay và truyện hot liên tục với các thể loại truyện Kiếm hiệp, Tiên hiệp, Sắc hiệp, Đô thị, Ngôn tình, Truyện Convert, Truyện VIP, Truyện Dịch Hoàn Thành Full.">
<meta property="og:url" content="{{ URL::current() }}">
<meta property="og:site_name" content="main">
<meta property="og:type" content="website">
<meta property="og:image" content="{{asset('images/logo.jpg')}}">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row" id="story-hot">
        <div class="col-md-10 col-md-offset-1">
            <!-- Badges -->
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-7 col-xs-7">
                        <div class='block-header-class'>
                            <h2 class="block-header-content">         
                                <span>TRUYỆN HOT</span>
                            </h2>
                            <hr>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5 col-md-offset-6  col-lg-offset-6">
                        <form method="POST" action="{{ route('typepageredirect.index') }}">
                            {{ csrf_field() }}
                            <select class="form-control"  onchange="this.form.submit()" name="type_name_link">
                                @foreach($storyType as $type)
                                <option value="{{$type ->type_name_link}}">{{$type->type_name}}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-0 col-sm-0 col-xs-0 m-t-5">
                <div class="list-group  list-group-custum">
                    @foreach($storyType as $key => $type)
                    @if($key == 12) 
                    @break;
                    @endif
                    <a href="{{route('typepage.index',['type_name_link'=>$type->type_name_link])}}" class="list-group-item col-teal">{{$type ->type_name}}</a>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="row col-xs-0">
                    <div class="card-carousel">
                        @foreach($stories as $key => $story)
                        @if($key == 7)
                        @break;
                        @endif
                        <div class="my-card" itemscope itemtype="http://schema.org/Book">
                            <img alt="doc truyen,doc truyen online" title="doc truyen,doc truyen online" itemprop="image" src="{{asset('images/' . $story ->story_image )}}" />
                            <div class="my-card-content">
                                <p itemprop="name">{{$story ->story_name}}</p>
                                <a itemprop="url" href="{{route('storydetailpage.index',['story_name_link'=> $story ->story_name_link])}}" class="btn bg-pink btn-block btn-xs waves-effect">Đọc<span class="badge">{{round ($story ->story_view/1000 , 2)}}Kv</span></a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn btn-default btn-circle bnt-prev waves-effect waves-circle waves-float">
                        <i class="material-icons">navigate_before</i>
                    </button>
                    <button type="button" class="btn btn-default btn-circle bnt-next waves-effect waves-circle waves-float">
                        <i class="material-icons">navigate_next</i>
                    </button>
                </div>

                <div class="row">
                    @foreach($stories as $key => $story)
                    @if($key < 7)
                    @continue;
                    @endif
                    <div class="column col-lg-2 col-md-2 col-sm-4 col-xs-4  m-t-25" itemscope itemtype="http://schema.org/Book">
                        <a href="{{route('storydetailpage.index',['story'=> $story ->story_name_link])}}">
                        <img  alt="doc truyen,doc truyen online" title="doc truyen,doc truyen online" itemprop="image" class="hover-shadow" src="{{asset('images/' . $story ->story_image )}}" style="width: 100%" />
                        </a>
                        <div class="top-right"><span class="badge bg-pink">Hot</span></div>
                        <div class="column-contents">
                            <h6 class="text-nowrap" itemprop="name" ><a class="col-teal" itemprop="url" href="{{route('storydetailpage.index',['story'=> $story ->story_name_link])}}" >{{$story->story_name}}</a></h6>
                            <h6>{{$story->story_sum_chapter}} chương</h6>
                        </div>
                        <a href="{{route('storydetailpage.index',['story'=> $story ->story_name_link])}}" class="btn bg-pink btn-block btn-xs waves-effect">Đọc<span class="badge">{{round ($story ->story_view/1000 , 2)}}Kv</span></a>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-2 col-md-0 col-sm-0 col-xs-0 m-t-5">
                <div class="list-group list-group-custum">
                    @foreach($storyType as $key => $type)
                    @if($key < 12 || $key > 23) 
                    @continue;
                    @endif
                    <a href="{{route('typepage.index',['type_name_link'=>$type->type_name_link])}}" class="list-group-item col-teal">{{$type ->type_name}}</a>
                    @endforeach
                </div>
            </div>
            <!-- #END# Badges -->
        </div>
    </div>
    <div class="row m-t-85">
        <div class="col-md-10 col-md-offset-1">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="block-header">
                        <div class='block-header-class'>
                            <h2 class="block-header-content">         
                                <span>TRUYỆN MỚI CẬP NHẬT</span>
                            </h2>
                            <hr>
                        </div>
                    </div>
                    @foreach($storiesNewUpdate as $story)
                    <div class="row row-list-item" itemscope itemtype="http://schema.org/Book">
                        <div class="col-lg-5 col-md-5 col-sm-6 col-xs-9 font-16">
                            <span class="glyphicon glyphicon-chevron-right"></span><a itemprop="url" href="{{route('storydetailpage.index',['story'=>$story ->story_name_link])}}" title="{{$story ->story_name}}"><h3 itemprop="name" class="none">{{$story ->story_name}}</h3>{{$story ->story_name}}</a>
                        </div>
                        <div class="col-lg-3 col-md-0 col-sm-2 col-xs-0">
                            <?php $step = ''; ?>
                            @foreach($storyType as $type)
                            @foreach(unserialize($story ->story_type) as $types)
                            @if($types == $type ->type_id)
                            {{$step}}<a itemprop="genre" class="font-14" title="{{$type->type_name}}" href="{{route('typepage.index',['type_name_link'=>$type->type_name_link])}}">{{$type->type_name}}</a>
                            <?php $step =', '; ?>
                            @break;
                            @endif
                            @endforeach
                            @endforeach
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-2 col-xs-3">
                            <a href="{{route('chapterpage.index',['story'=>$story->story_name_link,'chapter'=>$story ->chapter_name_link])}}" title="{{$story->story_name}}  -  {{$story->chapter_name}}"><span class="chapter-text"><span>Chương </span></span>{{$story ->chapter}}</a>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-2 col-xs-0">
                            <?php 
                            $date = new DateTime($story->updated_at);
                            $now  = new DateTime('now');
                            $diff = $now->getTimestamp() - $date->getTimestamp();
                            ?>
                            {{round($diff/3600,0)==0 ? ' Vừa Mới Đăng' : (round($diff/3600,0) . ' tiếng trước')}}
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <!-- hot For Sidebars -->
                    @include('page.custumPage.hotSidebar')
                    <!-- #END# hot For Sidebars -->
                </div>
            </div>
        </div>
    </div>
    <?php 
    $arrayColor  = array('bg-green' ,'bg-light-green','bg-lime','bg-yellow','bg-amber','bg-orange','bg-deep-orange','bg-brown','bg-grey','bg-blue-grey');
    ?>
    <div class="row m-t-50">
        <div class="col-md-10 col-md-offset-1">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="row p-r-25 p-l-15">
                        <div class="block-header" style="margin-top: 15px;
                        margin-bottom: 0px; border-bottom: 2px solid #009688;">
                        <div class="block-header-class">
                            <h3 class="tde">         
                                <span>TRUYỆN ĐÃ HOÀN THÀNH</span>   
                            </h3>
                        </div>
                    </div>
                    <ul class="list-group">
                        @foreach($storiesFull as $key => $story)
                        @if($key == 0)
                        <li class="list-group-item" style="background-image: url('images/backgroud-list1.jpg'); background-size: 100% 100%;">
                            <div class="row">
                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 m-r-5">
                                    <button type="button" class="btn {{$arrayColor[$key]}} btn-circle waves-effect waves-circle waves-float" style="width: 30px;height: 30px; line-height: 15px;">
                                        {{$key +1 }}
                                    </button>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 text-overflow align-center" itemscope itemtype="http://schema.org/Book">
                                    <a itemprop="url" class="btn bg-purple waves-effect" href="{{route('storydetailpage.index',['story_name_link'=> $story ->story_name_link])}}" ><span itemprop="name">{{$story->story_name}}</span>
                                    </a>
                                    <div class="m-t-10 font-12">
                                        <p>Thể loại:
                                            <?php $step = ''; ?>
                                            @foreach($storyType as $type)
                                            @foreach(unserialize($story ->story_type) as $types)
                                            @if($types == $type ->type_id)
                                            {{$step}}
                                            {{$type->type_name}}
                                            <?php $step =', '; ?>
                                            @break;
                                            @endif
                                            @endforeach
                                            @endforeach
                                        </p>
                                        <p>Tác Giả :{{$story->author_name}}</p>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                </div>
                            </div>
                        </li>
                        @endif
                        @if($key > 0)
                        <li class="list-group-item text-overflow">
                            <button type="button" class="btn {{$arrayColor[$key]}} btn-circle waves-effect waves-circle waves-float m-r-5" style="width: 30px;height: 30px; line-height: 15px;">
                                {{$key +1 }}
                            </button>
                            <a href="{{route('storydetailpage.index',['story_name_link'=> $story ->story_name_link])}}" ><span class="style:">{{$story->story_name}}</span>
                            </a>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="row p-r-25 p-l-15">
                    <div class="block-header" style="margin-top: 15px;
                    margin-bottom: 0px; border-bottom: 2px solid #009688;">
                    <div class="block-header-class">
                        <h3 class="tde">         
                            <span>TRUYỆN MỚI</span>   
                        </h3>
                    </div>
                </div>
                <ul class="list-group">
                    @foreach($storiesNew as $key => $story)
                    @if($key == 0)
                    <li class="list-group-item" style="background-image: url('images/backgroud-list2.jpg'); background-size: 100% 100%;">
                        <div class="row">
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 m-r-5">
                                <button type="button" class="btn {{$arrayColor[$key]}} btn-circle waves-effect waves-circle waves-float" style="width: 30px;height: 30px; line-height: 15px;">
                                    {{$key +1 }}
                                </button>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 text-overflow align-center" itemscope itemtype="http://schema.org/Book">
                                <a itemprop="url" class="btn bg-purple waves-effect" href="{{route('storydetailpage.index',['story_name_link'=> $story ->story_name_link])}}" ><span itemprop ="name">{{$story->story_name}}</span>
                                </a>
                                <div class="m-t-10 font-12">
                                    <p>Thể loại:
                                        <?php $step = ''; ?>
                                        @foreach($storyType as $type)
                                        @foreach(unserialize($story ->story_type) as $types)
                                        @if($types == $type ->type_id)
                                        {{$step}}
                                        {{$type->type_name}}
                                        <?php $step =', '; ?>
                                        @break;
                                        @endif
                                        @endforeach
                                        @endforeach
                                    </p>
                                    <p>Tác Giả :{{$story->author_name}}</p>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endif
                    @if($key > 0)
                    <li class="list-group-item text-overflow">
                        <button type="button" class="btn {{$arrayColor[$key]}} btn-circle waves-effect waves-circle waves-float m-r-5" style="width: 30px;height: 30px; line-height: 15px;">
                            {{$key +1 }}
                        </button>
                        <a href="{{route('storydetailpage.index',['story_name_link'=> $story ->story_name_link])}}" ><span class="style:">{{$story->story_name}}</span>
                        </a>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="row p-r-25 p-l-15">
                <div class="block-header" style="margin-top: 15px;
                margin-bottom: 0px; border-bottom: 2px solid #009688;">
                <div class="block-header-class">
                    <h3 class="tde">         
                        <span>TRUYỆN BTV ĐỀ CỬ</span>   
                    </h3>
                </div>
            </div>
            <ul class="list-group">
                @foreach($storiesOffer as $key => $story)
                @if($key == 0)
                <li class="list-group-item" style="background-image: url('images/backgroud-list3.jpg'); background-size: 100% 100%;">
                    <div class="row">
                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 m-r-5">
                            <button type="button" class="btn {{$arrayColor[$key]}} btn-circle waves-effect waves-circle waves-float" style="width: 30px;height: 30px; line-height: 15px;">
                                {{$key +1 }}
                            </button>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 text-overflow align-center" itemscope itemtype="http://schema.org/Book">
                            <a  itemprop="url" class="btn bg-purple waves-effect" href="{{route('storydetailpage.index',['story_name_link'=> $story ->story_name_link])}}" ><span itemprop="name">{{$story->story_name}}</span>
                            </a>
                            <div class="m-t-10 font-12">
                                <p>Thể loại:
                                    <?php $step = ''; ?>
                                    @foreach($storyType as $type)
                                    @foreach(unserialize($story ->story_type) as $types)
                                    @if($types == $type ->type_id)
                                    {{$step}}
                                    {{$type->type_name}}
                                    <?php $step =','; ?>
                                    @break;
                                    @endif
                                    @endforeach
                                    @endforeach
                                </p>
                                <p>Tác Giả :{{$story->author_name}}</p>
                            </div>
                        </div>
                    </div>
                </li>
                @endif
                @if($key > 0)
                <li class="list-group-item text-overflow">
                    <button type="button" class="btn {{$arrayColor[$key]}} btn-circle waves-effect waves-circle waves-float m-r-5" style="width: 30px;height: 30px; line-height: 15px;">
                        {{$key +1 }}
                    </button>
                    <a href="{{route('storydetailpage.index',['story_name_link'=> $story ->story_name_link])}}" ><span class="style:">{{$story->story_name}}</span>
                    </a>
                </li>
                @endif
                @endforeach
            </ul>
        </div>
    </div>
</div>
</div>
</div>
</div>
@endsection
<!-- #END# Content -->

<!-- Custom Js -->
@section('customJs')
<script src="{{ asset('js/index.js') }}"></script>
@endsection
<!-- #END# Custom Js -->
