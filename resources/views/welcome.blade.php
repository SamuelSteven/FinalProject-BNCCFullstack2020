<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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

        <!-- Styles -->
        <style>
            html, body {
                /* #1f3e75 */
                background-image: url('/background/Frame 1.png'); 
                background-repeat: repeat-y;
                background-size: cover;
                color: #000;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                margin: 0;
                padding: 0;
            }
            body{
                position:relative;
                min-height: 100vh;
            }
            body::after {
                content: '';
                display: block;
                height: 120px; /* Set same as footer's height */
            }
            .links > a {
                color: #fff;
                padding: 0 10px;
                text-decoration: none;
            }
            .navbar{
                width: 80%;
                margin-left:auto;
                margin-right: auto;
                margin-top:20px;
            }
            .navbar-light .navbar-nav .nav-link, .navbar-light .navbar-brand, .navbar-light .navbar-nav .nav-link.active, .navbar-light .navbar-nav .show>.nav-link{
                color: white;
            }
            .navbar-light .navbar-brand:hover, .navbar-light .navbar-nav .nav-link:hover, .links > a:hover{
                color:#f0f0f0;
            }
            h4{
                color:white;
            }
            footer{
                padding: 2rem 0;
                background-color: #f4f5f7;
                position: absolute;
                height: 80px;
                bottom: 0;
                width: 100%;
                clear: both;
            }
            footer ul li a{
                text-decoration: none;
                color: black;
            }
            #register{
                background-color: white;
                color: #5e72e4;
                font-size: .875rem;
                font-weight: bold;
            }
            #register:hover{
                color: black;
                box-shadow: 1px 1px 7px #888888;
            }
            .readBtn{
                background-color: #5e72e4;
                color: white;
            }
            .readBtn:hover{
                color: white;
                box-shadow: 1px 1px 7px #888888;
            }
            .searchBtn{
                border: 1.5px solid #cfe2ff;
                color: #cfe2ff;
            }
            .searchBtn:hover{
                background-color: #cfe2ff;
                color: black;
            }
            @media (-webkit-device-pixel-ratio: 1.50) {
                * {
                    zoom: 0.98;
                }
            }
            .logo{
                width: 110px; 
                margin-right: 20px;
            }
          </style>
    </head>
    <body>
        <!-- navbar -->
        <nav class="navbar navbar-expand-lg navbar-light navbar mb-4">
            <div class="container-fluid">
                <a href="{{url('/')}}"><img src="{{asset('background/logo.png')}}" class="logo" alt="logo"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active ml-4 mr-3" aria-current="page" href="{{url('/')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="register" class="btn ml-4" id="register">
                                <span>
                                    <i class="fas fa-user-plus mr-1"></i>REGISTER
                                </span>    
                            </a>
                        </li>
                    </ul>
                <form class="d-flex mr-5" method="GET" action="{{url('/search')}}">
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search" name="keyword">
                    <button class="btn searchBtn me-5" type="submit"><i class="fas fa-search"></i></button>
                </form>
                <div class="flex-center ml-auto">
                        @if (Route::has('login'))
                            <div class="top-right links">
                                @auth
                                    <a href="{{ url('/home') }}">Home</a>
                                @else
                                    <a href="{{ route('login') }}">Login</a>
                                @endauth
                            </.>
                        @endif
                    </div>
            </div>
        </nav>
        
        <!-- Content -->
        <div class="content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10">     
                        <!-- Content -->
                        @if($questions_count >= 0 && $questions_count != NULL )
                            <h4 class="mt-3 d-block" id="results">{{$questions_count}} results</h4>
                        @else
                            <h4 class="mt-3 d-none" id="results">{{$questions_count}} results</h4>
                        @endif
                        <div class="row">
                            @if($questions_available > 0)
                                @foreach($questions as $key => $question)
                                    <div class="col-md-4 mt-4">
                                        <div class="card" id="question-card" style="width: 20rem; height: 250px; padding: 5px; ">
                                            <div class="card-body d-flex flex-column">
                                                @if ($question->status == "false")
                                                    <span class="card-text text-danger">Thread already closed</span>
                                                @endif
                                                <h5 class="card-title">{{$question->title}}</h5>
                                                <h6 class="card-subtitle mb-2 text-muted">{{$questions_time[($key-1)+1]}}</h6>
                                                <p class="card-text">{{Str::limit($question->content, 73)}}</p>
                                                <div class="mt-auto mb-3 comment d-inline-flex" style="color: #f5365c;">
                                                    <i class="fa fa-comments mr-2"></i>
                                                    <p class="card-text">{{$total_comment[$key]}}</p>
                                                </div>
                                                <a href="/thread_no_login/{{$question->id}}" class="btn readBtn" style="width:120px;">Read More</a>
                                            </div>                          
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <footer class="mt-5">
            <div class="container">
                <div class="row align-items-center justify-content-md-between">
                    <div class="col-md-6">
                        <div class="ml-3">© 2021 Forum Sunib.</div>
                    </div>
    
                    <div class="col-md-6">
                        <ul class="nav nav-footer justify-content-end">
                            <li class="nav-item"><a href="/home" class="mr-3">Home</a></li>
                            <li class="nav-item"><a href="{{ route('login') }}" class="mr-3">Login</a></li>
                            <li class="nav-item"><a href="{{ route('register') }}" class="mr-3">Register</a></li>
                        </ul>
                    </div>
                </div>
            </div> 
        </footer>
    </body>
</html>
