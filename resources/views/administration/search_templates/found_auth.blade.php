@extends('layouts.dashboard')

@section('title', 'SEARCH AUTHOR')

@section('content')
<div class="container col-md-12">
  <div class="container">
    <div class="row d-flex justify-content-between">
      <a href="{{ route('post_form_create', ['id' => Auth::user()->id]) }}">
        <button class="btn btn-primary "> New post </button>
      </a>

      <span class="align-baseline ">  Posts found: ({{ count($authors) }}) </span>

      <form class="form-inline my-2 my-lg-0 mr-md-2 " action="{{ route('search_author') }}">
        @csrf
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
        @if (count($authors))
            @foreach ($authors as $author)
                <tr>
                <th scope="row"> {{ $author->id }} </th>
                <td> {{ $author->f_name }} </td>
                <td> {{ $author->last_name }} </td>
                <td> {{ $author->role }} </td>
                <td> {{ $author->email }} </td>
                <td> {{ $author->created_at->format('j F, Y') }} </td>
                <td> {{ $author->updated_at->format('j F, Y') }} </td>
                <td class="d-flex justify-content-around" >
                    <a href="{{ route('author_edit', ['author_id' => $author->id, 'id' => $author->id ]) }}" >
                        <button class="btn btn-warning  "> Edit </button>
                    </a>
                    <a href="{{ route('author_delete', ['auth_id' => $author->id]) }}"
                        onclick="return confirm('Are you sure you want to delete this user? \n All related posts will be deleted too!')"
                        >
                        <button class="btn btn-danger "> Delete </button>
                    </a>
                </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td> Nothing found </td>
            </tr> 
        @endif

      </tbody>
    </table>

  </div>
  {{ $authors->links() }}
</div>
@endsection