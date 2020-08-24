<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\DB;

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

        return redirect()->route('categories', ['id' => \Auth::user()->id])->with('success', 'done');
    }

    public function delete($cat_id){
        DB::table('posts')->where('category_id', $cat_id)->delete();

        $category = Category::find($cat_id);
        $category->delete();

        

        return redirect()->route('categories', ['id' => \Auth::user()->id])->with('success', 'done');
    }

}