<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        @include('partials.stylesheet')
        @yield('css')
        <title>Desainin - @yield('page-title') | No-fuss graphic design service solutions</title>
    </head>
    <body id="@yield('page-id')Page">
        @yield('header')
        <main>
            @yield('content')
        </main>
        @include('partials.footer')
        @yield('script')
        @include('partials.script')
    </body>
</html>
