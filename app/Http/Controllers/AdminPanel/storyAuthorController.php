<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests\storyAuthorRequest;

use App\StoryAuthor;

class storyAuthorController extends Controller
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

        $storyAuthor = StoryAuthor::all();

        return view('admin.storyAuthorTable',['user' =>$user,'storyAuthor' =>$storyAuthor]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        return view('admin.storyAuthorCreate',['user' =>$user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storyAuthorRequest $request)
    {
        $authorName   = $request->input('author_name');
        $StoryAuthor  = new StoryAuthor();
        $StoryAuthor  ->author_name      = $authorName;
        $StoryAuthor  ->author_name_link = str_slug($authorName);
        $StoryAuthor  ->flag = 1;
        $StoryAuthor  ->save();
        //
        return redirect()->route('authormaster.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $storyAuthor = StoryAuthor::find($id);
        //
        $user = Auth::user();
        //
        return view('admin.storyAuthorEdit',['user' =>$user,'storyAuthor' => $storyAuthor]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(storyAuthorRequest $request, $id)
    {
        $storyAuthor = StoryAuthor::find($id);

        $storyAuthor->author_name = $request->input('author_name');

        $storyAuthor->flag = $request->input('flag');
        //
        $storyAuthor->save();
        //
        return redirect()->route('authormaster.edit',['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $storyAuthor = StoryAuthor::find($id);

        $storyAuthor->flag = 2;
        //
        $storyAuthor->save();
        //
        return redirect()->route('authormaster.index');
    }
}
