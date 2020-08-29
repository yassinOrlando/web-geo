@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <img src="{{ route('get_post_img', ['img' => $post->img ]) }}"
                alt="post_pic" 
                class="card-img-top"
                style="height: 400px; width:100%;">
            <div class="card-body">
                <h1>{{ $post->title }}</h1>
                <div class="d-flex justify-content-between">
                    <p>
                        <img src="{{ route('get_avatar', ['img' => $post->user->img ]) }}" alt="author_pic"
                                        style="width: 40px; height: 40px; border-radius:100px;">
                                    {{ $post->user->f_name.' '.$post->user->last_name }}
                    </p>
                    <p>
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-card-list"
                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                            <path fill-rule="evenodd"
                                d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5z" />
                            <circle cx="3.5" cy="5.5" r=".5" />
                            <circle cx="3.5" cy="8" r=".5" />
                            <circle cx="3.5" cy="10.5" r=".5" />
                        </svg>
                        {{ $post->category->name }}
                    </p>
                    <p class="text-muted">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-calendar3"
                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z" />
                            <path fill-rule="evenodd"
                                d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                        </svg>
                        {{ $post->created_at->format('d/m/Y') }}
                    </p>
                </div>
                <hr>
                <div>
                    {!! $post->content !!}
                </div>
            </div>
        </div>

        <br>
        <h3> Other posts </h3>
        <div class="row row-cols-1 row-cols-md-3">
            @foreach($other_posts as $post)
                <div class="col mb-4">
                    <div class="card h-100">
                        <a href="{{ route('post', [
                            'category' => $post->category->name, 
                            'cat_id' => $post->category_id, 
                            'post_name' => $post->title,  
                            'post_id' => $post->id ]) 
                            }}">
                            <img src="{{ route('get_post_img', ['img' => $post->img]) }}" alt="thumbnail" class="card-img-top"
                                style="width:100%; height: 200px;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection