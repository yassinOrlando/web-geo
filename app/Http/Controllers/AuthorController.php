<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
}