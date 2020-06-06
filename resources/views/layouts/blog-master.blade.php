<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
      @include('partials.stylesheet')
      @yield('css')
      <title>Blog - Desainin | @yield('page-title')</title>
  </head>
  <body id="@yield('page-id')Page">
    @include('partials.nav')
    @yield('header')
    <main>
      @yield('content')
    </main>
    @include('partials.footer')
    @yield('element')
    @include('partials.script')
    @stack('script')
    <div class="overlay overlay--nav-showed"></div>
  </body>
</html>
