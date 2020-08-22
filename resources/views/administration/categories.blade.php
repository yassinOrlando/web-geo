@extends('layouts.dashboard')

@section('title', 'CATEGORIES')

@section('content')
    <div class="container col-md-12">
        <div class="container">
            <div class="row d-flex justify-content-between">
                <span> Total categories: ({{ $total_cats }}) </span>

                <form class="form-inline my-2 my-lg-0 mr-md-2 ">
                    <label for="add" class="mr-sm-2"> New category: </label>
                    <input name="add" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"> Add </button>
                </form>
    
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
                    <th scope="col">Created at</th>
                    <th scope="col">Updated at</th>
                    <th scope="col">Actions</th>
                    
                  </tr>
                </thead>
                <tbody>
                  @foreach ($categories as $category)
                    <tr>
                      <th scope="row"> {{ $category->id }} </th>
                      <td> {{ $category->name }} </td>
                      <td> {{ $category->created_at->format('j F, Y') }} </td>
                      <td> {{ $category->updated_at->format('j F, Y') }} </td>
                      <td class="d-flex justify-content-around" >
                          <button class="btn btn-warning col-sm-12 col-md-5"> Edit </button>
                          <button class="btn btn-danger col-sm-12 col-md-5"> Delete </button>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              
        </div>
        {{ $categories->links() }}
    </div>
@endsection