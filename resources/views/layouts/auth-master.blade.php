<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
      @include('partials.meta')
      <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
      <title>@yield('title')</title>
  </head>
  <body>
    @yield('content')
    <script>
      const loginBtn = document.getElementById('login');
      const signupBtn = document.getElementById('signup');
      const signupBox = document.querySelector('.signup');
      const inputUsername = document.querySelector("input[name='username']");
      inputUsername.onkeypress = function(e) {
          let  key = e.keyCode;
          return (key !== 32);
      };

      loginBtn.addEventListener('click', (e) => {
      let parent = e.target.parentNode.parentNode;
      Array.from(e.target.parentNode.parentNode.classList).find((element) => {
        if(element !== "slide-up") {
          parent.classList.add('slide-up')
        }else{
          signupBtn.parentNode.classList.add('slide-up')
          parent.classList.remove('slide-up')
        }
      });
      });
      signupBtn.addEventListener('click', (e) => {
      let parent = e.target.parentNode;
      Array.from(e.target.parentNode.classList).find((element) => {
        if(element !== "slide-up") {
          parent.classList.add('slide-up')
        }else{
          loginBtn.parentNode.parentNode.classList.add('slide-up')
          parent.classList.remove('slide-up')
        }
      });
      });
    </script>
  </body>
</html>
