<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class storyTypeDetail extends Model
{
    //
    protected $table = 'story_type_details';
    //
    protected $fillable = ['story_id','type_id'];
    //
}
