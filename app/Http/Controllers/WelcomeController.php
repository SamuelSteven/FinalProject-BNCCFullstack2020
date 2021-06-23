<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\question;
use App\answer;
use App\reply;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            // First Time login
            $first_time_login = false;
            if (Auth::user()->first_time_login) {
                $first_time_login = true;
                Auth::user()->first_time_login = 0; 
                Auth::user()->save();   
            }
            
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

            // Count total comment (home)
            $answers = answer::all();
            foreach($answers as $key => $a){
                if($key == 0){
                    $test[$key] = $a->questionId;
                    $total_reply[$key] = count($a->answer_Reply);
                }else {
                    if(in_array($a->questionId,$test)){
                        $k = array_search($a->questionId, $test);
                        $total_reply[$k] = $total_reply[$k] + count($a->answer_Reply); 
                    }else{
                        $test[$key] = $a->questionId;
                        $total_reply[$key] = count($a->answer_Reply);
                    }
                }
            }
            $keys = 0;
            if($questions_available > 0){
                foreach($questions as $key => $question){
                    if(count($question->answers) > 0){
                        $total_comment[$key] = count($question->answers) + $total_reply[$keys];
                        $keys += 1;
                    } else{
                        $total_comment[$key] = 0;
                    }
                }
            }
            else{
                $total_comment = NULL;
            }
            return view('home',compact('questions', 'questions_count', 'questions_time', 'questions_available','total_comment','first_time_login'));
        } else{
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
            
            // Count total comment (welcome)
            if($questions_available > 0){
                $answers = answer::all();
                foreach($answers as $key => $a){
                    if($key == 0){
                        $test[$key] = $a->questionId;
                        $total_reply[$key] = count($a->answer_Reply);
                    }else {
                        if(in_array($a->questionId,$test)){
                            $k = array_search($a->questionId, $test);
                            $total_reply[$k] = $total_reply[$k] + count($a->answer_Reply); 
                        }else{
                            $test[$key] = $a->questionId;
                            $total_reply[$key] = count($a->answer_Reply);
                        }
                    }
                }
                $keys = 0;
            
                foreach($questions as $key => $question){
                    if(count($question->answers) > 0){
                        $total_comment[$key] = count($question->answers) + $total_reply[$keys];
                        $keys += 1;
                    } else{
                        $total_comment[$key] = 0;
                    }
                }
            }
            else{
                $total_comment = NULL;
            }
            return view('welcome',compact('questions', 'questions_count', 'questions_time', 'questions_available','total_comment'));
        }
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
        $questions = question::where('title', 'like', '%' . $request->keyword .'%')
            ->orWhere('content', 'like', '%' . $request->keyword .'%')
            ->get();
        $questions_count = $questions->count();
        $question = question::all();
        $questions_available = $questions_count;
        if($questions_available > 0){
            foreach($question as $q){
                $questions_time[] = $q->created_at->diffForHumans();
            }
    
            // Count total comment
            $answers = answer::all();
            foreach($answers as $key => $a){
                if($key == 0){
                    $test[$key] = $a->questionId;
                    $total_reply[$key] = count($a->answer_Reply);
                }else {
                    if(in_array($a->questionId,$test)){
                        $k = array_search($a->questionId, $test);
                        $total_reply[$k] = $total_reply[$k] + count($a->answer_Reply); 
                    }else{
                        $test[$key] = $a->questionId;
                        $total_reply[$key] = count($a->answer_Reply);
                    }
                }
            }
            $keys = 0;
        
            foreach($questions as $key => $q){
                if(count($q->answers) > 0){
                    $total_comment[$key] = count($q->answers) + $total_reply[$keys];
                    $keys += 1;
                } else{
                    $total_comment[$key] = 0;
                }
            }
        }
        else{
            $total_comment = NULL;
            $questions_time = NULL;
        }
        return view("welcome", compact('questions', 'questions_count', 'questions_time','questions_available','total_comment'));
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
