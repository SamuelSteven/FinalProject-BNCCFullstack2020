@extends('layouts.app')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap'>);
        *{
            font-family: 'Nunito', sans-serif;
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
        h3{
            text-align: center;
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
        .button{
            box-shadow: 0 5px 9px 0 rgba(0, 0, 0, 0.2);
        }
        .buttonAdd{
            background-color: #2dce89;
            color: white;
        }
        .settingBtn{
            background-color: #5e72e4;
            color: white;
        }
        .settingBtn:hover{
            color: white;
            box-shadow: 1px 1px 7px #888888;
        }
        .settingButton{
            margin-top: 30px;
            margin-right: 100px;
        }
        .threads{
            margin-top: 30px;
            margin-left: 100px;
        }
        .comments{
            margin-top: 30px;
            margin-left: 220px;
        }
        .background{
            background-image: linear-gradient(to bottom right, white, #D0D0D0);
        }
    </style>

    <!-- PopUp Form -->
    <div class="form-popup" id="popup">
        <div class="popup-content">
            <form method="POST" action="/home">
            @csrf
                <div class="mb-3">
                    <h4 class="mb-3">What is Your Question?</h4>
                    <button type="button" class="btn-close position-absolute top-0 end-0 mt-3 mr-3" id="close"></button>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Your Question's Title" name="title" value="{{old('title')}}">
                    @error('title')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="form">
                    <textarea class="form-control @error('content') is-invalid @enderror" placeholder="What is Your Question?" id="content" style="height: 150px" name="content" value="{{old('content')}}"></textarea>
                    @error('content')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                <button type="submit" class="buttonAdd btn my-3">ADD QUESTION!</button>
            </form>
        </div>
    </div>

    <h3 class="card-title mt-4 mb-5" style="color:white">My Profile</h3>
    <div class="container profile mt-5">
        <div class="row justify-content-center">
            <div class="card background mt-5" style="width: 69rem; height: 23rem;">
                <div class="card-body">
                    @if($users->photo == NULL)
                        <img class="rounded mx-auto d-block img-thumbnail rounded-circle photo" src="{{asset('images/profile-placeholder.png')}}" alt="">
                    @else
                        <img class="rounded mx-auto d-block img-thumbnail rounded-circle photo" src="{{'/images/'.$users->photo}}" alt="">
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
                    
                    <div class="position-absolute top-0 end-0 settingButton">
                        <a href="/settings/{{$users->id}}" class="btn settingBtn mt-3 text button">Settings</a>
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