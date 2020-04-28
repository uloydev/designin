<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    @include('partials.stylesheet')
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Desainin - admin | @yield('page-title')</title>
  </head>
  <body>
      @include('partials.nav')
      @include('partials.script')
      <script src="{{ asset('js/bootstrap.bundle.min.js') }}" charset="utf-8"></script>
  </body>
</html>
