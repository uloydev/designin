<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    @include('partials.stylesheet')
    <title>Desainin - @yield('page-title') | No-fuss graphic design service solutions</title>
  </head>
  <body id="@yield('page-id')Page">
    @yield('header')
    <main>
      @yield('content')
    </main>
    @include('partials.footer')
    @include('partials.script')
    @yield('script')
  </body>
</html>
