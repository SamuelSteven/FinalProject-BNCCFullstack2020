@extends('layouts.app')

@section('content')
    <style>
        .form-popup {
            background: rgba(0,0,0,0.6);
            width: 100%;
            heigth: 100%;
            position: absolute;
            top: 0;
            bottom: 0;
            display: none;
            justify-content: center;
            align-items: center;
            text-align: center;
            z-index: 999;
        }

        .popup-content{
            height: 350px;
            width: 600px;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            position: relative;
        }

        .popup{
            width: 20%;
            position: fixed;
            bottom: 0;
            right: 0;
            margin-bottom: -20px;
        }
    </style>

    <div class="form-popup" id="popup">
        <div class="popup-content">
            <form method="POST" action="/home/{{$questions->id}}">
            @method('patch')
            @csrf
                <div class="mb-3">
                    <h4 class="mb-3">Edit your Question</h4>
                    <button type="button" class="btn-close position-absolute top-0 end-0 mt-1" id="close"></button>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Enter the Question Title" name="title" value="{{old('title')}}">
                    @error('title')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-floating">
                    <label for="content">Enter the Question Content</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" placeholder="Enter the Question Content" id="content" style="height: 150px" name="content" value="{{old('content')}}"></textarea>
                    @error('content')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                <button type="submit" class="btn btn-primary my-3">Edit Question!</button>
            </form>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="card" style="width: 55rem;">
                <div class="card-body">
                    <h5 class="card-title">{{$questions->title}}</h5>
                    <p class="card-text">{{$questions->content}}</p>
                    <a href="#" class="btn btn-primary" id="edit">Edit</a>
                    <form class="d-inline"method="POST" action="/home/{{$questions->id}}">
                    @method('delete')
                    @csrf
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.getElementById("edit").addEventListener("click", function(){
            document.querySelector(".form-popup").style.display = "flex";
        });
        document.getElementById("close").addEventListener("click", function(){
            document.querySelector(".form-popup").style.display = "none";
        });
    </script>
    
@endsection