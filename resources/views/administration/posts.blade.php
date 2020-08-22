@extends('layouts.dashboard')

@section('title', 'POSTS')

@section('content')
    <div class="container col-md-12">
        <div class="container">
            <div class="row d-flex justify-content-between">
                <button class="btn btn-primary "> New post </button>
    
                <span class="align-baseline "> Total posts: ({{ count($posts) }}) </span>
    
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
                  @foreach ($posts as $post)
                    <tr>
                      <th scope="row"> {{ $post->id }} </th>
                      <td> {{ $post->title }} </td>
                      <td> {{ $post->status }} </td>
                      <td> {{ $post->category->name }} </td>
                      <td> {{ $post->user->f_name }} </td>
                      <td> {{ $post->created_at->format('j F, Y') }} </td>
                      <td> {{ $post->updated_at->format('j F, Y') }} </td>
                      <td class="d-flex justify-content-around" >
                          <button class="btn btn-warning  "> Edit </button>
                          <button class="btn btn-danger "> Delete </button>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              {{ $posts->links() }}
        </div>
        
    </div>
@endsection