@extends('layouts.auth-master')
@section('title', 'Create new account')
@section('content')
  <div class="form-structor">
    <form class="signup" method="post" action="{{ route('register') }}">
      @csrf
      <h2 class="form-title" id="signup"><span>or</span>Sign up</h2>
      <div class="form-holder">
        <input type="text" name="name" class="input @error('name') is-invalid @enderror" placeholder="Name" value="{{ old('name') }}">
        @error('name')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
        <input type="email" name="email" class="input @error('email') is-invalid @enderror" placeholder="Email"
        value="{{ old('email') }}" required>
        @error('email')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
        <input type="password" name="password" class="input @error('password') is-invalid @enderror" placeholder="Password" />
        @error('password')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
        <input type="password" class="input" placeholder="Password Confirmation"
        name="password_confirmation" required autocomplete="new-password">
      </div>
      <button class="submit-btn" type="submit">Sign up</button>
    </form>
    <form class="login slide-up" action="{{ route('login') }}" method="post">
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
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        @endif
      </div>
    </form>
  </div>
@endsection
