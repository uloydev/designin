<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
      @include('partials.stylesheet')
      <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
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
    @yield('script')
  </body>
</html>
