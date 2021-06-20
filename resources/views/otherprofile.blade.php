@extends('layouts.app')

@section('content')
    <style>
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
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="card" style="width: 69rem">
                <div class="card-body">
                    <h3 class="card-title mt-2 mb-3">Profile</h3>
                    @if($users->photo == NULL)
                        <img class="rounded mx-auto d-block img-thumbnail rounded-circle photo" src="{{asset('images/profile-placeholder.png')}}" alt=""/>
                    @else
                        <img class="rounded mx-auto d-block img-thumbnail rounded-circle photo" src="{{'/images/'.$users->photo}}" alt=""/>
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
                    
                </div>
            </div>
        </div>
    </div>
@endsection