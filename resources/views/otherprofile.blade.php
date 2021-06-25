@extends('layouts.app')

@section('content')
    <style>
        h3{
            text-align: center;
        }
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
        .icon{
            text-align: center;
            position: relative;
            top:-60px;
        }
        .text{
            font-size: 16px;
        }
        .photo{
            width: 200px;
            height: 200px;
            text-align: center;
            object-fit: cover;
            position: relative;
            top:-80px;
        }
        .background{
            background-image: linear-gradient(to bottom right, white, #D0D0D0);
        }
        .threads{
            margin-top: 30px;
            margin-left: 100px;
        }
        .comments{
            margin-top: 30px;
            margin-left: 220px;
        }
    </style>

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

    <h3 class="card-title mt-4 mb-5" style="color:white">Profile</h3>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card background mt-5" style="width: 69rem; ">
                <div class="card-body">
                    @if($users->photo == NULL)
                        <img class="rounded mx-auto d-block img-thumbnail rounded-circle photo" src="{{asset('images/profile-placeholder.png')}}" alt=""/>
                    @else
                        <img class="rounded mx-auto d-block img-thumbnail rounded-circle photo" src="{{'/images/'.$users->photo}}" alt=""/>
                    @endif
                    <div class="icon">
                        <h3>{{$users->username}}</h3>
                    </div>
                    
                    <div class="icon">
                        <p class="text"><i class="fas fa-user mt-3"></i> {{$users->name}}</p>
                    </div>
                    
                    <div class="icon">
                        <p class="text"><i class="fas fa-envelope mt-2"></i> {{$users->email}}</p>
                    </div>

                    <div class="icon">
                        <p class="text"><i class="fas fa-calendar mt-2"></i> Joined {{$users->created_at->format('d M, Y')}}</p>
                    </div>

                    <div class="position-absolute top-0 start-0 threads text-center">
                        <p class="text"> <h5><b>{{$thread_count}}</b></h5> Threads</p>
                    </div>

                    <div class="position-absolute top-0 start-0 comments text-center">
                        <p class="text"> <h5><b>{{$comment_count}}</b></h5> Comments</p>
                    </div> 
                    
                </div>
            </div>
        </div>
    </div>

    <script>
        // PopUp Form
        document.getElementById("askbutton").addEventListener("click", function(){
            document.querySelector(".form-popup").style.display = "flex";
        });
        document.getElementById("close").addEventListener("click", function(){
            document.querySelector(".form-popup").style.display = "none";
        });
    </script>
@endsection