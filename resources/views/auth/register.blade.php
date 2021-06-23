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
        .content {
            text-align: center;
        }

        .links > a {
            color: white;
            padding: 0 25px;
            font-size: 16px;
            text-decoration: none;
        }
        .navbar{
            color: white;
            width: 80%;
            margin-left:auto;
            margin-right: auto;
            margin-top:20px;
        }
        .navbar-light .navbar-nav .nav-link, .navbar-light .navbar-brand, .navbar-light .navbar-nav .nav-link.active, .navbar-light .navbar-nav .show>.nav-link{
            color: white;
        }
        .navbar-light .navbar-brand:hover, .navbar-light .navbar-nav .nav-link:hover, .navbar-light .navbar-nav .nav-link.active:hover, .navbar-light .navbar-nav .show>.nav-link:hover{
            color:#f0f0f0;
        }
        .card{
            background-color: #f4f5f7;
        }
        .width{
            width: 415px;
        }
        .register{
            width: 90%;
        }
        #registerCard{
            width: 90%;
            margin-left:auto;
            margin-right:auto;
            color: gray;
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
        }
        #register:hover{
            color: black;
            box-shadow: 1px 1px 7px #888888;
        }
        .regisBtn{
            background-color: #5e72e4;
            color: white;
        }
        .regisBtn:hover{
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
    </style>
</head>
<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar mb-5">
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
                        <a href="register" class="btn ml-4" id="register">
                            <span>
                                <i class="fas fa-user-plus mr-1"></i>REGISTER
                            </span>    
                        </a>
                    </li>
                </ul>
            <form class="d-flex mr-5">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search">
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

    <div class="container register">
        <div class="row justify-content-center">
            <div class="card mb-5" style="width: 35rem">
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" id="registerCard">
                        @csrf
                        <h4 class="text-center mt-4">Register</h4>
                        <div class="form-group">
                            <label for="username">{{ __('Username') }}</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background-color: white">
                                        <i class="fa fa-at" style="color: gray"></i>
                                    </span>
                                    <input id="username" type="text" class="form-control width @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background-color: white">
                                        <i class="fa fa-user" style="color: gray"></i>
                                    </span>
                                    <input id="name" type="text" class="form-control width @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background-color: white">
                                        <i class="fa fa-envelope" style="color: gray"></i>
                                    </span>
                                    <input id="email" type="email" class="form-control width @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background-color: white">
                                        <i class="fas fa-unlock-alt" style="color: gray"></i>
                                    </span>
                                    <input id="password" type="password" class="form-control width @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="col-md-6">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background-color: white">
                                        <i class="fas fa-unlock-alt" style="color: gray"></i>
                                    </span>
                                    <input id="password-confirm" type="password" class="form-control width" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center"> 
                            <button type="submit" class="btn regisBtn">
                                {{ __('Register') }}
                            </button>   
                        </div>
                    </form>
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


