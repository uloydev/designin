<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    @include('partials.stylesheet')
    @yield('css')
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@3.1.0/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
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
    @yield('element')
    <script src="https://cdn.jsdelivr.net/npm/froala-editor@3.1.0/js/froala_editor.pkgd.min.js"></script>
  </body>
</html>
