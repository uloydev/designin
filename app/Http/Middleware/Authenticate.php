<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Auth;
use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\URL;

class Authenticate extends Middleware
{

    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login', ['redirect'=>$request]);
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
        return redirect('login?redirect='.URL::current());
    }
}
