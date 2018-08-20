<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests\storyTypeRequest;

use App\StoryType;

class stotyMasterController extends Controller
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

        return view('admin.storyTypeTable',['user' =>$user,'storyType' =>$storyType]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        return view('admin.storyTypeCreate',['user' =>$user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storyTypeRequest $request)
    {
        $typeName   = $request->input('type_name');
        $StoryType  = new StoryType();
        $StoryType  ->type_name      = $typeName;
        $StoryType  ->type_name_link = str_slug($typeName);
        $StoryType  ->keywords       = $request->input('keywords');
        $StoryType  ->description    = $request->input('description');
        $StoryType  ->description_head    = $request->input('description_head');
        $StoryType  ->flag = 1;
        $StoryType  ->save();
        //
        return redirect()->route('storymaster.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $storyType = StoryType::find($id);
        //
        $user = Auth::user();
        //
        return view('admin.storyTypeEdit',['user' =>$user,'storyType' => $storyType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(storyTypeRequest $request, $id)
    {
        $storyType = storyType::find($id);

        $storyType->type_name = $request->input('type_name');

        $storyType->keywords  = $request->input('keywords');

        $storyType->description  = $request->input('description');

        $storyType->description_head  = $request->input('description_head');

        $storyType->flag = $request->input('flag');
        //
        $storyType->save();
        //
        return redirect()->route('storymaster.edit',['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $storyType = storyType::find($id);

        $storyType->flag = 2;
        //
        $storyType->save();
        //
        return redirect()->route('storymaster.index');
    }
}
