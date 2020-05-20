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

<<<<<<< HEAD
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo(Request $request)
=======
    protected function redirectTo()
>>>>>>> 8b1108b33ec8e3e927a2542f92256a52577d6336
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
        return Redirect::to("login")->withSuccess('Oppes! You have entered invalid credentials');
    }
}
