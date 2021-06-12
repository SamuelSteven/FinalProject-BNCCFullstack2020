@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">     
            <!-- Cards -->
            <div class="card" id="test">
                <div class="card-header">{{ __('Welcome!') }}
                    <button type="button" class="btn-close position-absolute top-0 end-0 mt-1" onclick="closing()"></button>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }}
                </div>
            </div>
            <!-- Content -->
        </div>
    </div>
</div>

<script>
    function closing(){
        document.getElementById("test").style.display = "none";
    }
</script>
@endsection

