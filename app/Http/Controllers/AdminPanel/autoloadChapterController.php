<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use DB;

use App\Stories;

use App\storyTypeDetail;

use App\Http\Requests\storyDetailRequest;

use Sunra\PhpSimple\HtmlDomParser;

use App\storyListDetail;

use App\autoloading;



class autoloadChapterController extends Controller
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
    public function index($id)
    {
        $user = Auth::user();

        $stories = DB::table('stories') ->where('story_id', $id) ->leftjoin('story_authors','stories.author_id','=','story_authors.author_id')->select('stories.*','story_authors.author_name')->first();
        $link_next = "";
    	return view('admin.autoloadChapter',compact('id','user','stories','link_next'));
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
            set_time_limit(0);
            ////////////////////////////////////////////////////////////
            DB::beginTransaction();
            ////////////////////////////////////////////////////////////
            $link = $request ->chapter_link;
            $chapter = $request ->chapter;
            $html = HtmlDomParser::file_get_html($link);
            $chapter_name = explode(''.$request ->chapter, $html->find('div.container h1',0)->innertext(), 2)[1];
            $chapter_content = $html ->find('div.txt',0) ->innertext();
            if($html->find('a.next-button', 0) != null)
            { 
                $href = $html->find('a.next-button', 0)->href;
                $link_next = 'http://m.truyencuatui.vn'.$html->find('a.next-button', 0)->href;
            }else{
                $link_next= "";
            }
            ////////////////////////////////////////////////////////////
            $storyListDetail  = new storyListDetail();
            $storyListDetail  ->story_id = $id;
            $storyListDetail  ->chapter  = $chapter;
            $storyListDetail  ->chapter_name = $chapter_name;
            $storyListDetail  ->chapter_name_link = 'chuong'.'-'.str_slug($chapter).'_'.str_random(4);
            $storyListDetail  ->chapter_content = $chapter_content;
            $storyListDetail  ->flag = 1;
            $storyListDetail  ->save();
            //
            $Stories = Stories::find($id);
            //
            $Stories ->story_sum_chapter = storyListDetail::whereRaw('flag = 1 and story_id = '.$id) ->count();
            //
            $Stories ->save();
            /////////////////////////////////////////////////////////////
            $autoloading1 = autoloading::updateOrCreate(
                 ['story_id' => $id], ['story_id' => $id,'auto_chapter_link' => $link,'auto_flag'=>1,'flag'=>1]
            );
            if($link_next !=""){
                $autoloading2 = autoloading::updateOrCreate(
                 ['story_id' => $id], ['story_id' => $id,'auto_chapter_link' => $link_next,'auto_flag'=>2,'flag'=>1]
                );
            }
            /////////////////////////////////////////////////////////////
            DB::commit();
            /////////////////////////////////////////////////////////////
            $user = Auth::user();

            $stories = DB::table('stories') ->where('story_id', $id) ->leftjoin('story_authors','stories.author_id','=','story_authors.author_id')->select('stories.*','story_authors.author_name')->first();

            return view('admin.autoloadChapter',compact('id','user','stories','link_next'));
            //
        }catch(\Exception $e){  
            //
            DB::rollback();
            //
            echo $e;
        }
    }
         /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function autoupload(Request $request,$id)
    {
        try{
            $link_next      = $request ->chapter_link;
            $chapter_to = $request ->chapter_to;
            $chapter_from = $request ->chapter_from;
            for ($i= $chapter_to; $i <= $chapter_from ; $i++) { 
                try{
                    $link_save      = $link_next;
                    $html = HtmlDomParser::file_get_html($link_next);
                    $chapter_name = $html->find('div.container h1',0)->innertext();
                    $chapter_content = $html ->find('div.txt',0) ->innertext();
                }catch(\Exception $e){
                    $html ="";
                    $chapter_name ="";
                    $chapter_content ="";
                    $link_next="";
                    break;
                }
                try{
                    $link_next = 'http://m.truyencuatui.vn'.$html->find('a.next-button', 0)->href;
                }catch(\Exception $e){
                    $link_next ="";
                }
                ////////////////////////////////////////////////////////////
                $storyListDetail  = new storyListDetail();
                $storyListDetail  ->story_id = $id;
                $storyListDetail  ->chapter  = $i;
                $storyListDetail  ->chapter_name = $chapter_name;
                $storyListDetail  ->chapter_name_link = 'chuong'.'-'.str_slug($i).'_'.str_random(4);
                $storyListDetail  ->chapter_content = $chapter_content;
                $storyListDetail  ->flag = 1;
                
                //
                $Stories = Stories::find($id);
                //
                $Stories ->story_sum_chapter = $i;
                //////////////////////////////////
                DB::beginTransaction();
                $storyListDetail  ->save();
                $Stories ->save();
                DB::commit();
                //////////////////////////////////
                $autoloading1 = autoloading::updateOrCreate(
                 ['story_id' => $id], ['story_id' => $id,'auto_chapter_link' => $link_save,'auto_flag'=>1,'flag'=>1]
                );
            }
            /////////////////////////////////////////////////////////////

            if($link_next !=""){
                $autoloading2 = autoloading::updateOrCreate(
                 ['story_id' => $id], ['story_id' => $id,'auto_chapter_link' => $link_next,'auto_flag'=>2,'flag'=>1]
                );
            }
            /////////////////////////////////////////////////////////////
            $user = Auth::user();

            $stories = DB::table('stories') ->where('story_id', $id) ->leftjoin('story_authors','stories.author_id','=','story_authors.author_id')->select('stories.*','story_authors.author_name')->first();

            return view('admin.autoloadChapter',compact('id','user','stories','link_next'));
            //
        }catch(\Exception $e){  
            //
            DB::rollback();
            //
            echo $e;
        }
    }

}
