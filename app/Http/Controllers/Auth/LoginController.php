<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected function redirectTo(Request $request)
    {
        // dd($request);
        if ($request->has('redirect')) {
            return $request->redirect;
        }
        if (Auth::user()->role == 'user') {
            return 'user/order';
        }
        else {
            return Auth::user()->role . '/dashboard';
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(Request $request){
        return view('auth.login', ['data'=> $request->all()]);
    }

    public function login(Request $request)
    {
        $request->validate([
        'email' => 'required',
        'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect($this->redirectTo($request));
        }
        return redirect()->route('login')->with('success', 'Oops! You have entered invalid credentials');
    }
}
