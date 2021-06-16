<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\question;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $questions = question::all();
        // $mytime = Carbon::now('Asia/Jakarta')->format('d-m-Y H:i:s');
        
        // dd($questions[0]->created_at);
        return view('home',compact('questions'));
    }
}
