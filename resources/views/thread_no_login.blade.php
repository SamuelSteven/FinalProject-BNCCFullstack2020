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
        .navbar-light .navbar-brand, .navbar-light .navbar-nav .nav-link.active, .navbar-light .navbar-nav .show>.nav-link, .links > a{
                color: white;
        }
        .navbar-light .navbar-brand:hover, .navbar-light .navbar-nav .nav-link.active:hover, .navbar-light .navbar-nav .show>.nav-link:hover, .links > a:hover{
            color:#f0f0f0;
        }
        h5{
            color:white;
        }
        hr{
            color:white;
            border-top: 2px solid #fff;
        }
        .searchBtn{
            border: 1.5px solid #cfe2ff;
            color: #cfe2ff;
        }
        .searchBtn:hover{
            background-color: #cfe2ff;
            color: black;
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
        @media (-webkit-device-pixel-ratio: 1.50) {
            * {
                zoom: 0.98;
            }
        }
        .profileLink{
            text-decoration: none;
            color: #5e72e4;
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
                        <a class="nav-link active ml-4 mr-3" aria-current="page" href="{{url('/')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="btn ml-4" id="register">
                            <span>
                                <i class="fas fa-user-plus mr-1"></i>REGISTER
                            </span>    
                        </a>
                    </li>
                </ul>
            <form class="d-flex mr-5" method="GET" action="{{url('/search')}}">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search" name='keyword'>
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

    <!-- Question -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="card" style="width: 65rem;">
                <div class="card-body">
                    <h4 class="card-title">{{$questions->title}}</h4>
                    <h6 class="card-subtitle mb-2 text-muted">Created at {{ $questions->created_at}} | Updated at {{ $questions->updated_at}} | By <a class="profileLink" href="/otherprofile_no_login/{{$questions->users['id']}}">{{$questions->users['username']}}</a></h6>
                    <p class="card-text">{{$questions->content}}</p>
                </div>
            </div>

            <!-- Answers -->
            <hr class="mt-4" style="width: 65rem">
            <h5 class="card-text mt-4" id="answer-count">{{ $answer_count }} Answers</h5>
            @if($answer_count > 0)
                <!-- Answers Card -->
                @foreach ($answer as $key => $a)
                    <div class="card my-4 answercard" style="width: 65rem;">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">Created at {{ $a->created_at}} | Updated at {{ $a->updated_at}} | By <a class="profileLink" href="/otherprofile_no_login/{{$a->user['id']}}">{{$a->user['username']}}</a></h6>
                            <p class="card-text my-4">{{ $a->content }}</p>
                        </div>
                    </div>

                    <!-- Reply -->
                    <h5 class="card-text mt-4" id="reply-count">{{ $reply_count[$key] }} Replies</h5>
                    @if($reply_count[$key] > 0)
                        <!-- Reply Card -->
                        @foreach ($reply[$key] as $keys => $r)
                            <div class="card my-4 replycard" style="width: 58rem;" id="reply_card">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2 text-muted">Created at {{ $r->created_at}} | Updated at {{ $r->updated_at}} | By <a class="profileLink" href="/otherprofile_no_login/{{$r->user_reply['id']}}">{{$r->user_reply['username']}}</a> reply to <a class="profileLink" href="/otherprofile_no_login/{{$a->user['id']}}">{{$a->user['username']}}</a></h6>
                                    <p class="card-text my-4">{{ $r->content }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endforeach
            @endif
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
    
