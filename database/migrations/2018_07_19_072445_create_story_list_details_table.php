<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoryListDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('story_list_details', function (Blueprint $table) {
            $table->increments('chapter_id');
            $table->integer('chapter') ->unsigned();
            $table->integer('story_id') ->unsigned();
            $table->string('chapter_name');
            $table->string('chapter_name_link');
            $table->mediumText('chapter_content');
            $table->integer('flag');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('story_list_details');
    }
}
