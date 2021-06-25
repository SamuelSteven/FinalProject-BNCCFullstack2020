@extends('layouts.app')

@section('content')
    <style>
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
        .buttonAdd{
            background-color: #2dce89;
            color: white;
        }
        .readBtn{
            background-color: #5e72e4;
            color: white;
            width: 120px;
        }
        .readBtn:hover{
            color: white;
            box-shadow: 1px 1px 7px #888888;
        }
        #results{
            color: white;
        }
        .content-card{
            width: 20rem;
            height: 250px;
            padding: 5px;
        }
        #test{
            width: 1055px;
        }
        .pagination{
            margin-left: 38%;
            width: 50%;
        }
        .pagination a{
            color: #000;
        }
        .page-item.active .page-link{
            background-color: #5e72e4;
            border-color: #5e72e4;
        }
        @media (-webkit-device-pixel-ratio: 1.50) {
            #test {
                width: 980px;
            }
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

    <!-- Container -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">     
                <!-- Cards -->
                @if($first_time_login)
                    <div class="card" id="test">
                        <div class="card-header">{{ __('Welcome!') }}
                            <button type="button" class="btn-close position-absolute top-0 end-0 mt-2 mr-2" onclick="closing()"></button>
                        </div>
                        <div class="card-body">
                            {{ __('You are logged in!') }}
                        </div>
                    </div>
                @endif
                <!-- Content -->
                @if($questions_count >= 0 && $questions_count != NULL )
                    <h4 class="mt-4 d-block" id="results">{{$questions_count}} results</h4>
                @else
                    <h4 class="mt-4 d-none" id="results">{{$questions_count}} results</h4>
                @endif
                <div class="row">
                    @if($questions_available > 0)
                        @foreach($questions as $key => $question)
                            <div class="col-md-4 mt-4">
                                <div class="card content-card" id="question-card">
                                    <div class="card-body d-flex flex-column">
                                        @if ($question->status == "false")
                                            <span class="card-text text-danger">Thread already closed</span>
                                        @endif
                                        <h5 class="card-title">{{$question->title}}</h5>
                                        <h6 class="card-subtitle mb-2 mt-2 text-muted">{{$questions_time[($key-1)+1]}}</h6>
                                        <p class="card-text">{{Str::limit($question->content, 73)}}</p>

                                        <div class="mt-auto mb-3 comment d-inline-flex" style="color: #f5365c;">
                                            <i class="fa fa-comments mr-2"></i>
                                            @if($total_comment != NULL)
                                                <p class="card-text">{{$total_comment[$key]}}</p>
                                            @else
                                                <p class="card-text">0</p>
                                            @endif
                                        </div>
                                        <a href="/home/{{$question->id}}" class="btn readBtn" >Read More</a>
                                    </div>                          
                                </div>
                            </div>
                        @endforeach
                        <div class="pagination mt-5">
                            {{ $questions->links() }}
                        </div>
                    @endif
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

