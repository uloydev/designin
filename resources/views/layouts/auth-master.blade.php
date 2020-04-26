<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <title>@yield('title')</title>
  </head>
  <body>
    @yield('content')
    <script>
      const loginBtn = document.getElementById('login');
      const signupBtn = document.getElementById('signup');
      const signupBox = document.querySelector('.signup');

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
