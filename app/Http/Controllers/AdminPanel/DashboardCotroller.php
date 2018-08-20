<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

class DashboardCotroller extends Controller
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

    public function getDashboard()
    {
        $user = Auth::user();

    	return view('admin.Dashboard',['user' =>$user]);
    }
}
