@extends('layouts.gen_form')

@section('title', 'EDIT POST')

@section('content')
<form method="POST" action="{{ route('post_update', ['post_id' => $post->id]) }}" class="col-md-12" enctype="multipart/form-data">
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

    <input id="id" type="text" class="form-control col-md-5" value="{{ $post->id }}" name="id" hidden>

    <input id="user_id" type="text" class="form-control col-md-5" value="{{ Auth::user()->id }}" name="user_id" hidden>

    <div class="form-group row col-md-12">
        <div class="form-group col-12 col-sm-3">
            <span class="align-middle">Author: #{{ $post->user_id }}</span>
        </div>

        <div class="form-group col-12 col-sm-5">
            <label for="category_id" class=" col-form-label text-md-left">{{ __('Category') }}</label>
            <select name="category_id" id="category_id" class="col-4 col-md-8">
                @foreach ($categories as $category)
                    @if ($post->category->id == $category->id)
                        <option value="{{ $category->id }}" selected> {{ $category->name }} </option>
                    @else
                        <option value="{{ $category->id }}"> {{ $category->name }} </option>    
                    @endif
                    
                @endforeach
            </select>
        </div> 
        
        <div class="form-group col-12 col-sm-4">
            <label for="status" class=" col-form-label text-md-left">{{ __('Status') }}</label>
            <select name="status" id="status">
                @if ($post->status == 'draft')
                    <option value="draft" selected> Draft </option>
                    <option value="published"> Published </option>
                @else
                    <option value="draft"> Draft </option>
                    <option value="published" selected> Published </option>
                @endif
            </select>
        </div>
    </div>

    <div class="form-group row col-md-12 ">
        <label for="img" class="col-md-2 col-form-label text-md-left">{{ __('Post image') }}</label>
        @if ($post->img)
            <img src="{{ route('get_post_img', ['img' => $post->img]) }}" 
                alt="post_pic" 
                class="rounded mx-auto d-block"
                style="width: 100px; height: 80px;">
        @endif
    </div>
    
    <div class="form-group row col-md-12 ">
        <label for="img" class="col-md-4 col-form-label text-md-left">{{ __('Change image(optional)') }}</label>

        <div class="col-md-6">
            <input id="img" type="file" class="form-control-file @error('img') is-valid @enderror" 
                name="img">

            @error('img')
            <span class="invalid-feedback" category_id="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <label for="title" class="col-md-2 col-form-label text-md-left">{{ __('Title') }}</label>

    <div class="col-md-12">
        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title"
            value="{{ $post->title }}" autofocus>

        @error('title')
        <span class="invalid-feedback" category_id="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>


    <label for="content" class="col-md-4 col-form-label text-md-left">{{ __('Content') }}</label>

    <div class="col-md-12">
        <textarea name="content" id="content" class="col-md-12" cols="30" rows="10">{{ $post->content }}</textarea>
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