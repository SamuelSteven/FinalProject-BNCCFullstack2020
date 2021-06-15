@extends('layouts.app')

@section('content')
    <style>
        h5{
            text-align: center;
        }
        .icon{
            text-align: center;
        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="card" style="width: 55rem">
                <div class="card-body">
                    <h5 class="card-title">My Profile</h5>
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
                    
                    <div class="text-center">
                        <button type="button" class="btn btn-primary button">Settings</button>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection