<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
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
        $total_posts = count(Post::get());
        $posts = Post::orderBy('id', 'desc')
                        ->paginate(4);
        return view('/administration/posts', ['posts' => $posts, 'total_posts' => $total_posts]);
    }

    public function forms_add(){
        $categories = Category::all();
        return view('/administration/forms_add/add_post', [
            'categories' => $categories
            ]);
    }

    public function add(Request $request){
        $post = new Post();
        $post->img = $request->img;
        $post->status = $request->status;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->user_id = $request->user_id; 
        $post->save();

        $total_posts = count(Post::get());
        $posts = Post::orderBy('id', 'desc')
                        ->paginate(4);
        $content = Post::where('id', '=', '13')->get();
        return redirect()->route('posts', ['id' => \Auth::user()->id , 'posts' => $posts, 'total_posts' => $total_posts, 'content' => $content])->with('success', 'done');
    }

    public function delete($post_id){
        $post = Post::find($post_id);
        $post->delete();

        return redirect()->route('posts', ['id' => \Auth::user()->id])->with('success', 'done');
        
    }
}