<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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

        $personal_posts = count(Post::where('user_id', '=', \Auth::user()->id)->get());
        return view('/administration/posts', [
            'posts' => $posts, 
            'total_posts' => $total_posts,
            'personal_posts' => $personal_posts
            ]);
    }

    public function forms_add(){

        $categories = Category::all();
        return view('/administration/forms_add/add_post', [
            'categories' => $categories
            ]);
    }

    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => ['required','string','max:255']
        ]);

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
        $user = User::find(\Auth::user()->id);
        $post = Post::find($post_id);
        if ($post->user_id == $user->id || $user->role == 'admin') {
            $post->delete();

            return redirect()->route('posts', ['id' => \Auth::user()->id])->with('success', 'done');
        } else {
            return redirect()->route('posts', ['id' => \Auth::user()->id ])->with('alert-delete-post', 'You cant');
        }
    }

    public function form_edit($id){
        $user = User::find(\Auth::user()->id);
        $post = Post::find($id);
        if ($post->user_id == $user->id || $user->role == 'admin') {
            $categories = Category::all();
            $post_data = Post::find($id);

            return view('administration/forms_edit/post_edit', [
                'categories' => $categories,
                'post' => $post_data
            ]);
        } else {
            return redirect()->route('posts', ['id' => \Auth::user()->id ])->with('alert-edit', 'You cant');
        }
    }

    public function update(Request $req){
        $validator = Validator::make($req->all(), [
            'title' => ['required','string','max:255']
        ]);

        $post = Post::find($req->id);
        $post->status = $req->status;
        $post->category_id = $req->category_id;
        $post->img = $req->img;
        $post->title = $req->title;
        $post->content = $req->content;
        $post->save();

        return redirect()->route('post_edit', ['post_id' => $req->id ])->with('message', 'Changes saved');
    }

    public function search(Request $research){

        $posts = Post::where('id', 'like', '%'.$research->input('research').'%')
                ->orWhere('title', 'like', '%'.$research->input('research').'%')
                ->orWhere('status', 'like', '%'.$research->input('research').'%')
                /*->orWhere(function($query){
                    $query->whereColumn('user_id', 'like', '%'.$research->input('research').'%');
                })
                ->orWhere(function($query){
                    $query->whereColumn('category_id', 'like', '%'.$research->input('research').'%');
                })*/
                ->orWhere('created_at', 'like', '%'.$research->input('research').'%')
                ->orWhere('updated_at', 'like', '%'.$research->input('research').'%')
                ->paginate(1);
        
        $post_for_author = 0;

        return view('administration/search_templates/found_posts', [
            'posts' => $posts,
            'post_for_author' => $post_for_author,
        ]);

    }

}