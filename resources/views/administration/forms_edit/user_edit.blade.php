@extends('layouts.gen_form')

@section('title', 'EDIT USER')

@section('content')
<form method="POST" action="{{ route('author_update', ['auth_id' => $author->id]) }}" class="col-md-12" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        </div>
    @endif

    <div class="form-group row">
        <input id="id" type="text" class="form-control @error('id') is-valid @enderror" value="{{ $author->id }}" name="id" hidden>

        <label for="img" class="col-md-4 col-form-label text-md-right">{{ __('Profile image') }}</label>
        @if ($author->img)
            <img src="{{ route('get_avatar', ['img' => $author->img]) }}" 
                alt="profile_pic" 
                class="rounded mx-auto d-block"
                style="width: 60px; height: 60px;">
        @endif
    </div>

    <div class="form-group row">
        <input id="id" type="text" class="form-control @error('id') is-valid @enderror" value="{{ $author->id }}" name="id" hidden>

        <label for="img" class="col-md-4 col-form-label text-md-right">{{ __('Change image (optional)') }}</label>

        <div class="col-md-6">
            <input id="img" type="file" class="form-control-file @error('img') is-valid @enderror" value="{{ route('get_avatar', ['img' => $author->img]) }}" name="img">

            @error('img')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('User role') }}</label>
       
        <div class="col-md-6">
            @if ($user_role == 'author')
                <input type="text" name="role" class="form-control" id="role" value="author" hidden> <span>{{ 'Author' }} </span>
            @else 
                <select name="role" id="role">
                    @if ($author->role == 'author')
                        <option value="author" selected> Author </option>
                        <option value="admin"> Admin </option>
                    @else
                        <option value="author" > Author </option>
                        <option value="admin" selected> Admin </option>
                    @endif
                </select>
            @endif    
        </div>
    </div>

    <div class="form-group row">
        <label for="f_name" class="col-md-4 col-form-label text-md-right">{{ __('First name') }}</label>

        <div class="col-md-6">
            <input id="f_name" type="text" class="form-control @error('f_name') is-invalid @enderror" name="f_name" value="{{ $author->f_name }}" required autocomplete="f_name" autofocus>

            @error('f_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last name') }}</label>

        <div class="col-md-6">
            <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $author->last_name }}" required autocomplete="last_name">

            @error('last_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $author->email }}" required autocomplete="email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <br>

    <div class="col-md-6">
        <a href="{{ route('home') }}" onclick="return confirm('Your changes are not going to be saved')">
            <button type="button" class="btn btn-danger" id="back" >
                {{ __('Cancel') }}
            </button>
        </a>

        <button type="submit" class="btn btn-primary">
            {{ __('Save changes') }}
        </button>
    </div>
</form>

@endsection