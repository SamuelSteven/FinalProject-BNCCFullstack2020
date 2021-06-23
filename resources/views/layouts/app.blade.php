<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

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
                background-image: url('/background/Frame 1.png'); 
                background-repeat: repeat-y;
                background-size: cover;
                color: #000;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100%;
                margin: 0;
                padding: 0;
            }
            .content {
                text-align: center;
            }
            .links > a {
                color: #000;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
            }
            .navbar{
                color: white;
                width: 80%;
                margin-left:auto;
                margin-right: auto;
                margin-top:20px;
            }
            #greetings{
                margin-bottom: 5px;
            }
            .navbar-light .navbar-nav .nav-link, .navbar-light .navbar-brand, .navbar-light .navbar-nav .nav-link.active, .navbar-light .navbar-nav .show>.nav-link{
                color: white;
            }
            .navbar-light .navbar-brand:hover, .navbar-light .navbar-nav .nav-link:hover, .navbar-light .navbar-nav .nav-link.active:hover, .navbar-light .navbar-nav .show>.nav-link:hover{
                color:#f0f0f0;
            }
            footer{
                padding: 1rem 0;
                background-color: #f4f5f7;
                position: relative;
                left: 0;
                bottom: 0;
                width: 100%;
            }
            footer ul li a{
                text-decoration: none;
                color: black;
            }
            #askbutton{
                background-color: white;
                color: #5e72e4;
                font-size: .875rem;
                font-weight: bold;
            }
            #askbutton:hover{
                color: black;
                box-shadow: 1px 1px 7px #888888;
            }
            #search_button{
                border: 1.5px solid #cfe2ff;
                color: #cfe2ff;
            }
            #search_button:hover{
                background-color: #cfe2ff;
                color: black;
            }
            @media (-webkit-device-pixel-ratio: 1.50) {
                * {
                    zoom: 0.98;
                }
            }
        </style>
    </head>

    <body>
        <!-- navbar -->
        <nav class="navbar navbar-expand-lg navbar-light navbar">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{url('/home')}}">Forum Sunib</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active ml-4 mr-3" aria-current="page" href="{{url('/home')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn ml-4" id="askbutton">
                                <span>
                                    <i class="fa fa-paper-plane mr-1"></i>ASK QUESTION
                                </span>
                            </a>
                        </li>
                    </ul>
                <form class="d-flex mr-5" method="GET" action="{{url('/home/search')}}">
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search" name="keyword">
                    <button class="btn me-5" id="search_button" type="submit"><i class="fas fa-search"></i></button>
                </form>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->username }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <p class="d-flex justify-content-center" id="greetings">Hi, {{ Auth::user()->username }}!</p>
                                <a class="dropdown-item" href="/myprofile/{{Auth::user()->id}}">{{ __('My Profile') }}</a>
                                <a class="dropdown-item" href="/settings/{{Auth::user()->id}}">{{ __('Settings') }}</a>
                                <a class="dropdown-item" href="/logout/{{Auth::user()->id}}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="/logout/{{Auth::user()->id}}"  method="POST" class="d-none">
                                    @csrf
                                </form>                               
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>

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

