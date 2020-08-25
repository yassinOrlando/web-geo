<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'name' => ['required','string','max:255']
        ]);

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

    public function cat_edit($id){
        $cat_data = Category::find($id);

        return view('administration/forms_edit/cat_edit', [
            'cat_id' => $cat_data->id,
            'category' => $cat_data
        ]);
    }

    public function update(Request $req){
        $validator = Validator::make($req->all(), [
            'name' => ['required','string','max:255']
        ]);

        $category = Category::find($req->id);
        $category->name = $req->name;
        $category->save();

        return redirect()->route('cat_edit', ['cat_id' => $req->id])->with('success', 'Changes saved');
    }

}