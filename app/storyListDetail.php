<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class storyListDetail extends Model
{
    //
    protected $table 		= 'story_list_details';
    //
    protected $primaryKey 	= 'chapter_id';
    //
    protected $fillable 	= ['chapter_id','story_id','chapter','chapter_name','chapter_content','flag'];
    //
}
