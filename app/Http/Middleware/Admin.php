<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin
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
        if (Auth::check()){
            if (Auth::user()->is_admin != 1) {
                return redirect()->route('user.home')->with(['error'=>"you don't have permission to access admin page"]);
            }
            return $next($request);
        }
        return redirect()->route('login');
    }
}
