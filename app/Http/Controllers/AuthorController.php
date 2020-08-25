<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
            'total_admins' => $total_admins,
            ]);
    }

    public function delete($user_id){
        $this_user = User::find(\Auth::user()->id);

        if($this_user->role == 'author'){
            return redirect()->route('authors', ['id' => \Auth::user()->id])->with('alert','hello');
        }
        elseif($this_user->id != $user_id && $user_id != 14 ){ //14 is the number of the super admin
            DB::table('posts')->where('user_id', $user_id)->delete();

            $user = User::find($user_id);
            $user->delete();

            return redirect()->route('authors', ['id' => \Auth::user()->id])->with('success', 'done');
        }else{
            return redirect()->route('authors', ['id' => \Auth::user()->id])->with('alert','hello');
        }

    }

    public function author_edit($id){
        $user_to_edit = User::find(\Auth::user()->id);

        if (($user_to_edit->id == $id) || ($user_to_edit->role == 'admin' && $id != 14) ) {
            $author = User::find($id);
            return view('administration/forms_edit/user_edit', [
                'author' => $author,
                'user_role' => $user_to_edit->role
                ]);
        } else {
            return redirect()->route('authors', ['id' => \Auth::user()->id])->with('alert-edit','hello');
        }
        
    }

    public function update(Request $req){
        $validator = Validator::make($req->all(), [
            'role' => ['required','string','max:50'],
            'f_name' => ['required','string','max:100'],
            'last_name' => ['required','string','max:10'],
            'email' => ['required', 'string','email','max:100','unique:users'],
            'img' => ['required','string','max:255'],
        ]);

        $auth = User::find($req->id);
        $auth->role = $req->role;
        $auth->f_name = $req->f_name;
        $auth->last_name = $req->last_name;
        $auth->email = $req->email;
        $auth->img = $req->img;
        $auth->save();

        return redirect()->route('author_edit', ['author_id' => $req->id ])->with('message', 'Changes saved');

    }

    public function search(Request $research){

        $authors = User::where('id', 'like', '%'.$research->input('research').'%')
                ->orWhere('f_name', 'like', '%'.$research->input('research').'%')
                ->orWhere('last_name', 'like', '%'.$research->input('research').'%')
                ->orWhere('role', 'like', '%'.$research->input('research').'%')
                ->orWhere('email', 'like', '%'.$research->input('research').'%')
                ->paginate(1);
        

        return view('administration/search_templates/found_auth', [
            'authors' => $authors,
        ]);

    }

}