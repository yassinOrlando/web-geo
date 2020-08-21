@extends('layouts.app')

@section('content')
<div class="container col-md-12">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card bg-warning">
                <div class="card-header text-center"><b>{{ __('Dashboard') }}</b></div>
                {{--
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }} 
                </div> --}}
            </div>
        </div>
    </div>

    <div class="row justify-content-center" >
        <div class="col-md-2" style="margin-top: 20px">
            <div class="card text-white bg-secondary">
                <div class="card-header text-center">{{ __('OPTIONS') }}</div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item bg-secondary">Posts</li>
                    <li class="list-group-item bg-secondary">Categories</li>
                    <li class="list-group-item bg-secondary">Authors</li>
                    <li class="list-group-item bg-secondary">Countries</li>
                </ul>
            </div>
        </div>

        <div class="col-md-10" style="margin-top: 20px">
            <div class="card">
                <div class="card-header text-center">{{ __('CHOSED OPTION') }}</div>
                <div class="card-body">
                    {{ __('Option 1') }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
