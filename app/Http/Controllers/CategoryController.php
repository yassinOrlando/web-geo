<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total_cats = count(Category::get());
        $categories = Category::orderby('id', 'desc')
                        ->paginate(1);
        return view('/administration/categories', ['categories' => $categories, 'total_cats' => $total_cats]);
    }

    public function add(Request $request)
    {
        $category = new Category;
        $category->name = $request->name;
        $category->save();

        $total_cats = count(Category::get());
        $categories = Category::orderby('id', 'desc')
                        ->paginate(1);
        return view('/administration/categories', ['categories' => $categories, 'total_cats' => $total_cats]);
    }
}