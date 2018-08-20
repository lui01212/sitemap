<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use DB;

use App\storyListDetail;

use Sunra\PhpSimple\HtmlDomParser;

use App\Stories;

use App\autoloading;

class autoloadingListController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $stories = DB::table('stories') ->where('story_status', 2) ->leftjoin('autoloadings','stories.story_id','=','autoloadings.story_id')->select('stories.story_name','stories.story_id','autoloadings.auto_chapter_link','autoloadings.flag')->get();
    	return view('admin.autoloadList',compact('user','stories'));
    }
             /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        try{

            $link_next = $request ->auto_chapter_link;

            $autoload = autoloading::where('auto_chapter_link',$link_next)->first();
            
            if($autoload !=null){
	            if($autoload ->auto_flag == 1){
	            	try{

		                $html = HtmlDomParser::file_get_html($link_next);

		                $link_next = 'http://m.truyencuatui.vn'.$html->find('a.next-button', 0)->href;

		            }catch(\Exception $e){

		                return response()->json(['mess'=>'NORMAL','auto_chapter_link' => '', 'id' => $id]);
		            }

	            }
        	}

            $link      = $link_next;

            $chapter = DB::table('story_list_details') ->where('story_id',$id)->where('flag',1)-> max('chapter');

            try{
                $html = HtmlDomParser::file_get_html($link_next);
                $chapter_name = $html->find('div.container h1',0)->innertext();
                $chapter_content = $html ->find('div.txt',0) ->innertext();
            }catch(\Exception $e){
                $html ="";
                $chapter_name ="";
                $chapter_content ="";
                $link_next="";
            }
            try{
                $link_next = 'http://m.truyencuatui.vn'.$html->find('a.next-button', 0)->href;
            }catch(\Exception $e){
                $link_next ="";
            }
            ////////////////////////////////////////////////////////////
            if(!($html =="" || $chapter_name =="" || $chapter_content =="")){
	            $storyListDetail  = new storyListDetail();
	            $storyListDetail  ->story_id = $id;
	            $storyListDetail  ->chapter  = $chapter + 1;
	            $storyListDetail  ->chapter_name = $chapter_name;
	            $storyListDetail  ->chapter_name_link = 'chuong'.'-'.str_slug($chapter + 1).'_'.str_random(4);
	            $storyListDetail  ->chapter_content = $chapter_content;
	            $storyListDetail  ->flag = 1;
	            
	            //
	            $Stories = Stories::find($id);
	            //
	            $Stories ->story_sum_chapter = $chapter + 1;
	            //
                DB::beginTransaction();
                $storyListDetail  ->save();
                $Stories ->save();
                DB::commit();
            }
            /////////////////////////////////////////////////////////////
            $autoloading = autoloading::updateOrCreate(
                 ['story_id' => $id], ['story_id' => $id,'auto_chapter_link' => $link,'auto_flag'=>1,'flag'=>1]
            );
            if($link_next !=""){
                $autoloading = autoloading::updateOrCreate(
                 ['story_id' => $id], ['story_id' => $id,'auto_chapter_link' => $link_next,'auto_flag'=>2,'flag'=>1]
                );
            }

            return response()->json(['mess'=>'NORMAL','auto_chapter_link' => $link_next, 'id' => $id]);
            //
        }catch(\Exception $e){  
            //
            DB::rollback();
            //
            return response()->json(['mess'=>'ERROR','auto_chapter_link' => '']);
        }
    }
}
