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

        <!-- Styles -->
        <style>
            html, body {
                /* #1f3e75 */
                background-color: #fff; 
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
                            <a class="nav-link active" aria-current="page" href="{{url('/home')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="register" class="btn btn-primary ml-4 bg-info" id="register">Register</a>
                        </li>
                    </ul>
                <form class="d-flex mr-5">
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-info me-5" type="submit">Search</button>
                </form>
                <div class="flex-center ml-auto">
                    <a href="{{ route('login') }}">Login</a>
                </div>
            </div>
        </nav>
        
        <!-- Content -->
        <div class="content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10">     
                        <!-- Content -->
                        <div class="row">
                            @foreach($questions as $question)
                                <div class="col-md-4 mt-5">
                                    <div class="card" id="question-card" style="width: 20rem;">
                                        <div class="card-body">
                                            <h5 class="card-title">{{$question->title}}</h5>
                                            <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                                            <p class="card-text">{{$question->content}}</p>
                                            <a href="/thread_no_login/{{$question->id}}" class="btn btn-primary">Read More</a>
                                        </div>                          
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </body>
</html>
