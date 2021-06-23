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
        }
        .text{
            font-size: 16px;
        }
        .photo{
            width: 200px;
            height: 200px;
            text-align: center;
            object-fit: cover;
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

    <div class="container profile">
        <div class="row justify-content-center">
            <div class="card background" style="width: 69rem">
                <div class="card-body">
                    <h3 class="card-title mt-2 mb-3">My Profile</h3>
                    @if($users->photo == NULL)
                        <img class="rounded mx-auto d-block img-thumbnail rounded-circle photo" src="{{asset('images/profile-placeholder.png')}}" alt="">
                    @else
                        <img class="rounded mx-auto d-block img-thumbnail rounded-circle photo" src="{{'/images/'.$users->photo}}" alt="">
                    @endif
                    <div class="icon">
                        <i class="fas fa-at mt-2"></i>
                        <p class="text">{{$users->username}}</p>
                    </div>
                    
                    <div class="icon">
                        <i class="fas fa-user mt-2"></i>
                        <p class="text">{{$users->name}}</p>
                    </div>
                    
                    <div class="icon">
                        <i class="fas fa-envelope mt-2"></i>
                        <p class="text">{{$users->email}}</p>
                    </div>
                    
                    <div class="text-center">
                        <a href="/settings/{{$users->id}}" class="btn settingBtn mt-3 text button">Settings</a>
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