<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

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
        $my_posts = Post::where('user_id', '=', \Auth::user()->id)
                ->orderBy('id', 'desc')
                ->paginate(1);
        return view('/administration/posts', [
            'posts' => $posts, 
            'total_posts' => $total_posts,
            'personal_posts' => $personal_posts,
            'my_posts' => $my_posts,
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
            'img' => ['required', 'image'],
            'title' => ['required','string','max:255'],
        ]);

        $post_img = $request->file('img');

        $post = new Post();
        $post->status = $request->status;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->user_id = $request->user_id; 

        if($post_img){
            $post_img_name = time().$post_img->getClientOriginalName();
            Storage::disk('images')->put($post_img_name, File::get($post_img));
            $post->img = $post_img_name; 
        }

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
            'title' => ['required','string','max:255'],
            'img' => ['img'],
        ]);

        $post = Post::find($req->id);
        $post->status = $req->status;
        $post->category_id = $req->category_id;
        $post->title = $req->title;
        $post->content = $req->content;

        $post_img = $req->img;

        if($post_img){
            $post_img_name = time().$post_img->getClientOriginalName();
            Storage::disk('images')->put($post_img_name, File::get($post_img));
            $post->img = $post_img_name; 
        }

        $post->save();

        return redirect()->route('post_edit', ['post_id' => $req->id ])->with('message', 'Changes saved');
    }

    public function search(Request $research){

        $posts = DB::table('posts')
                ->leftjoin('users', 'posts.user_id', '=', 'users.id')
                ->leftjoin('categories', 'posts.category_id', '=', 'categories.id')
                ->where('posts.id', 'like', '%'.$research->input('research').'%')
                ->orWhere('title', 'like', '%'.$research->input('research').'%')
                ->orWhere('status', 'like', '%'.$research->input('research').'%')
                ->orWhere('users.f_name', 'like', '%'.$research->input('research').'%')
                ->orWhere('categories.name', 'like', '%'.$research->input('research').'%')
                ->orWhere('posts.created_at', 'like', '%'.$research->input('research').'%')
                ->orWhere('posts.updated_at', 'like', '%'.$research->input('research').'%')
                ->select('posts.*', 'users.f_name', 'categories.name')
                ->paginate(1);

        $posts_count = DB::table('posts')
                ->leftjoin('users', 'posts.user_id', '=', 'users.id')
                ->leftjoin('categories', 'posts.category_id', '=', 'categories.id')
                ->where('posts.id', 'like', '%'.$research->input('research').'%')
                ->orWhere('title', 'like', '%'.$research->input('research').'%')
                ->orWhere('status', 'like', '%'.$research->input('research').'%')
                ->orWhere('users.f_name', 'like', '%'.$research->input('research').'%')
                ->orWhere('categories.name', 'like', '%'.$research->input('research').'%')
                ->orWhere('posts.created_at', 'like', '%'.$research->input('research').'%')
                ->orWhere('posts.updated_at', 'like', '%'.$research->input('research').'%')
                ->select('posts.*', 'users.f_name', 'categories.name')
                ->get();

        $post_for_author = 0;

        
        return view('administration/search_templates/found_posts', [
            'posts' => $posts,
            'posts_count' => $posts_count,
            'post_for_author' => $post_for_author,
        ]);

    }

    /*public function getImage($image_name){
        if(\Auth::check() || !\Auth::check()) {
            $image = Storage::disk('images')->get($image_name);
            return new Response($image, 200);
        }
    }*/

}