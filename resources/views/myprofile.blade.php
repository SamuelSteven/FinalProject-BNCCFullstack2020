@extends('layouts.app')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap'>);
        *{
            font-family: 'Nunito', sans-serif;
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
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="card" style="width: 69rem">
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
                        <a href="/settings/{{$users->id}}" class="btn btn-primary mt-3 text button">Settings</a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection