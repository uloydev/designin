<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
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
    @include('partials.script')
    @yield('script')
  </body>
</html>
