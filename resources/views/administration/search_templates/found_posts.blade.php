@extends('layouts.dashboard')

@section('title', 'SEARCH POSTS')

@section('content')
<div class="container col-md-12">
  <div class="container">
    <div class="row d-flex justify-content-between">
      <a href="{{ route('post_form_create', ['id' => Auth::user()->id]) }}">
        <button class="btn btn-primary "> New post </button>
      </a>

      <span class="align-baseline ">  Posts found: ({{ count($posts) }}) </span>

      <form class="form-inline my-2 my-lg-0 mr-md-2 " action="{{ route('search_post') }}">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="research">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </div>

  <div style="overflow: scroll">
    <table class="table col-md-12" style="margin-top: 15px; overflow: scroll">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col" class="col-3">Title</th>
          <th scope="col">Status</th>
          <th scope="col">Category</th>
          <th scope="col">Author</th>
          <th scope="col">Created at</th>
          <th scope="col">Updated at</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        @if (Auth::user()->role == 'admin' && count($posts))
          @foreach ($posts as $post)
          <tr>
            <th scope="row"> {{ $post->id }} </th>
            <td> {{ $post->title }} </td>
            <td> {{ $post->status }} </td>
            <td> {{ $post->category->name }} </td>
            <td> {{ $post->user->f_name }} </td>
            <td> {{ $post->created_at->format('j F, Y') }} </td>
            <td> {{ $post->updated_at->format('j F, Y') }} </td>
            <td class="d-flex justify-content-around">
              <a href="{{ route('post_edit', ['post_id' => $post->id, 'id' => $post->id ]) }}">
                <button class="btn btn-warning  "> Edit </button>
              </a>
              <a href="{{ route('post_delete', ['post_id' => $post->id ]) }}"
                onclick="return confirm('Are you sure you want to delete this post?')">
                <button class="btn btn-danger "> Delete </button>
              </a>
            </td>
          </tr>
          @endforeach
        @elseif(Auth::user()->role == 'author' && count($posts) > 0 )
            @foreach ($posts as $post)
                @if ($post->user_id == Auth::user()->id)
                <tr>
                    <th scope="row"> {{ $post->id }} </th>
                    <td> {{ $post->title }} </td>
                    <td> {{ $post->status }} </td>
                    <td> {{ $post->category->name }} </td>
                    <td> {{ $post->user->f_name }} </td>
                    <td> {{ $post->created_at->format('j F, Y') }} </td>
                    <td> {{ $post->updated_at->format('j F, Y') }} </td>
                    <td class="d-flex justify-content-around">
                        <a href="{{ route('post_edit', ['post_id' => $post->id, 'id' => $post->id ]) }}">
                        <button class="btn btn-warning  "> Edit </button>
                        </a>
                        <a href="{{ route('post_delete', ['post_id' => $post->id ]) }}"
                        onclick="return confirm('Are you sure you want to delete this post?')">
                        <button class="btn btn-danger "> Delete </button>
                        </a>
                    </td>
                </tr>
                <div hidden> {{ $post_for_author++ }} </div> 
                @endif
            @endforeach
            @if ($post_for_author == 0)
                <tr>
                    <td> Nothing found for you </td>
                </tr> 
            @endif
        @else
            <tr>
                <td> Nothing found </td>
            </tr> 
        @endif

      </tbody>
    </table>

  </div>
  {{ $posts->links() }}
</div>
@endsection