<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\question;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = question::all();
        $questions_count = NULL;
        foreach($questions as $q){
            $questions_time[] = $q->created_at->diffForHumans();
        }
        return view('welcome',compact('questions','questions_count','questions_time'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

        return view("welcome", compact('questions', 'questions_count', 'questions_time'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
