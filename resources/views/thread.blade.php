@extends('layouts.app')

@section('content')
    <style>
        .form-popup {
            background: rgba(0,0,0,0.6);
            width: 100%;
            heigth: 100%;
            position: absolute;
            top: 0;
            bottom: 0;
            display: none;
            justify-content: center;
            align-items: center;
            text-align: center;
            z-index: 999;
        }

        .popup-content{
            height: 400px;
            width: 600px;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            position: relative;
        }

        .popup{
            width: 20%;
            position: fixed;
            bottom: 0;
            right: 0;
            margin-bottom: -20px;
        }
        .row>*{
            padding-right: 0;
            padding-left: 0;
        }
        #answer-count{
            margin-left: 280px;
        }
        #reply-count{
            margin-left: 495px;
        }
        #form_action_reply{
            margin-left: 495px;
        }
        #form_action{
            margin-left:280px;
        }
        #form_actions{
            margin-left:280px;
        }
        #reply_card{
            margin-left: 110px;
        }
        h5, h4 .comment, .comment{
            color:white;
        }
    </style>

    <!-- PopUp Edit Question -->
    <div class="form-popup" id="popup">
        <div class="popup-content">
            <form method="POST" action="/home/{{$questions->id}}">
            @method('patch')
            @csrf
                <div class="mb-3">
                    <h4 class="mb-3">Edit your Question</h4>
                    <button type="button" class="btn-close position-absolute top-0 end-0 mt-3 mr-3" id="close"></button>
                    <label for="title" style="margin-left:-440px;">Title of Question</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Enter the Question Title" name="title" value="{{$questions->title}}">
                    @error('title')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <label for="content-textbox" style="margin-left:-420px;">Content of Question</label>
                <div class="form">
                    <textarea class="form-control @error('content') is-invalid @enderror" placeholder="Enter the Question Content" id="content-textbox" style="height: 150px" name="content" value="{{old('content')}}">{{$questions->content}}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                <input type="hidden" name="status" value="{{$questions->status}}">
                <button type="submit" class="btn btn-primary my-3">Edit Question!</button>
            </form>
        </div>
    </div>

    <!-- Question -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="card" style="width: 65rem;">
                <div class="card-body">
                    <h4 class="card-title d-inline">{{$questions->title}}</h4>
                    @if ($questions->status == "false")
                        <span class="card-text d-inline text-danger ml-2">Thread already closed</span>
                    @endif
                    @if($questions->users['id'] == Auth::user()->id)
                        <h6 class="card-subtitle mb-2 mt-2 text-muted">Created at {{ $questions->created_at}} | Updated at {{ $questions->updated_at}} | By <a href="/myprofile/{{Auth::user()->id}}">{{$questions->users['username']}}</a></h6>
                    @else
                        <h6 class="card-subtitle mb-2 mt-2 text-muted">Created at {{ $questions->created_at}} | Updated at {{ $questions->updated_at}} | By <a href="/otherprofile/{{$questions->users['id']}}">{{$questions->users['username']}}</a></h6>
                    @endif
                    
                    <p class="card-text">{{$questions->content}}</p>
                    @if($questions->users['id'] == Auth::user()->id)
                        @if($questions->status == "true")
                            <a href="#" class="btn btn-primary" id="edit">Edit</a>

                            <form class="d-inline"method="POST" action="/home/{{$questions->id}}">
                            @method('delete')
                            @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>

                            <form class="d-inline"method="POST" action="/home/thread/{{$questions->id}}">
                            @method('patch')
                            @csrf
                                <button type="submit" class="btn btn-dark">Close Thread</button>
                                <input type="hidden" name="status" value="false">
                            </form>
                        @else
                            <form class="d-inline"method="POST" action="/home/thread/{{$questions->id}}">
                            @method('patch')
                            @csrf
                                <button type="submit" class="btn btn-dark">Open Thread</button>
                                <input type="hidden" name="status" value="true">
                            </form>
                            <form class="d-inline"method="POST" action="/home/{{$questions->id}}">
                            @method('delete')
                            @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        @endif
                    @endif
                </div>
            </div>

            <!-- Answers -->
            <hr class="mt-4" style="width: 65rem">
            <h5 class="card-text mt-4" id="answer-count">{{ $answer_count }} Answers</h5>
            @if($answer_count > 0)
                <!-- Answers Card -->
                @foreach ($answer as $key => $a)
                    <div class="card my-4 answercard" style="width: 65rem;">
                        <div class="card-body">
                        @if($a->user['id'] == Auth::user()->id)
                            <h6 class="card-subtitle mb-2 text-muted">Created at {{ $a->created_at}} | Updated at {{ $a->updated_at}} | By <a href="/myprofile/{{Auth::user()->id}}">{{$a->user['username']}}</a></h6>
                        @else
                            <h6 class="card-subtitle mb-2 text-muted">Created at {{ $a->created_at}} | Updated at {{ $a->updated_at}} | By <a href="/otherprofile/{{$a->user['id']}}">{{$a->user['username']}}</a></h6>
                        @endif
                            
                            <p class="card-text my-4">{{ $a->content }}</p>

                            @if($questions->status == "true")
                                <a href="#replycard" class="btn btn-info mx-1 mt-3" onclick="reply( {{$a->id}}, {{$key}});">Reply</a>
                            @endif

                            @if($a->user['id'] == Auth::user()->id && $questions->status == "true")
                                <a href="#answercard" class="btn btn-primary mx-1 mt-3" onclick="display(`{{$a->content}}`, {{$a->id}}, {{$key}});">Edit</a>
                                <form action="/answer/{{$a->id}}" method="POST" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger mt-3">Delete</button>
                                </form>
                            @endif
                        </div>
                    </div>

                    <!-- Edit & Cancel Answers -->
                    <form method="POST" action="" id="form_action">
                        @method('patch')
                        @csrf
                        <div class="form d-none" id="edit" style="width:65rem;">
                            <label for="content" style="margin-top:-9px;">Edit Your Answer Here</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" placeholder="Edit Your Answer Here" id="content" style="height: 150px" name="content"></textarea>
                            @error('content')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                            <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="questionId" value="{{ $questions->id }}">
                            <button type="submit" class="btn btn-primary my-3">Edit Your Answer!</button>
                            <a href="#edit" class="card-link mx-2 text-decoration-none" onclick="hide({{$key}});">Cancel</a>
                        </div>
                    </form>

                    <!-- Edit & Cancel Replies -->
                    <form method="POST" action="/reply" id="form_actions">
                        @csrf
                        <div class="form d-none" id="reply" style="width:65rem;">
                            <label for="content" style="margin-top:-9px;">Edit Your Reply Here</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" placeholder="Edit Your Reply Here" id="content" style="height: 150px" name="content"></textarea>
                            @error('content')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                            <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="answerId" value="{{ $a->id }}">
                            <button type="submit" class="btn btn-primary my-3">Add Reply!</button>
                            <a href="#reply" class="card-link mx-2 text-decoration-none" onclick="hideReply({{$key}});">Cancel</a>
                        </div>
                    </form>

                    <!-- Reply -->
                    <h5 class="card-text mt-4" id="reply-count">{{ $reply_count }} Replies</h5>
                    @if($reply_count > 0)
                        <!-- Reply Card -->
                        @foreach ($reply as $keys => $r)
                            <div class="card my-4 replycard" style="width: 58rem;" id="reply_card">
                                <div class="card-body">
                                    @if($r->user_reply['id'] == Auth::user()->id && $a->user['id'] != Auth::user()->id)
                                        <h6 class="card-subtitle mb-2 text-muted">Created at {{ $r->created_at}} | Updated at {{ $r->updated_at}} | By <a href="/myprofile/{{Auth::user()->id}}">{{$r->user_reply['username']}}</a> reply to <a href="/otherprofile/{{$a->user['id']}}">{{$a->user['username']}}</a></h6>
                                    @elseif($r->user_reply['id'] != Auth::user()->id && $a->user['id'] == Auth::user()->id)
                                        <h6 class="card-subtitle mb-2 text-muted">Created at {{ $r->created_at}} | Updated at {{ $r->updated_at}} | By <a href="/otherprofile/{{$r->user_reply['id']}}">{{$r->user_reply['username']}}</a> reply to <a href="/myprofile/{{$a->user['id']}}">{{$a->user['username']}}</a></h6>
                                    @else
                                        <h6 class="card-subtitle mb-2 text-muted">Created at {{ $r->created_at}} | Updated at {{ $r->updated_at}} | By <a href="/otherprofile/{{$r->user_reply['id']}}">{{$r->user_reply['username']}}</a> reply to <a href="/otherprofile/{{$a->user['id']}}">{{$a->user['username']}}</a></h6>
                                    @endif
                                    
                                    <p class="card-text my-4">{{ $r->content }}</p>

                                    @if($r->user_reply['id'] == Auth::user()->id && $questions->status == "true")
                                        <a href="#replycard" class="btn btn-primary mx-1 mt-3" onclick="displayReply(`{{$r->content}}`, {{$r->id}}, {{$keys}});">Edit</a>
                                        <form action="/reply/{{$r->id}}" method="POST" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger mt-3">Delete</button>
                                        </form>
                                    @endif
                                </div>
                            </div>

                            <!-- Edit & Cancel Reply -->
                            <form method="POST" action="" id="form_action_reply">
                                @method('patch')
                                @csrf
                                <div class="form d-none" id="edit" style="width:58rem;">
                                    <label for="content" style="margin-top:-9px;">Edit Your Reply Here</label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" placeholder="Edit Your Reply Here" id="content" style="height: 150px" name="content"></textarea>
                                    @error('content')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                    <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="answerId" value="{{ $a->id }}">
                                    <button type="submit" class="btn btn-primary my-3">Edit Your Reply!</button>
                                    <a href="#edit" class="card-link mx-2 text-decoration-none" onclick="hideReply1({{$key}});">Cancel</a>
                                </div>
                            </form>
                        @endforeach
                    @endif
                @endforeach
            @endif

             <!-- Answer Box -->
             @if ($questions->status == "true")
                <hr class="mt-1 mb-5" style="width: 65rem">
                <form method="POST" action="/answer" style="width: 65rem;">
                    @csrf
                    <div class="form">
                        <h4 class="comment mb-2">Write a Comment</h4>
                        <label for="content" class="comment mt-4">Have any thoughts?</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" placeholder="Enter Your Answer Here" id="content" style="height: 150px" name="content"></textarea>
                        @error('content')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="questionId" value="{{ $questions->id }}">
                    <button type="submit" class="btn btn-primary my-3">Post Your Answer!</button>
                </form>
            @endif
        </div>
    </div>
    
    <script>

        document.getElementById("edit").addEventListener("click", function(){
            document.querySelector(".form-popup").style.display = "flex";
        });

        document.getElementById("close").addEventListener("click", function(){
            document.querySelector(".form-popup").style.display = "none";
        });

        function display(x,y,z){
            var form_edit = $("#form_action #edit");
            var form = $(".row #form_action");
            var content = $(".row #form_action #edit #content");
            form_edit[z].className = "form edit d-block";
            form[z].action = "/answer/" + y;
            content[z].value = x;
        }

        function hide(k){
            var form = $("#form_action #edit");
            form[k].className = "form edit d-none";
        }

        function reply(y,z){
            var form_edit = $("#form_actions #reply");
            form_edit[z].className = "form edit d-block";
        }

        function hideReply(k){
            var form = $("#form_actions #reply");
            form[k].className = "form edit d-none";
        }

        function displayReply(x,y,z){
            var form_edit = $("#form_action_reply #edit");
            var form = $(".row #form_action_reply");
            var content = $(".row #form_action_reply #edit #content");
            form_edit[z].className = "form edit d-block";
            form[z].action = "/reply/" + y;
            content[z].value = x;
        }

        function hideReply1(k){
            var form = $("#form_action_reply #edit");
            form[k].className = "form edit d-none";
        }

    </script>
    
@endsection