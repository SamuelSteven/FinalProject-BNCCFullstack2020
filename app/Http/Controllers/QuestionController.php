<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\question;
use App\answer;
use App\reply;
use Illuminate\Database\Eloquent\Builder;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        question::where('id',$id)
            ->update([
                'status' => $request->status,
            ]);
            
        if($request->status == "true"){
            return redirect('/home')->with('status','Thread Opened Successfully!');     
        }else{
            return redirect('/home')->with('danger','Thread Closed Successfully!'); 
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
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        question::create($request->all());
        return redirect('/home')->with('status','Question Added Successfully!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $questions = question::find($id);
        $answer = answer::where('questionId','=',$id)->get();
        $answer_count = $answer->count();
        if ($answer_count > 0){
            $reply = reply::where('answerId','=',$answer[0]->id)->get();
            $reply_count = $reply->count();
        } else{
            $reply = NULL;
            $reply_count = 0;
        }
        return view('/thread', compact('questions', 'answer', 'answer_count', 'reply', 'reply_count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, question $question)
    {
        $request->validate([
            'title' => ['required'],
            'content' => ['required'],
        ]);
        
        question::where('id',$question->id)
            ->update([
                'title' => $request->title,
                'content' => $request->content,
                'userId' => $request->userId,
                'status' => $request->status
            ]);
        
        return redirect('/home')->with('status','Question Edited Successfully!'); ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $questions = question::find($id);
        $questions->delete();

        return redirect('/home')->with('status','Question Deleted Successfully!');
    }
}
