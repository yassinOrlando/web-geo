@extends('layouts.dashboard')

@section('title', 'POSTS')

@section('content')
<div class="container col-md-12">
  <div class="container">
    <div class="row d-flex justify-content-between">
      <a href="{{ route('post_form_create', ['id' => Auth::user()->id]) }}">
        <button class="btn btn-primary "> New post </button>
      </a>

      <span class="align-baseline "> Total posts: ({{ $total_posts }}) </span>

      <form class="form-inline my-2 my-lg-0 mr-md-2 ">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
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
        @if (Auth::user()->role == 'admin')
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
        @else
          @if ($personal_posts)
            @foreach ($posts as $post)
              @if (Auth::user()->id == $post->user_id)
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
              @endif
            @endforeach
          @else
              <tr>
                <td> {{ 'You do not have posts' }} </td>
              </tr>
          @endif
          
        @endif

      </tbody>
    </table>

  </div>
  {{ $posts->links() }}
</div>
@endsection