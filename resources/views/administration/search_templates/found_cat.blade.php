@extends('layouts.dashboard')

@section('title', 'SEARCH CATEGORIES')

@section('content')
<div class="container col-md-12">
    <div class="container">
        <div class="row d-flex justify-content-between">
            <span> Found categories: ({{ count($categories_count) }}) </span>

            <form class="form-inline my-2 my-lg-0 mr-md-2 " action=" {{ route('categories_add', ['id' => Auth::user()->id]) }} " method="POST">
              @csrf
              <label for="name" class="mr-sm-2"> New category: </label>
              <input name="name" class="form-control mr-sm-2" type="text" placeholder="Category name" aria-label="Search">
              <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"> Add </button>
            </form>

            <form class="form-inline my-2 my-lg-0 mr-md-2 " action="{{ route('search_category') }}">
              @csrf
              <input class="form-control mr-sm-2" type="search" name="research" placeholder="Search" aria-label="Search">
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
        @if (count($categories_found) > 0)
            @foreach ($categories_found as $category)
            <tr>
                <th scope="row"> {{ $category->id }} </th>
                <td> {{ $category->name }} </td>
                <td> {{ $category->created_at->format('d/m/Y') }} </td>
                <td> {{ $category->updated_at->format('d/m/Y') }} </td>
                <td class="d-flex justify-content-around" >
                    <a href="{{ route('cat_edit', ['cat_id' => $category->id, 'id' => $category->id ]) }}" >
                      <button class="btn btn-warning  "> Edit </button>
                    </a>
                    <a href="{{ route('category_delete', ['cat_id' => $category->id]) }}" 
                      class="col-sm-12 col-md-5"
                      onclick="
                      return confirm('Are you sure you want to delete this category? \n All related posts will be deleted too!')
                      ">
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
  {{ $categories_found->withQueryString()->links() }}
</div>
@endsection