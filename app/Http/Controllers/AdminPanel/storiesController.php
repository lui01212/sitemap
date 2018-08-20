<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests\storiesRequest;

use App\Stories;

use App\StoryType;

use App\StoryAuthor;

use App\storyTypeDetail;

use DB;

use File;

class storiesController extends Controller
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

        $storyType = StoryType::all();

        $stories = DB::table('stories') ->leftjoin('story_authors','stories.author_id','=','story_authors.author_id')->select('stories.*','story_authors.author_name')->get();

        return view('admin.storiesTable',['user' =>$user,'stories' =>$stories,'storyType' =>$storyType]);
        // return $stories;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($success = null)
    {
        $user = Auth::user();

        $storyType   = StoryType::all();

        $storyAuthor    = StoryAuthor::all();

        return view('admin.storiesCreate',['user' =>$user,'storyType'=>$storyType,'storyAuthor'=>$storyAuthor,'success'=>$success]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storiesRequest $request)
    {
        try{
            ////////////////////////////////////////////////////////////
            DB::beginTransaction();
            ////////////////////////////////////////////////////////////
            $nameImage = "194x284.png";

            if ($request ->hasFile('story_image')) {

                $file = $request ->file('story_image');

                $nameFile = $file->getClientOriginalName();

                $nameImage = str_random(4)."_".$nameFile;

                while (file_exists('images/'.$nameImage)) {

                    $nameImage = str_random(4)."_".$nameFile;

                }

                $file ->move('images/',$nameImage);

            }
            $stories      = new Stories();
            //
            $stories->story_image = $nameImage;
            //
            $storyType = $request ->input('story_type');
            //
            $stories->story_type = serialize($storyType);
            //
            $stories->story_name = $request ->input('story_name');
            $stories->story_name_link = str_slug($stories->story_name);
            $stories->author_id = $request ->input('author_id');
            $stories->story_source = $request ->input('story_source');
            $stories->story_sum_chapter = $request ->input('story_sum_chapter');
            $stories->story_view = $request ->input('story_view');
            $stories->story_rating = $request ->input('story_rating');
            $stories->story_status = $request ->input('story_status');
            $stories->story_price = $request ->input('story_price');
            $stories->story_intro = $request ->input('story_intro');
            $stories->update_id = Auth::id();
            $stories->flag = 1;
            //

            $stories ->save();
            //---------------------------------------------------------------------
            foreach ($storyType as  $value) {
                $storyTypeDetail = new storyTypeDetail();
                $storyTypeDetail ->story_id = $stories->story_id;
                $storyTypeDetail ->type_id = str_slug($value);
                $storyTypeDetail->save();
            }
            /////////////////////////////////////////////////////////////
            DB::commit();
            /////////////////////////////////////////////////////////////
            return redirect()->route('storiesmaster.create',['success'=>'Đã lưu thành công']);
            /////////////////////////////////////////////////////////////
        }catch(\Exception $e){  
            //
            DB::rollback();
            //
            return redirect()->route('storiesmaster.create',['success'=>'Lưu thất bại']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();

        return view('admin.storiesShow',['user' =>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();

        $storyType   = StoryType::all();

        $storyAuthor    = StoryAuthor::all();

        $stories     = Stories::find($id);

        return view('admin.storiesEdit',['user' =>$user,'storyType'=>$storyType,'storyAuthor'=>$storyAuthor,'stories' =>$stories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(storiesRequest $request, $id)
    {
        try{
            ////////////////////////////////////////////////////////////
            DB::beginTransaction();
            ////////////////////////////////////////////////////////////
            //
            $stories      = Stories::find($id);
            //
            $nameImage    = $stories ->story_image;
            //
            if ($request ->hasFile('story_image')) {

                $file = $request ->file('story_image');

                while (file_exists('images/'.$nameImage)) {

                    unlink('images/'.$nameImage);

                }

                $file ->move('images/',$nameImage);

            }
            //
            $storyType = $request ->input('story_type');
            //
            $stories->story_type = serialize($storyType);
            //
            $stories->story_name = $request ->input('story_name');
            $stories->story_name_link = str_slug($stories->story_name);
            $stories->author_id = $request ->input('author_id');
            $stories->story_source = $request ->input('story_source');
            $stories->story_sum_chapter = $request ->input('story_sum_chapter');
            $stories->story_view = $request ->input('story_view');
            $stories->story_rating = $request ->input('story_rating');
            $stories->story_status = $request ->input('story_status');
            $stories->story_price = $request ->input('story_price');
            $stories->story_intro = $request ->input('story_intro');
            $stories->update_id = Auth::id();
            $stories->flag = $request ->input('flag');
            //

            $stories ->save();
            //---------------------------------------------------------------------
            $storyTypeDetail = storyTypeDetail::where('story_id',$id) ->delete();
            foreach ($storyType as  $value) {
                $storyTypeDetail = new storyTypeDetail();
                $storyTypeDetail ->story_id = $stories->story_id;
                $storyTypeDetail ->type_id = str_slug($value);
                $storyTypeDetail->save();
            }
            /////////////////////////////////////////////////////////////
            DB::commit();
            /////////////////////////////////////////////////////////////
            return redirect()->route('storiesmaster.edit',['id' => $id]);
            /////////////////////////////////////////////////////////////
        }catch(\Exception $e){  
            //
            DB::rollback();
            //
            // return redirect()->route('storiesmaster.create',['success'=>'Lưu thất bại']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Stories = Stories::find($id);

        $Stories->flag = 2;
        //
        $Stories->save();
        //
        return redirect()->route('storiesmaster.index');
    }
}
