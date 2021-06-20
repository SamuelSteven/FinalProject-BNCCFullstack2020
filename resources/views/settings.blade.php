@extends('layouts.app')

@section('content')
    <style>
        html, body{
            background-color: #1f3e75;
        }
        h3{
            color: white;
        }
        .setting{
            width:50%;
        }
        #form_action{
            width: 90%;
            margin-left:auto;
            margin-right:auto;
        }
        #form_action input, label{
            display: flex;
        }
        #form_actions{
            width: 90%;
            margin-left:auto;
            margin-right:auto;
        }
        #form_upload{
            width: 40%;
            margin-left:auto;
            margin-right:auto;
        }
        .button{
            width: 179px;
            height: 40px;
            padding: 8px;
        }
        .width{
            width: 415px;
        }
        .button{
            background-color: white;
            color: #5e72e4;
        }
        .button .fas{
            color: #5e72e4;
        }
        .button:focus{
            background-color: #5e72e4;
            color: white;
        }
        .button:focus .fas{
            color: white;
        }
        #active{
            background-color: #5e72e4; 
            color: white; 
            font-weight: bold;
        }
        #active:hover{
            box-shadow: 1px 1px 7px #888888;
        }
    </style>

    <div class="container setting">
        <div class="row justify-content-center">
            <h3 class="card-title mb-3">Settings</h3>
            <div class="text-center">
                <a href="#" class="btn mx-1 mt-3 mb-3 button" onclick="show_profile()">
                    <i class="fas fa-user"></i> Profile
                </a>
                <a href="#" class="btn mx-1 mt-3 mb-3 button" onclick="show_avatar()">
                    <i class="fas fa-cloud-upload-alt"></i> Avatar
                </a>
                <a href="#" class="btn mx-1 mt-3 mb-3 button" onclick="show_password()">
                    <i class="fas fa-unlock-alt"></i> Password
                </a>
            </div>
            <div class="card" style="width: 35rem">
                <div class="card-body">
                    <!-- Profile -->
                    <form method="POST" action="/settingsProfile/{{$users->id}}" id="form_action" class="form_profile d-block text-center">
                        @method('patch')
                        @csrf
                        <h4 class="text-center mt-4">Update Your Profile</h4>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background-color: white">
                                        <i class="fa fa-user" style="color: #a7adb2"></i>
                                    </span>
                                    <input class="form-control width" type="text" id="name" value="{{$users->name}}" name="name" class="form-control @error('name') is-invalid @enderror">
                                </div>
                            </div>
                        </div>
                        @error('name')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror

                        <div class="form-group">
                            <label for="username">Username</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background-color: white">
                                        <i class="fa fa-at" style="color: #a7adb2"></i>
                                    </span>
                                    <input class="form-control width" type="text" value="{{$users->username}}" id="username" name="username" class="form-control @error('username') is-invalid @enderror">
                                </div>
                            </div>
                        </div>
                        @error('username')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror

                        <div class="form-group">
                            <label for="email">Email</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background-color: white">
                                        <i class="fa fa-envelope" style="color: #a7adb2"></i>
                                    </span>
                                    <input class="form-control width" type="text" value="{{$users->email}}" id="email" name="email" class="form-control @error('email') is-invalid @enderror">
                                </div>
                            </div>
                        </div>
                        @error('email')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror

                        <button type="submit" class="btn my-3 mb-4 justify" id="active">UPDATE PROFILE</button>
                    </form>

                    <!-- Avatar -->
                    <form method="POST" action="/settingsPhoto" enctype="multipart/form-data" id="form_upload" class="form-photo d-none">
                        @csrf
                        <div class="form-group" style="height: 20rem;">
                            <h4 class="text-center">Upload photo</h4>
                            <input type="file" class="form-control-file text-center" id="photo" name="photo">
                            <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                        </div>

                        <button type="submit" class="btn" id="active">UPLOAD</button>
                    </form>

                    <!-- Password -->
                    <form method="POST" action="/settingsPassword/{{$users->id}}" id="form_actions" class="form-password d-none text-center">
                        @method('patch')
                        @csrf
                        <h4 for="content" class="text-center mt-4">Change Your Password</h4>
                        <div class="form-group mt-4">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background-color: white">
                                        <i class="fas fa-unlock-alt" style="color: #a7adb2"></i>
                                    </span>
                                    <input type="password" id="currentPassword" name="currentPassword" placeholder="Current Password" class="form-control width @error('currentPassword') is-invalid @enderror d-block"> 
                                </div>
                            </div>
                        </div>
                        @error('currentPassword')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror

                        <div class="form-group mt-4">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background-color: white">
                                        <i class="fas fa-unlock-alt" style="color: #a7adb2"></i>
                                    </span>
                                    <input type="password" id="newPassword" name="newPassword" placeholder="New Password" class="form-control width @error('newPassword') is-invalid @enderror d-block">
                                </div>
                            </div>
                        </div>
                        @error('newPassword')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror

                        <div class="form-group mt-4">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background-color: white">
                                        <i class="fas fa-unlock-alt" style="color: #a7adb2"></i>
                                    </span>
                                    <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" class="form-control width @error('confirmPassword') is-invalid @enderror d-block">
                                </div>
                            </div>
                        </div>
                        @error('confirmPassword')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror

                        <button type="submit" class="btn my-3 mb-4" id="active">CHANGE PASSWORD</button> 
                   </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function show_profile(){
            document.getElementById("form_actions").className = "form-password d-none";
            document.getElementById("form_action").className = "form-profile d-block text-center";
            document.getElementById("form_upload").className = "form-photo d-none";
        }
        function show_avatar(){
            document.getElementById("form_action").className = "form-profile d-none";
            document.getElementById("form_upload").className = "form-photo d-block text-center";
            document.getElementById("form_actions").className = "form-password d-none";
        }
        function show_password(){
            document.getElementById("form_actions").className = "form-password d-block text-center";
            document.getElementById("form_action").className = "form-profile d-none";
            document.getElementById("form_upload").className = "form-photo d-none";
        }
    </script>
@endsection