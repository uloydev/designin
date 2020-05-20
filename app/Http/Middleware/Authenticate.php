<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Auth;
use Closure;

class Authenticate extends Middleware
{

    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }

    public function handle($request, Closure $next)
    {
        if(Auth::check()){
            if (Auth::user()->role == 'user') {
                return $next($request);
            }elseif(!Auth::user()->email_verified_at){
                return $next($request);
            }
            return redirect()->route(Auth::user()->role . '.dashboard');
        }
        return redirect()->route('login');
    }
}
