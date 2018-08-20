<div class="block-header" style="margin-top: 15px;
    margin-bottom: 0px;" >
    <div class="block-header-class">
        <h3 class="block-header-content">         
            <span>TRUYỆN ĐANG HOT</span>         
        </h3>
    </div>
</div>
<div class="card">
    <div class="body">
        <ul class="nav nav-tabs tab-col-teal nav-custum" role="tablist">
            <li role="presentation" class="active">
                <a href="#profile_md_col_3" data-toggle="tab">TUẦN</a>
            </li>
            <li role="presentation">
                <a href="#messages_md_col_3" data-toggle="tab">THÁNG</a>
            </li>
            <li role="presentation">
                <a href="#messages_animation_1" data-toggle="tab">NĂM+</a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane animated flipInX active" id="profile_md_col_3">
                @if(isset($storiesHotWeek))
                @foreach($storiesHotWeek as $story)
                <div class="media media-custum" itemscope itemtype="http://schema.org/Book">
                    <div class="media-left">
                        <a href="{{route('storydetailpage.index',['story'=>$story->story_name_link])}}">
                            <img @if(Request::is('/')) alt="doc truyen,doc truyen online" title="doc truyen,doc truyen online" @endif @if(!Request::is('/')) alt="{{$story ->story_name}}" title="doc truyen,doc truyen online" @endif itemprop="image" class="media-object" src="{{asset('images/' . $story ->story_image )}}" width="40" height="40">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 itemprop="name" class="media-heading text-truncate"><a itemprop="url" href="{{route('storydetailpage.index',['story'=>$story->story_name_link])}}" title="{{$story->story_name}}">{{$story->story_name}}</a></h4>
                        <?php $step = ''; ?>
                        @foreach($storyType as $type)
                        @foreach(unserialize($story ->story_type) as $types)
                        @if($types == $type ->type_id)
                        {{$step}}<a itemprop="genre" title="{{$type->type_name}}" href="{{route('typepage.index',['type'=>$type->type_name_link])}}">{{$type->type_name}}</a>
                        <?php $step =', '; ?>
                        @break;
                        @endif
                        @endforeach
                        @endforeach
                    </div>
                </div>
                @endforeach
                @endif
            </div>
            <div role="tabpanel" class="tab-pane animated flipInX" id="messages_md_col_3">
                @if(isset($storiesHotMonth))
                @foreach($storiesHotMonth as $story)
                <div class="media media-custum" itemscope itemtype="http://schema.org/Book">
                    <div class="media-left">
                        <a href="{{route('storydetailpage.index',['story'=>$story->story_name_link])}}">
                            <img @if(Request::is('/')) alt="doc truyen,doc truyen online" title="doc truyen,doc truyen online" @endif  @if(!Request::is('/')) alt="{{$story ->story_name}}" title="doc truyen,doc truyen online" @endif  itemprop="image" class="media-object" src="{{asset('images/' . $story ->story_image )}}" width="40" height="40">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 itemprop="name" class="media-heading text-truncate"><a itemprop="url" href="{{route('storydetailpage.index',['story'=>$story->story_name_link])}}" title="{{$story->story_name}}">{{$story->story_name}}</a></h4>
                        <?php $step = ''; ?>
                        @foreach($storyType as $type)
                        @foreach(unserialize($story ->story_type) as $types)
                        @if($types == $type ->type_id)
                        {{$step}}<a itemprop="genre" title="{{$type->type_name}}" href="{{route('typepage.index',['type'=>$type->type_name_link])}}">{{$type->type_name}}</a>
                        <?php $step =', '; ?>
                        @break;
                        @endif
                        @endforeach
                        @endforeach
                    </div>
                </div>
                @endforeach
                @endif
            </div>
            <div role="tabpanel" class="tab-pane animated flipInX" id="messages_animation_1">
                @if(isset($storiesHotAll))
                @foreach($storiesHotAll as $story)
                <div class="media media-custum" itemscope itemtype="http://schema.org/Book">
                    <div class="media-left">
                        <a href="{{route('storydetailpage.index',['story'=>$story->story_name_link])}}">
                            <img @if(Request::is('/')) alt="doc truyen,doc truyen online" title="doc truyen,doc truyen online" @endif @if(!Request::is('/')) alt="{{$story ->story_name}}" title="doc truyen,doc truyen online" @endif itemprop="image" class="media-object" src="{{asset('images/' . $story ->story_image )}}" width="40" height="40">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 itemprop="name" class="media-heading text-truncate"><a itemprop="url" href="{{route('storydetailpage.index',['story'=>$story->story_name_link])}}" title="{{$story->story_name}}">{{$story->story_name}}</a></h4>
                        <?php $step = ''; ?>
                        @foreach($storyType as $type)
                        @foreach(unserialize($story ->story_type) as $types)
                        @if($types == $type ->type_id)
                        {{$step}}<a itemprop="genre" title="{{$type->type_name}}" href="{{route('typepage.index',['type'=>$type->type_name_link])}}">{{$type->type_name}}</a>
                        <?php $step =', '; ?>
                        @break;
                        @endif
                        @endforeach
                        @endforeach
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
