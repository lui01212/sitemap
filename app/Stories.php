<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stories extends Model
{
    //
    protected $table = 'stories';
    //
    protected $primaryKey = 'story_id';
    //
    protected $fillable = ['story_id','story_name','story_name_link','author_id','story_image','story_type','story_intro','story_rating','story_rating_sum','story_view','story_sum_chapter','story_source','story_status','story_price','update_id','flag'];
    //
}
