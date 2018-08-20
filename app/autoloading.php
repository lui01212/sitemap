<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class autoloading extends Model
{
    //
    protected $table = 'autoloadings';
    //
    protected $fillable = ['story_id','auto_chapter_link','auto_flag','flag'];
    //
}
