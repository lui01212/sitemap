<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/mysitemap', function(){

        $sitemap = \App::make('sitemap');
        // add home pages mặc định
        $sitemap->add(\URL::to('/'), \Carbon::now(), 1, 'daily');

        // add author
        $StoryAuthors = \DB::table('story_authors')->select('author_name_link','updated_at')->orderBy('created_at', 'desc')->get();

        // add types
        $storyTypes = \DB::table('story_types')->select('type_name_link','updated_at')->orderBy('created_at', 'desc')->get();
        // add types
        $stories = \DB::table('stories')->select('story_name','story_name_link','story_image','updated_at')->orderBy('created_at', 'desc')->get();

        foreach ($StoryAuthors as $StoryAuthor) {
            //$sitemap->add(url, thời gian, độ ưu tiên, thời gian quay lại)
            $sitemap->add(route('authorpage.index', $StoryAuthor->author_name_link), $StoryAuthor->updated_at, 1, 'daily');
        }

        foreach ($storyTypes as $storyType) {
            //$sitemap->add(url, thời gian, độ ưu tiên, thời gian quay lại)
            $sitemap->add(route('typepage.index', $storyType->type_name_link), $storyType->updated_at, 1, 'daily');
        }

        foreach ($stories as $story) {
            //$sitemap->add(url, thời gian, độ ưu tiên, thời gian quay lại)

            $images = array();

            $images[] = array(
                'url' => URL::to('/')."/images/".$story->story_image,
                'title' => $story->story_name,
                'caption' => $story->story_name
            ); 

            $sitemap->add(route('storydetailpage.index', $story->story_name_link), $story->updated_at, 1, 'daily',$images);

	        $chapters  = DB::table('stories')

	                        ->where('story_name_link','=',$story->story_name_link)

	                        ->where('stories.flag','=',1) 

	                        ->leftjoin('story_list_details',function($leftjoin){
	                            $leftjoin->on('story_list_details.story_id','stories.story_id')
	                                     ->where('story_list_details.flag','=',1);
	                        })

	                        ->select('stories.story_name_link'
	                                 ,'story_list_details.chapter_name_link'
	                                 ,'story_list_details.updated_at'
	                        )

	                        ->orderBy('story_list_details.created_at', 'asc')

	                        ->get();

	        foreach ($chapters as  $key => $chapter) {
	        	if($key == 100) break;
	        	$sitemap->add(route('chapterpage.index',['story_name_link'=>$story->story_name_link,'chapter_name_link'=>$chapter->chapter_name_link]), $chapter->updated_at, 1, 'daily');
	        }

        }
        // lưu file và phân quyền
        $sitemap->store('xml', 'sitemap');
        if (\File::exists(public_path('sitemap.xml'))) {
            chmod(public_path('sitemap.xml'), 0777);
        }

});

Route::get('/', ['as' =>'index.index','uses' =>'Page\\indexController@index']);

Route::get('/tac-gia/{author_name_link}',['as' =>'authorpage.index','uses' =>'Page\\detailController@getStoryForAuthor']);

Route::get('/the-loai/{type_name_link}',['as' =>'typepage.index','uses' =>'Page\\detailController@getStoryForType']);

Route::post('/the-loai',['as' =>'typepageredirect.index','uses' =>'Page\\detailController@postStoryForType']);

Route::get('/truyen/{story_name_link}',['as' =>'storydetailpage.index','uses' =>'Page\\detailController@getStoryDetail']);

Route::get('/truyen/{story_name_link}/{chapter_name_link}',['as' =>'chapterpage.index','uses' =>'Page\\detailController@getChapterPage']);

Route::match(['get', 'post'],'/search',['as' =>'seachpage.index','uses' =>'Page\\detailController@postSeachPage']);

Route::get('/search/{keyword}','Page\\detailController@getSeachPage');

Route::get('/rating/{story_name_link}/{rating}','Page\\detailController@getRating');

Route::get('/404', function(){
	return view('layouts.404');
})->name('404');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//-----------------------------------------------------------------------
//admin
//-----------------------------------------------------------------------
Route::group(['prefix' => 'admin'],function(){
	//-----------------------------------------------------------------------
	//Dashboard
	//-----------------------------------------------------------------------
	Route::get('/',['as' => 'admin','uses' => 'AdminPanel\\DashboardCotroller@getDashboard']);
	//-----------------------------------------------------------------------
	//Tables
	//-----------------------------------------------------------------------
	Route::resource('storymaster', 'AdminPanel\\stotyMasterController');
	//-----------------------------------------------------------------------
	//Tables
	//-----------------------------------------------------------------------
	Route::resource('authormaster', 'AdminPanel\\storyAuthorController');
	//-----------------------------------------------------------------------
	//Tables
	//-----------------------------------------------------------------------
	Route::resource('storiesmaster', 'AdminPanel\\storiesController');
	//
	//-----------------------------------------------------------------------
	//Story detail
	//-----------------------------------------------------------------------
	Route::group(['prefix' => 'storydetail'],function(){
		//
		Route::get('/{id}',['as' =>'storydetail.index','uses' =>'AdminPanel\\storyDetailController@index']);
		//
		Route::get('/{id}/create',['as' =>'storydetail.create','uses' =>'AdminPanel\\storyDetailController@create']);
		//
		Route::post('/{id}/store',['as' =>'storydetail.store','uses' =>'AdminPanel\\storyDetailController@store']);
		//
		Route::get('/{id}/{chapter_id}/edit',['as' =>'storydetail.edit','uses' =>'AdminPanel\\storyDetailController@edit']);
		//
		Route::put('/{id}/update/{chapter_id}',['as' =>'storydetail.update','uses' =>'AdminPanel\\storyDetailController@update']);
		//
		Route::delete('/{id}/{chapter_id}',['as' =>'storydetail.destroy','uses' =>'AdminPanel\\storyDetailController@destroy']);
		//
	});
	//-----------------------------------------------------------------------
	//autoloadchapter
	//-----------------------------------------------------------------------
	Route::group(['prefix' => 'autoloadchapter'],function(){
		//
		Route::get('/{id}',['as' =>'autoloadchapter.index','uses' =>'AdminPanel\\autoloadChapterController@index']);
		//
		Route::post('/{id}/store',['as' =>'autoloadchapter.store','uses' =>'AdminPanel\\autoloadChapterController@store']);
		//
		Route::post('/{id}/autoupload',['as' =>'autoloadchapter.autoupload','uses' =>'AdminPanel\\autoloadChapterController@autoupload']);
		//
	});
	//-----------------------------------------------------------------------
	//autoloadList
	//-----------------------------------------------------------------------
	Route::group(['prefix' => 'autoloadlist'],function(){
		//
		Route::get('/',['as' =>'autoloadlist.index','uses' =>'AdminPanel\\autoloadingListController@index']);
		//
		Route::post('/{id}/store',['as' =>'autoloadlist.store','uses' =>'AdminPanel\\autoloadingListController@store']);
	});
});
