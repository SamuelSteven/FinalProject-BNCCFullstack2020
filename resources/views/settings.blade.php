@extends('layouts.app')

@section('content')
    <style>
        .icon{
            text-align: center;
        }
        #form_action{
            width: 50%;
            margin-left:auto;
            margin-right:auto;
        }
        #form_action input, label{
            display: flex;
        }
        #form_actions{
            width: 50%;
            margin-left:auto;
            margin-right:auto;
        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="card" style="width: 35rem">
                <div class="card-body">
                    <h3 class="card-title text-center">Settings</h3>
                    <div class="text-center">
                        <a href="#" class="btn btn-info mx-1 mt-3" onclick="show_profile()">Profile</a>
                        <a href="#" class="btn btn-info mx-1 mt-3" onclick="show_avatar()">Avatar</a>
                        <a href="#" class="btn btn-info mx-1 mt-3" onclick="show_password()">Password</a>
                    </div>
                    
                    <!-- Profile -->
                    <form method="POST" action="/settingsProfile/{{$users->id}}" id="form_action" class="form_profile d-block">
                        @method('patch')
                        @csrf
                        <h4 for="content" class="text-center mt-4">Update Your Profile</h4>
                        <label for="name">Name</label>
                        <input type="text" id="name" value="{{$users->name}}" name="name" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror

                        <label for="username" class="mt-2">Username</label>
                        <input type="text" value="{{$users->username}}" id="username" name="username" class="form-control @error('username') is-invalid @enderror">
                        @error('username')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror

                        <label for="email" class="mt-2">Email</label>
                        <input type="text" value="{{$users->email}}" id="email" name="email" class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror

                        <button type="submit" class="btn btn-info my-3 mb-4">Update Profile</button>
                    </form>

                    <!-- Avatar -->

                    <!-- Password -->
                    <form method="POST" action="/settingsPassword/{{$users->id}}" id="form_actions" class="form-password d-none">
                        @method('patch')
                        @csrf
                        <h4 for="content" class="text-center mt-4">Change Your Password</h4>
                        <input type="password" id="currentPassword" name="currentPassword" placeholder="Current Password" class="form-control @error('currentPassword') is-invalid @enderror d-block mb-2 mt-4"> 
                        @error('currentPassword')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror

                        <input type="password" id="newPassword" name="newPassword" placeholder="New Password" class="form-control @error('newPassword') is-invalid @enderror d-block mb-2">
                        @error('newPassword')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror

                        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" class="form-control @error('confirmPassword') is-invalid @enderror d-block mb-2">
                        @error('confirmPassword')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror

                        <button type="submit" class="btn btn-info my-3 mb-4">Change Password</button> 
                   </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function show_profile(){
            document.getElementById("form_actions").className = "form-password d-none";
            document.getElementById("form_action").className = "form-profile d-block";
        }
        function show_avatar(){
            document.getElementById("form_actions").className = "form-password d-none";
            document.getElementById("form_action").className = "form-profile d-none";
        }
        function show_password(){
            document.getElementById("form_actions").className = "form-password d-block";
            document.getElementById("form_action").className = "form-profile d-none";
        }
    </script>
@endsection