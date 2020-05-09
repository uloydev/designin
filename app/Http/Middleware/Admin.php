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
            if (Auth::user()->role == 'admin') {
                return $next($request);
            }
            return redirect()->route(Auth::user()->role . '.dashboard')->with(['error'=>"you don't have permission to access admin page"]);
        }
        return redirect()->route('login');
    }
}
