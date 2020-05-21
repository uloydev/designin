<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Agent
{

    public function handle($request, Closure $next)
    {
        if (Auth::check()){
            if (Auth::user()->role == 'agent') {
                return $next($request);
            }
            else {
              return redirect()->route(Auth::user()->role . '.dashboard')->with(['error'=>"you don't have permission to access agent page"]);
            }
        }
        else {
          return redirect()->route('login');
        }
    }
}
