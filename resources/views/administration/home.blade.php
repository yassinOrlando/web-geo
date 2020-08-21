@extends('layouts.dashboard')

@section('title', 'PROFILE')

@section('content')
    <div class="container col-md-6">
        <img src="https://picsum.photos/200" alt="profile" class="rounded mx-auto d-block">
        <div class="md-6">
            <strong> Role: </strong> rol
        </div>
        <div>
            <strong> Name: </strong> Nombre
        </div>
        <div>
            <strong> Last Name: </strong> Apellido
        </div>
        <div>
            <strong> Email: </strong> Mi Email
        </div>
        <div>
            <strong> Password: </strong> Contraseña
        </div>
    </div>
@endsection
