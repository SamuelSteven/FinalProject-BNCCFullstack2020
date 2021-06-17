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
            height: 350px;
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
        .grid-container{
            display:grid;
            grid-template-columns: auto auto auto;
            margin-top: 20px;
        }
        .grid-item{
            padding:20px;
        }
    </style>

    <!-- PopUp Status -->
    <div class="popup">
        @if (session('status'))
            <div class="alert alert-success" id="notif">
                {{ session('status') }}
                <button type="button" class="btn-close position-absolute top-0 end-0 mt-3 mr-3" id="btn-close"></button>
            </div>
        @endif
    </div>

    <div class="popup">
        @if (session('danger'))
            <div class="alert alert-danger" id="notif">
                {{ session('danger') }}
                <button type="button" class="btn-close position-absolute top-0 end-0 mt-3 mr-3" id="btn-close"></button>
            </div>
        @endif
    </div>

    <!-- PopUp Form -->
    <div class="form-popup" id="popup">
        <div class="popup-content">
            <form method="POST" action="/home">
            @csrf
                <div class="mb-3">
                    <h4 class="mb-3">Have Any Questions?</h4>
                    <button type="button" class="btn-close position-absolute top-0 end-0 mt-3 mr-3" id="close"></button>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Enter the Question Title" name="title" value="{{old('title')}}">
                    @error('title')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="form">
                    <textarea class="form-control @error('content') is-invalid @enderror" placeholder="Enter the Question Content" id="content" style="height: 150px" name="content" value="{{old('content')}}"></textarea>
                    @error('content')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                <button type="submit" class="btn btn-primary my-3">Add Question!</button>
            </form>
        </div>
    </div>

    <!-- Container -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">     
                <!-- Cards -->
                <div class="card" id="test">
                    <div class="card-header">{{ __('Welcome!') }}
                        <button type="button" class="btn-close position-absolute top-0 end-0 mt-2 mr-2" onclick="closing()"></button>
                    </div>
                    <div class="card-body">
                        {{ __('You are logged in!') }}
                    </div>
                </div>
                <!-- Content -->
                @if($questions_count >= 0 && $questions_count != NULL )
                    <h4 class="mt-4 d-block" id="results">{{$questions_count}} results</h4>
                @else
                    <h4 class="mt-4 d-none" id="results">{{$questions_count}} results</h4>
                @endif
                <div class="row">
                    @foreach($questions as $key => $question)
                        <div class="col-md-4 mt-4">
                            <div class="card" id="question-card" style="width: 20rem;">
                                <div class="card-body">
                                    <h5 class="card-title d-inline">{{$question->title}}</h5>
                                    @if ($question->status == "false")
                                        <span class="card-text d-inline text-danger ml-2">Thread already closed</span>
                                    @endif
                                    <h6 class="card-subtitle mb-2 mt-2 text-muted">{{$questions_time[($key-1)+1]}}</h6>
                                    <p class="card-text">{{Str::limit($question->content, 73)}}</p>
                                    <a href="/home/{{$question->id}}" class="btn btn-primary">Read More</a>
                                </div>                          
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Function -->
    <script>

        // PopUp Form
        document.getElementById("askbutton").addEventListener("click", function(){
            document.querySelector(".form-popup").style.display = "flex";
        });
        document.getElementById("close").addEventListener("click", function(){
            document.querySelector(".form-popup").style.display = "none";
        });

        // Notification Close Button 
        document.getElementById("btn-close").addEventListener("click", function(){
            document.querySelector("#notif").style.display = "none";
        });
        
        // Notification Auto Close
        setTimeout(function(){ 
            document.querySelector("#notif").style.display = "none";
        }, 5000);

        // Close Button Function
        function closing(){
            document.getElementById("test").style.display = "none";
        }
    </script>
@endsection

