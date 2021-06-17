@extends('layouts.app')

@section('content')
    <style>
        h5{
            text-align: center;
        }
        .icon{
            text-align: center;
        }
        .photo{
            width: 100px;
            height: 100px;
            text-align: center;
            object-fit: cover;
        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="card" style="width: 55rem">
                <div class="card-body">
                    <h5 class="card-title">Profile</h5>
                    @if($users->photo == NULL)
                        <img class="rounded mx-auto d-block img-thumbnail photo" src="{{asset('images/profile-placeholder.png')}}" alt=""/>
                    @else
                        <img class="rounded mx-auto d-block img-thumbnail photo" src="{{'/images/'.$users->photo}}" alt=""/>
                    @endif
                    <div class="icon">
                        <span class="d-inline-block">
                            <i class="fas fa-at"></i>
                        </span>
                        <span class="d-inline-block">{{$users->username}}</span>
                    </div>
                    
                    <div class="icon">
                        <span class="d-inline-block">
                            <i class="fas fa-user"></i>
                        </span>
                        <span class="d-inline-block">{{$users->name}}</span>
                    </div>
                    
                    <div class="icon">
                        <span class="d-inline-block">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <span class="d-inline-block">{{$users->email}}</span>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection