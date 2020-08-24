<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AuthorController extends Controller
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
        $total_auths = count(
            User::where('role', '=', 'author')->get()
        );
        $total_admins = count(
            User::where('role', '=', 'admin')->get()
        );
        $authors = User::orderby('id', 'desc')
                        ->paginate(4);

        return view('/administration/authors', [
            'authors' => $authors, 
            'total_auths' => $total_auths,
            'total_admins' => $total_admins
            ]);
    }

    public function delete($user_id){
        $this_user = \Auth::user()->id;

        if($this_user != $user_id && $user_id != 14 ){ //14 is the number of the super admin
            DB::table('posts')->where('user_id', $user_id)->delete();

            $user = User::find($user_id);
            $user->delete();

            return redirect()->route('authors', ['id' => \Auth::user()->id])->with('success', 'done');
        }else{
            Log::alert('You cant delete this user');
            return redirect()->route('authors', ['id' => \Auth::user()->id])->with('alert','hello');
        }

    }

    public function author_edit($id){
        $author = User::find($id);
        

        return view('administration/forms_edit/user_edit', ['author' => $author]);
    }
}