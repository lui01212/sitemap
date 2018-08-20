<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\StoryType;

use App\Stories;

use DB;

class indexController extends Controller
{
    public  function index(){

    	$storyType = StoryType::all();
		//----------------------------------------------------------------------//
    	$stories = DB::table('stories') 

    				->leftjoin('story_authors',function($leftjoin){
                            $leftjoin->on('story_authors.author_id','stories.author_id')
                                     ->where('stories.flag','=',1);
                    })
					->where('stories.story_rating','>=','9')

					->where('stories.story_status','=','1')
					
    				->select('stories.story_name'
    					,'stories.story_name_link'
    					,'stories.story_sum_chapter'
    					,'stories.story_view'
    					,'stories.story_image'
    					,'story_authors.author_name'
    				)

    				->orderBy('stories.story_view', 'desc')

    				->limit(13)

    				->get();
    	//----------------------------------------------------------------------//
    	$storiesNewUpdate = DB::table('stories')
		                    ->leftjoin('story_list_details',function($leftjoin){
		                            $leftjoin->on('story_list_details.story_id','stories.story_id')
		                                     ->on('story_list_details.chapter','=','stories.story_sum_chapter')
		                                     ->where('story_list_details.flag','=',1);
		                    })

		                    ->where('stories.story_status','=','1')

							->select('stories.story_name'
									,'stories.story_name_link'
									,'stories.story_type'
									,'stories.updated_at'
									,'story_list_details.chapter'
									,'story_list_details.chapter_name'
									,'story_list_details.chapter_name_link'
									)
							->orderBy('stories.updated_at', 'desc')

							->limit(17)

							->get();
		//----------------------------------------------------------------------//
		$storiesHotWeek = DB::table('stories')
							->where('stories.story_rating','>=','9')
							->where('stories.story_view','>','1000')
							->where('stories.story_status','=','1')
							->select('stories.story_name'
								,'stories.story_image'
								,'stories.story_name_link'
								,'stories.story_type'
								,'stories.story_sum_chapter'
								)
							->orderBy('stories.story_rating', 'desc')

							->limit(10)

							->get();
		//----------------------------------------------------------------------//
		$storiesHotMonth = DB::table('stories')

							->where('stories.story_rating','>=','9')

							->where('stories.story_view','>','1000')

							->where('stories.story_status','=','1')

							->where('stories.updated_at','>',date_modify(new \DateTime(), "-1 months"))

							->select('stories.story_name'
								,'stories.story_image'
								,'stories.story_name_link'
								,'stories.story_type'
								,'stories.story_sum_chapter'
							)
							->orderBy('stories.story_rating', 'desc')

							->limit(10)

							->get();
		//----------------------------------------------------------------------//
		$storiesHotAll= DB::table('stories')

						->where('stories.story_rating','>=','9')

						->where('stories.story_view','>','1000')

						->where('stories.story_status','=','1')

						->select('stories.story_name'
							,'stories.story_image'
							,'stories.story_name_link'
							,'stories.story_type'
							,'stories.story_sum_chapter'
							)

						->orderBy('stories.updated_at', 'desc')

						->limit(10)

						->get();
		//----------------------------------------------------------------------//
		$storiesFull= DB::table('stories')

					->where('stories.story_rating','>=','7')

					->where('stories.story_status','=','1')

                    ->leftjoin('story_authors',function($leftjoin){
                            $leftjoin->on('story_authors.author_id','stories.author_id')
                                     ->where('stories.flag','=',1);
                    })
					->select('stories.story_name'
							,'stories.story_image'
							,'stories.story_name_link'
							,'stories.story_type'
							,'stories.story_view'
							,'stories.story_type'
							,'story_authors.author_name'
							,'stories.story_sum_chapter'
							)

					->orderBy('stories.updated_at', 'desc')

					->limit(10)

					->get();
		//----------------------------------------------------------------------//
		$storiesNew = DB::table('stories')
                    ->leftjoin('story_authors',function($leftjoin){
                            $leftjoin->on('story_authors.author_id','stories.author_id')
                                     ->where('stories.flag','=',1);
                    })
					->select('stories.story_name'
							,'stories.story_image'
							,'stories.story_name_link'
							,'stories.story_type'
							,'stories.story_view'
							,'stories.story_type'
							,'story_authors.author_name'
							,'stories.story_sum_chapter'
							)
					->orderBy('stories.created_at', 'desc')

					->limit(10)

					->get();
		//----------------------------------------------------------------------//
		$storiesOffer= DB::table('stories')
						->where('stories.story_view','>','1000')
	                    ->leftjoin('story_authors',function($leftjoin){
	                            $leftjoin->on('story_authors.author_id','stories.author_id')
	                                     ->where('stories.flag','=',1);
	                    })
						->select('stories.story_name'
								,'stories.story_image'
								,'stories.story_name_link'
								,'stories.story_type'
								,'stories.story_view'
								,'stories.story_type'
								,'story_authors.author_name'
								,'stories.story_sum_chapter'
								)

						->orderBy('stories.story_rating', 'desc')

						->limit(10)

						->get();
		//----------------------------------------------------------------------//
    	return view('page.index',['storyType' => $storyType
    							,'stories' => $stories
    							,'storiesNewUpdate' =>$storiesNewUpdate
    							,'storiesHotWeek'=>$storiesHotWeek
    							,'storiesHotMonth'=>$storiesHotMonth
    							,'storiesHotAll'=>$storiesHotAll
    							,'storiesFull'=>$storiesFull
    							,'storiesNew'=>$storiesNew
    							,'storiesOffer'=>$storiesOffer]
    				);
    }
}
