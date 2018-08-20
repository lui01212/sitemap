<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoryAuthor extends Model
{
     //
    protected $table = 'story_authors';
    //
    protected $primaryKey = 'author_id';
    //
    protected $fillable = ['author_id','author_name','flag'];
    //
}
