@if($stories)
@foreach($stories as $key =>$value)
<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 p-l-30 p-r-30">
	<a class="not-hover" href="{{route('storydetailpage.index',['story_name_link'=>$value ->story_name_link])}}">
	<div class="media">
	    <div class="media-left">
	        <img class="media-object" src="{{asset('images/' . $value ->story_image )}}" width="64" height="64">
	    </div>
	    <div class="media-body">
	        <h4 class="media-heading col-teal">{{$value ->story_name}}</h4>{{$value ->author_name}}
	    </div>
	</div>
	 </a>
</div>
@endforeach
@endif
