<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

        <title>Forum Sunib</title>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/87bc1c7077.js" crossorigin="anonymous"></script>

        <style>
            html, body {
                /* #1f3e75 */
                background-color: #1f3e75; 
                color: #000;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .content {
                text-align: center;
            }

            .links > a {
                color: #000;
                padding: 0 10px;
                text-decoration: none;
            }
            .navbar{
                width: 65%;
                margin-left:auto;
                margin-right: auto;
                margin-top:20px;
            }
            .row>*{
                padding-right: 0;
                padding-left: 0;
            }
            #answer-count{
                margin-left: 280px;
            }
            #reply-count{
                margin-left: 495px;
            }
            #form_action_reply{
                margin-left: 495px;
            }
            #form_action{
                margin-left:280px;
            }
            #form_actions{
                margin-left:280px;
            }
            .form-floating #content-textbox{
                padding-top:10px;
            }
            #reply_card{
                margin-left: 110px;
            }
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
            .navbar-light .navbar-brand, .navbar-light .navbar-nav .nav-link.active, .navbar-light .navbar-nav .show>.nav-link, .links > a{
                color: white;
            }
            .navbar-light .navbar-brand:hover, .navbar-light .navbar-nav .nav-link.active:hover, .navbar-light .navbar-nav .show>.nav-link:hover, .links > a:hover{
                color:#f0f0f0;
            }
            h5{
                color:white;
            }
            .photo{
                width: 200px;
                height: 200px;
                text-align: center;
                object-fit: cover;
            }
            .searchBtn{
                border: 1.5px solid #cfe2ff;
                color: #cfe2ff;
            }
            .searchBtn:hover{
                background-color: #cfe2ff;
                color: black;
            }
        </style>
    </head>
    <body>
        <!-- navbar -->
        <nav class="navbar navbar-expand-lg navbar-light navbar">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{url('/')}}">Forum Sunib</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{url('/')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="register" class="btn btn-primary ml-4 bg-info" id="register">Register</a>
                        </li>
                    </ul>
                <form class="d-flex mr-5">
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn searchBtn me-5" type="submit"><i class="fas fa-search"></i></button>
                </form>
                @if (Route::has('login'))
                    <div class="top-right links">
                        @auth
                            <a href="{{ url('/') }}">Home</a>
                        @else
                            <a href="{{ route('login') }}">Login</a>
                        @endauth
                    </.>
                @endif
            </div>
        </nav>

        <!-- Content -->
        <div class="container">
            <div class="row justify-content-center">
                <div class="card" style="width: 69rem">
                    <div class="card-body">
                        <h5 class="card-title mt-2 mb-3">Profile</h5>
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
    </body>
</html>