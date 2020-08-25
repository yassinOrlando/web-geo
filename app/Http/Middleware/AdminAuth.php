<?php

namespace App\Http\Middleware;

use Closure;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //$user = User::find(\Auth::user()->id);

        
        if ($request->user()->role == 'author') {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
