@extends('page.detailPage')

@section('description','Đọc truyện '.$story ->story_name.' chương mới nhất của tác giả '. $story->author_name)

@section('keywords',$story ->story_name.', truyện '.$story ->story_name .',đọc truyện '.$story ->story_name.', truyện '. $story ->story_name.' full ,'. $story->author_name)

@section('OpenGraph')
<meta name="ROBOTS" content="INDEX, FOLLOW">
<meta property="og:locale" content="vi_VN">
<meta property="og:title" content="{{ __('Đọc Truyện Online|Truyện Hay Nhất') }}">
<meta property="og:description" content="{{'Đọc truyện '.$story ->story_name.' chương mới nhất của tác giả '. $story->author_name}}">
<meta property="og:url" content="{{ URL::current() }}">
<meta property="og:site_name" content="detail">
<meta property="og:type" content="website">
<meta property="og:image" content="{{asset('images/' . $story ->story_image )}}">
@endsection

@section('breadcrumb')
<div class="row clearfix" style="margin: 80px 0 0 0;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <ol class="breadcrumb align-center">
            <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="{{ url('/') }}"><i class="material-icons">home</i><span itemprop="title">Home</span></a></li>
            <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="{{ URL::current() }}"><i class="material-icons">library_books</i><span itemprop="title">{{$story ->story_name}}</span></a></li>
        </ol>
    </div>
</div>
@endsection
@section('list-content')

<!-- Badges -->
<div class="row">
    <div class="block-header">
        <div class='block-header-class'>
            <h2 class="block-header-content">         
                <span>THÔNG TIN TRUYỆN</span>
            </h2>
            <hr width="40%">
        </div>
    </div>
    <div class="card">
        <div class="body">
            <div class="row" itemscope itemtype="http://schema.org/Book">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <a href="javascript:void(0);" class="thumbnail" style="height: 100%; width: 100%; margin: 0 auto;">
                        <img alt="{{$story ->story_name}}" itemprop="image" src="{{asset('images/' . $story ->story_image )}}" style="max-height: 300px; width: 100%;">
                    </a>
                                        @foreach($stories as $key => $value)
                    @if($key == 1) 
                    @break;
                    @endif
                    <a href="{{route('chapterpage.index',['story_name_link'=>$value ->story_name_link,'chapter_name_link'=>$value->chapter_name_link])}}"" class="btn bg-pink btn-block btn-lg waves-effect m-t-20">ĐỌC TỪ ĐẦU</a>
                    @endforeach
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="align-center">
                        <h2 itemprop="name" class="font-25 col-teal">{{$story ->story_name}}</h2>
                        <hr width="30%" align="center">
                    </div>
                    <div class="align-center m-t-20" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                        <h3 class="font-20 col-teal">Đánh Giá</h3>
                        <div class="rateit" data-productid="{{$story ->story_name_link}}" data-rateit-value="{{$story ->story_rating}}" data-rateit-min="0" data-rateit-max="10"></div>
                        <span class="badge bg-teal font-20 m-l-5 rateit-text">{{$story ->story_rating}}</span>
                        <h6 class="font-italic comment-rateit-text">Đã có <span class="rating_sum" itemprop="ratingCount">{{$story ->story_rating_sum}}</span> lược đánh giá <span class="rating" itemprop="ratingValue">{{$story ->story_rating}}</span>/<span itemprop="bestRating">10</span></h6>
                    </div>
                    <ul class="list-unstyled">
                        <li>&nbsp;</li>
                        <li itemprop="author" itemscope itemtype="http://schema.org/Person"><span class="font-bold">Tác Giả : </span><a class="col-teal" itemprop="url" href="{{route('authorpage.index',['author'=>$story ->author_name_link])}}" title="{{$story ->author_name}}"><span itemprop="name">{{$story->author_name}}</span></a></li>
                        <li>&nbsp;</li>
                        <li><span class="font-bold">Thể Loại :</span>
                            <span>
                                <?php $step = ''; ?>
                                @foreach($storyType as $type)
                                @foreach(unserialize($story ->story_type) as $types)
                                @if($types == $type ->type_id)
                                {{$step}}<a  class="col-teal" itemprop="genre" title="{{$type->type_name}}" href="{{route('typepage.index',['type'=>$type->type_name_link])}}">{{$type->type_name}}</a>
                                <?php $step =','; ?>
                                @break;
                                @endif
                                @endforeach
                                @endforeach
                            </span>
                        </li>
                        <li>&nbsp;</li>
                        <li><span class="font-bold">Tình Trạng :</span>
                            <span>@if($story->story_status == '1')
                                {{__('Hoàn Thành')}}
                                @else
                                {{__('Đang Ra')}}
                                @endif
                            </span>
                        </li>
                        <li>&nbsp;</li>
                        <li><span class="font-bold">Nguồn :</span><span>{{$story->story_source}}</span></li>
                        <li>&nbsp;</li>
                    </ul>

                </div>
                <span class="none" itemprop="description">{!! $story ->story_intro !!}
                </span>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="align-center m-b-10">
                        <h3 class="font-25 col-teal">Tóm Lược</h3>
                        <hr width="30%" align="center">
                    </div>
                    <div class="p-l-10 p-r-10 p-t-10 p-b-10 font-20" style="background-color: #f9f9f9;">
                        {!! $story ->story_intro !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="block-header">
        <div class='block-header-class'>
            <h2 class="block-header-content">         
                <span>DANH SÁCH CHƯƠNG</span>
            </h2>
            <hr>
        </div>
    </div>
    <div class="card">
        <div class="body">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 m-t-20 font-16">
                    @foreach($stories as $key => $value)
                    @if($key == 25) 
                    @break;
                    @endif
                    <div class="list-item" style="background-color: #f9f9f9;">
                        <span class="glyphicon glyphicon-certificate"></span><a class="m-l-5 col-blue-grey"  href="{{route('chapterpage.index',['story_name_link'=>$value ->story_name_link,'chapter_name_link'=>$value->chapter_name_link])}}" title="Vương {{$value ->story_name}} - {{$value->chapter_name}}">{{$value->chapter_name}}</a>
                    </div>
                    @endforeach
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 m-t-20 font-16">
                    @foreach($stories as $key => $value)
                    @if($key < 25)
                    @continue;
                    @endif
                    <div class="list-item" style="background-color: #f9f9f9;">
                        <span class="glyphicon glyphicon-certificate"></span><a class="m-l-10 col-blue-grey" href="{{route('chapterpage.index',['story_name_link'=>$value ->story_name_link,'chapter_name_link'=>$value->chapter_name_link])}}" title="Vương {{$value ->story_name}} - {{$value->chapter_name}}">{{$value->chapter_name}}</a>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="row m-t-20 m-r-10 m-l-10" style="background-color: #fff;">
                @if ($stories->lastPage() > 1)
                <ul class="pagination m-l-10">
                    @for ($i = 1; $i <= $stories->lastPage(); $i++)
                    <li class="{{ ($stories->currentPage() == $i) ? ' active' : '' }}">
                        <a href="{{ $stories->url($i) }}">{{ $i }}</a>
                    </li>
                    @endfor
                </ul>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="m-t-20">
        <div class="block-header">
            <div class='block-header-class'>
                <h2 class="block-header-content">         
                    <span>CẢM NHẬN CỦA BẠN</span>
                </h2>
                <hr>
            </div>
        </div>
        <div class="card">
            <div class="body">
                <div class="row">
                    <div class="fb-comments" data-href="http://cuongtruyen.com/" data-numposts="5" data-width="100%"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('description_Sidebar')
<?php 
$arrayColor  = array('bg-green' ,'bg-light-green','bg-lime','bg-yellow','bg-amber','bg-orange','bg-deep-orange','bg-brown','bg-grey','bg-blue-grey');
?>
<div class="row p-r-25 p-l-15">
 <div class="block-header" style="margin-top: 15px;
    margin-bottom: 0px;">
    <div class="block-header-class" >
  <h3 class="block-header-content">         
            <span>TRUYỆN CÙNG TÁC GIẢ</span>         
  </h3>
</div>
</div>
<div class="card">
    <div class="body">
        <ul class="list-group">
            @foreach($authorStory as  $key => $story)
            <li class="list-group-item text-overflow">
                <button type="button" class="btn {{$arrayColor[$key]}} btn-circle waves-effect waves-circle waves-float m-r-5" style="width: 30px; height: 30px; line-height: 15px;">
                    {{$key +1 }}
                </button>
                <a href="{{route('storydetailpage.index',['story_name_link'=> $story ->story_name_link])}}"><span class="style:">{{$story->story_name}}</span>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>
</div>

@endsection
<!-- Custom Js -->
@section('customJs')
<link href="{{ asset('plugins/rateit/src/rateit.css') }}" rel="stylesheet" />
<script src="{{ asset('plugins/jquery-cookie/jquery.cookie.js') }}"></script>
<script src="{{ asset('plugins/rateit/src/jquery.rateit.min.js') }}"></script>
<script src="{{ asset('js/storydetail.js') }}"></script>
<script type="text/javascript">
    var base_url = '{!! url('/rating/'. $story ->story_name_link) !!}';
</script>
@endsection
<!-- #END# Custom Js -->
