@extends('layouts.auth-master')
@section('title', 'Sign in to your account')
@section('content')
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
          <input type="email" name="email" class="input  @error('password') is-invalid @enderror"
          placeholder="Email" autocomplete="email" required/>
          @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
          <input type="password" name="password" class="input @error('email') is-invalid @enderror"
          placeholder="Password" autocomplete="new-password" required/>
          @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <button class="submit-btn" type="submit">Log in</button>
        @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}" id="forgot-password">
                {{ __('Forgot Your Password?') }}
            </a>
        @endif
      </div>
    </form>
  </div>
@endsection
