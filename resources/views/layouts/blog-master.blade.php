<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    @include('partials.stylesheet')
    @yield('css')
      <link href="{{ asset('plugin/nice-select/css/nice-select.css') }}" rel="stylesheet" />
      <link href="{{ asset("css/froala-editor.pkgd.css") }}" rel="stylesheet" type="text/css" />
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
    @yield('element')
    @yield('script')
    <script src="{{ asset('js/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset("js/froala-editor.pkgd.min.js") }}"></script>
    <script src="{{ asset('plugin/nice-select/js/jquery.nice-select.js') }}"></script>
  </body>
</html>
