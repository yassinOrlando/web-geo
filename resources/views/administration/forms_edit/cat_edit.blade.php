@extends('layouts.gen_form')

@section('title', 'EDIT CATEGORY')

@section('content')
<form method="POST" action="{{ route('cat_update', ['cat_id' => $category->id]) }}" class="col-md-12">
    @csrf
    @method('PUT')

    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ __('Changes saved') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="form-group row d-flex justify-content-around ">
        <input id="id" type="text" class="form-control col-md-5" value="{{ $category->id }}" name="id" hidden>
    </div>

    <div class="row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Category name') }}</label>

        <div class="col-md-8">
            <input id="name" type="text" class="form-control @error('name') is-valid @enderror" value="{{ $category->name }}"
                name="name">

            @error('name')
            <span class="invalid-feedback" category_id="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <br>

    <div class="col-md-6">
        <a href="{{ route('home') }}" onclick="return confirm('Your changes are not going to be saved')">
            <button type="button" class="btn btn-danger" id="back">
                {{ __('Cancel') }}
            </button>
        </a>

        <button type="submit" class="btn btn-primary">
            {{ __('Save changes') }}
        </button>
    </div>
</form>


@endsection