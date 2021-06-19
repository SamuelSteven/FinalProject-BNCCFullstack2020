<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\question;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

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
        $questions_count = NULL;
        $questions_available = $questions->count();
        if($questions_available > 0){
            foreach($questions as $q){
                $questions_time[] = $q->created_at->diffForHumans();
            }
        }
        else{
            $questions_time = NULL;
        }
        
        return view('home',compact('questions', 'questions_count', 'questions_time', 'questions_available'));
    }

    /**
     * Display the specified resource.
      *@param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(Request $request)
    {
        $questions = DB::table('questions')
            ->where('title', 'like', '%' . $request->keyword .'%')
            ->orWhere('content', 'like', '%' . $request->keyword .'%')
            ->get();
        $questions_count = $questions->count();
        $question = question::all();
        foreach($question as $q){
            $questions_time[] = $q->created_at->diffForHumans();
        }

        return view("home", compact('questions', 'questions_count','questions_time'));
    }
}
