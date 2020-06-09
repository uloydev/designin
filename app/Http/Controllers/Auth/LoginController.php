<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\UserProfile;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Laravel\Socialite\Facades\Socialite;

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
            'username' => 'bail|required|alpha_dash|unique:users',
            'password' => 'bail|required|max:12|min:8',
        ]);

        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect($this->redirectTo($request));
        }
        return redirect()->route('login')->with('success', 'Oops! You have entered invalid credentials');
    }

    public function username()
    {
        return 'username';
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $authUser = User::firstOrCreate(
            ['email' => $user->getEmail()],
            [
                'name' => $user->name,
                'provider' => $provider,
                'provider_id' => $user->id,
                'email_verified_at' => Carbon::now()
            ]
        );
        UserProfile::create([
            'avatar' => 'files/people.webp',
            'user_id' => $authUser->id
        ]);

        Auth::login($authUser);
        if (Auth::user()->email_verified_at == '') {
            return redirect('email/verify');
        }
        else {
            return redirect('/');
        }
    }

}
