@extends('layouts.auth-master')
@section('title', 'Create new account')
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
    <form class="signup" method="post" action="{{ route('register') }}">
      @csrf
      <h2 class="form-title" id="signup">
        <a href="{{ route('register') }}"><span>or</span>Sign up</a>
      </h2>
      <div class="form-holder">
        <input type="text" name="name" class="input" placeholder="Name" value="{{ old('name') }}">
        <input type="email" name="email" class="input" placeholder="Email" value="{{ old('email') }}" required>
        <input type="password" name="password" class="input" placeholder="Password" minlength="8" />
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
      </div>
    </form>
  </div>
@endsection
