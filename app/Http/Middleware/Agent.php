<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Agent
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
            if (Auth::user()->role == 'agent') {
                return $next($request);
            }
            return redirect()->route(Auth::user()->role . '.home')->with(['error'=>"you don't have permission to access agent page"]);
        }
        return redirect()->route('login');
    }
}