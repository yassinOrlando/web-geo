@extends('layouts.dashboard')

@section('title', 'AUTHORS')

@section('content')
    <div class="container col-md-12">
        <div class="container">
            <div class="row d-flex justify-content-between">
                <a class="text-white" href="{{ url('/register') }}">
                    <button class="btn btn-primary">  New author </button>
                </a> 

                <span> Total admins: ({{ $total_admins }}) </span>
                <span> Total authors: ({{ $total_auths }}) </span>
    
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
                    <th scope="col" class="col-2">Name</th>
                    <th scope="col" class="col-2">Last name</th>
                    <th scope="col">Role</th>
                    <th scope="col">Email</th>
                    <th scope="col">Actions</th>
                    
                  </tr>
                </thead>
                <tbody>
                  @foreach ($authors as $author)
                    <tr>
                      <th scope="row"> {{ $author->id }} </th>
                      <td> {{ $author->f_name }} </td>
                      <td> {{ $author->last_name }} </td>
                      <td> {{ $author->role }} </td>
                      <td> {{ $author->email }} </td>
                      <td class="d-flex justify-content-around" >
                          <button class="btn btn-warning col-sm-12 col-md-5"> Edit </button>
                          <button class="btn btn-danger col-sm-12 col-md-5"> Delete </button>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              {{ $authors->links() }}
        </div>
        
    </div>
@endsection