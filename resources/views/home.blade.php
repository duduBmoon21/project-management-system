@extends('layouts.app')

@section('content')
<head>
    <style>
        .start
        {
            font-family: sans-serif;
            margin-top: 20px;
        }
        .shows
        {
            margin-top: 20px;
        }
        .shows img
        {
            width: 100%;
            border-radius: 10%;
            height: 100%;
        }
    </style>
</head>
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    Welcome {{ Auth::user()->name }}
                    
                    <br>
                  
                    You are in!
                </div>
               
                <h1 class="start text-center">Have a Nice Day</h1>
                <div class="row text-center shows">
        
                    <div class="col-md-4 text-center">
                        <img src="{{ asset('images/Hiring%20manager%205%20sec.gif')}}">    
                    </div>
                    <div class="col-md-4">
                        <img src="{{ asset('images/we_re-hiring_loop.gif')}}">
                    </div>
                    <div class="col-md-4">
                        <img src="{{ asset('images/Tech_recruiter_loop.gif')}}">
                    </div>
                </div>

            </div>
            
        </div>
        
    </div>
@endsection
