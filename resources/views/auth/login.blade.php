@extends('layouts.auth-master')
@section('title', 'Sign in to your account')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  <div class="form-structor">
    <form class="signup slide-up" method="post" action="{{ route('register') }}">
      @csrf
      <h2 class="form-title" id="signup">
        <a href="{{ route('register') }}"><span>or</span>Sign up</a>
      </h2>
    </form>
    <form class="login" action="{{ route('login') }}" method="post">
        @csrf
        <div class="center">
            <h2 class="form-title" id="login">
                <a href="{{ route('login') }}"><span>or</span>Log in</a>
            </h2>
            <div class="form-holder">
                <input type="text" name="username" class="input" maxlength="20" placeholder="Your username" required>
                <input type="password" name="password" class="input" minlength="8" placeholder="Password" required>
                @isset($data['redirect'])
                    <input type="hidden" name="redirect" value="{{$data['redirect']}}">
                @endisset
            </div>
            <button class="submit-btn" type="submit">Log in</button>
            <a href="{{ url('/auth/google') }}" class="login-sosmed login-sosmed--google">
                Login with google
            </a>
            <a href="{{ url('/auth/facebook') }}" class="login-sosmed login-sosmed--fb">
                Login with facebook
            </a>
            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}" id="forgot-password">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
        </div>
    </form>
  </div>
@endsection
