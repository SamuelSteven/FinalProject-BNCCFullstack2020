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
                <button class="btn btn-outline-info me-5" type="submit">Search</button>
            </form>
            <div class="flex-center ml-auto">
                <a href="{{ route('login') }}">Login</a>
            </div>
        </div>
    </nav>

    <!-- Question -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="card" style="width: 65rem;">
                <div class="card-body">
                    <h4 class="card-title">{{$questions->title}}</h4>
                    <h6 class="card-subtitle mb-2 text-muted">Created at {{ $questions->created_at}} | Updated at {{ $questions->updated_at}} | By <a href="/otherprofile/{{$questions->users['id']}}">{{$questions->users['username']}}</a></h6>
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
                            <h6 class="card-subtitle mb-2 text-muted">Created at {{ $a->created_at}} | Updated at {{ $a->updated_at}} | By <a href="/otherprofile/{{$a->user['id']}}">{{$a->user['username']}}</a></h6>
                            <p class="card-text my-4">{{ $a->content }}</p>
                        </div>
                    </div>

                    <!-- Reply -->
                    <h5 class="card-text mt-4" id="reply-count">{{ $reply_count }} Replies</h5>
                    @if($reply_count > 0)
                        <!-- Reply Card -->
                        @foreach ($reply as $keys => $r)
                            <div class="card my-4 replycard" style="width: 58rem;" id="reply_card">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2 text-muted">Created at {{ $r->created_at}} | Updated at {{ $r->updated_at}} | By <a href="/otherprofile/{{$r->user_reply['id']}}">{{$r->user_reply['username']}}</a> reply to <a href="/otherprofile/{{$a->user['id']}}">{{$a->user['username']}}</a></h6>
                                    <p class="card-text my-4">{{ $r->content }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endforeach
            @endif
        </div>
    </div>
</body>
</html>
    
