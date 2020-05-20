<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Auth;
use Closure;
use Illuminate\Support\Facades\URL;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
    if (! $request->expectsJson()) {
        return route('login', [
            'redirect'=>$request
            ]);
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
