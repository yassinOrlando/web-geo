@extends('layouts.dashboard')

@section('title', 'SEARCH AUTHOR')

@section('content')
<div class="container col-md-12">
  <div class="container">
    <div class="row d-flex justify-content-between">
      @if (Auth::user()->role == 'admin')
        <a class="text-white" href="{{ url('/register') }}">
            <button class="btn btn-primary">  New author </button>
        </a> 
      @endif
        <span> Users found: ({{ count($authors_count) }}) </span>

        <form class="form-inline my-2 my-lg-0 mr-md-2 " action="{{ route('search_author') }}">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" name="research" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</div>

  <div style="overflow: scroll">
    <table class="table col-md-12" style="margin-top: 15px; overflow: scroll">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Profile</th>
                    <th scope="col" class="col-2">Name</th>
                    <th scope="col" class="col-2">Last name</th>
                    <th scope="col">Role</th>
                    <th scope="col">Email</th>
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
                <td>
                  @if (Auth::user()->img)
                          <img src="{{ route('get_avatar', ['img' => $author->img]) }}" 
                            alt="profile_pic" 
                            class="mx-auto d-block"
                            style="width: 40px; height: 40px; border-radius: 50px;">
                        @endif
                </td>
                <td> {{ $author->f_name }} </td>
                <td> {{ $author->last_name }} </td>
                <td> {{ $author->role }} </td>
                <td> {{ $author->email }} </td>
                <td> {{ $author->created_at->format('d/m/Y') }} </td>
                <td> {{ $author->updated_at->format('d/m/Y') }} </td>
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
  {{ $authors->withQueryString()->links() }}
</div>
@endsection