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
          <input type="email" name="email" class="input" placeholder="Email" autocomplete="email" required/>
          <input type="password" name="password" class="input" minlength="8" placeholder="Password"
          autocomplete="new-password" required/>
          @isset($data['redirect'])
          <input type="hidden" name="redirect" value="{{$data['redirect']}}">
          @endisset
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
