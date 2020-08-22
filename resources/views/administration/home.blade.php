@extends('layouts.dashboard')

@section('title', 'PROFILE')

@section('content')
    <div class="container col-md-6">
        <div class="rounded mx-auto d-block" style="width: 200px; height: 200px;">
            <img src="{{ Auth::user()->img }} " alt="profile" class="rounded mx-auto d-block" style="width: 200px; height: 200px;">
        </div>
        <div class="md-6">
            <strong> Role: </strong> {{ Auth::user()->role }} 
        </div>
        <div>
            <strong> Name: </strong> {{ Auth::user()->f_name }} 
        </div>
        <div>
            <strong> Last Name: </strong> {{ Auth::user()->last_name }} 
        </div>
        <div>
            <strong> Email: </strong> {{ Auth::user()->email }} 
        </div>
        <div>
            <strong> Joined: </strong> {{ Auth::user()->created_at->format('j F, Y') }} 
        </div>
    </div>
@endsection
