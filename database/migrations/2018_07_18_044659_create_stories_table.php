<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->increments('story_id');
            $table->string('story_name');
            $table->string('story_name_link');
            $table->integer('author_id') ->unsigned();
            $table->string('story_image');
            $table->text('story_type');
            $table->text('story_intro');
            $table->float('story_rating', 5, 2);
            $table->integer('story_rating_sum') ->unsigned();
            $table->integer('story_view') ->unsigned();
            $table->integer('story_sum_chapter') ->unsigned();
            $table->string('story_source');
            $table->string('story_status');
            $table->integer('story_price');
            $table->integer('update_id');
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
        Schema::dropIfExists('stories');
    }
}
