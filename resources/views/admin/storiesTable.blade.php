@extends('layouts.masterAdmin')

<!-- Custom Css Js-->
@section('customCssJs')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<!-- JQuery DataTable Css -->
<link href="{{ asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
@endsection
<!-- #END# Custom Css Js -->

<!-- Content -->
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <a href="{{ route('storiesmaster.create') }}" class="btn btn-success waves-effect">
            <i class="material-icons">add</i>
            <span>THÊM TRUYỆN</span>
        </a>
    </div>
    <!-- Basic Examples -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        TRUYỆN
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>Tên Truyện</th>
                                    <th>Ảnh Đại Diện</th>
                                    <th>Tác Giả</th>
                                    <th>Nguồn</th>
                                    <th>Loại Truyện</th>
                                    <th>Số Chương</th>
                                    <th>Lược Xem</th>
                                    <th>Đánh Giá</th>
                                    <th>Trạng Thái</th>
                                    <th>Tính Phí</th>
                                    <th>Flag</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($stories as $story)
                                <tr>
                                    <td>{{$story ->story_name}}</td>
                                    <td>
                                        <img src="{{asset('images/' . $story ->story_image )}}" width="120" height="120">
                                    </td>
                                    <td>{{$story ->author_name}}</td>
                                    <td>{{$story ->story_source}}</td>
                                    <td>
                                        @foreach(unserialize($story ->story_type) as $type)
                                            @foreach($storyType as $types)
                                                @if($type == $types ->type_id)
                                                    {{ $types ->type_name }}
                                                    @break;
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </td>
                                    <td>{{$story ->story_sum_chapter}}</td>
                                    <td>{{$story ->story_view}}</td>
                                    <td>
                                        {{$story ->story_rating . __(' *')}}
                                    </td>
                                    <td>
                                        @if($story ->story_status == 1)
                                        {{__('Hoàn Thành')}}
                                        @else
                                        {{__('Đang Ra')}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($story ->story_price == 1)
                                        {{__('Có Phí')}}
                                        @else
                                        {{__('Không Phí')}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($story ->flag == 1)
                                        {{__('true')}}
                                        @else
                                        {{__('false')}}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('storiesmaster.edit', ['id' => $story ->story_id]) }}" type="button" class="btn btn-default waves-effect">
                                            <i class="material-icons">mode_edit</i>
                                        </a>
                                        <a href="{{ route('storydetail.index', ['id' => $story ->story_id]) }}" type="button" class="btn bg-purple waves-effect">
                                            <i class="material-icons">list</i>
                                        </a>
                                        <a type="button" class="btn bg-red waves-effect" onclick="event.preventDefault();
                                                 document.getElementById('destroy{{$story ->story_id}}').submit();">
                                            <i class="material-icons">delete_forever</i>
                                        </a>
                                        <form id="destroy{{$story ->story_id}}" action="{{ route('storiesmaster.destroy', ['id' => $story ->story_id]) }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Basic Examples -->
</div>
@endsection
<!-- #END# Content -->

<!-- Custom Js -->
@section('customJs')
<!-- Jquery DataTable Plugin Js -->
<script src="{{ asset('plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
<!-- #END - Jquery DataTable Plugin Js -->
<script src="{{ asset('js/admin.js') }}"></script>
<script src="{{ asset('js/pages/tables/jquery-datatable.js') }}"></script>
@endsection
<!-- #END# Custom Js -->
