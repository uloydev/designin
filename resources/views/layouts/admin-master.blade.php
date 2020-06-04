<!--
=========================================================
Argon Dashboard - v1.2.0
Product Page: https://www.creative-tim.com/product/argon-dashboard
Copyright  Creative Tim (http://www.creative-tim.com) Coded by www.creative-tim.com
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software
=========================================================
-->
<!DOCTYPE html>
<html lang="en">
    <head>
        @include('partials.meta')
        <title>Desainin {{ in_array('agent' , explode('.', Route::currentRouteName())) ? 'Agent' : 'Admin'}} - @yield('page-title')</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
        <link rel="stylesheet" href="{{ asset('plugin/argon-dashboard/assets/vendor/nucleo/css/nucleo.css') }}">
        <link rel="stylesheet"
        href="{{ asset('plugin/argon-dashboard/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugin/argon-dashboard/assets/css/argon.css') }}">
        <link rel="stylesheet" href="{{ asset('plugin/slick/slick.css') }}"/>
        <link rel="stylesheet" href="{{ asset('plugin/slick/slick-theme.css') }}"/>
        <link rel="stylesheet" href="{{ asset('plugin/nice-select/css/nice-select.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('plugin/bootstrap-range/dist/css/bootstrap-slider.min.css') }}">
        <link href="{{ asset('plugin/air-datepicker/dist/css/datepicker.min.css') }}" rel="stylesheet">
        @yield('css')
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    </head>
    <body id="@yield('page-id')Page">
        <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white"
             id="sidenav-main">
            <div class="scrollbar-inner">
                <div class="sidenav-header  align-items-center">
                    <a class="navbar-brand" href="{{ route(Auth::user()->role . '.dashboard') }}">
                        <img src="{{ asset('img/logo.png') }}" class="navbar-brand-img" alt="Desainin Logo">
                    </a>
                </div>
                <div class="navbar-inner">
                    <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is(Auth::user()->role . '/dashboard') ? 'active' : '' }}"
                                   href="{{ route(Auth::user()->role . '.' .'dashboard') }}">
                                    <i class="ni ni-tv-2 text-primary"></i>
                                    <span class="nav-link-text">Dashboard</span>
                                </a>
                            </li>
                            @if (Auth::user()->role == 'admin')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('manage.blog.index') }}">
                                        <i class="ni ni-map-big text-primary"></i>
                                        <span class="nav-link-text">Blog</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('manage.agent.index') }}">
                                        <i class="ni ni-bullet-list-67 text-default"></i>
                                        <span class="nav-link-text">Agent</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('manage.service.index') }}">
                                        <i class="ni ni-pin-3 text-primary"></i>
                                        <span class="nav-link-text">Services</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('manage.promo.index') }}">
                                        <i class="fas fa-tags text-default"></i>
                                        <span class="nav-link-text">Promo</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('manage.subscription.index') }}">
                                        <i class="far fa-newspaper text-success"></i>
                                        <span class="nav-link-text">Subscription</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('manage.contact-us.index') }}">
                                        <i class="fas fa-envelope text-gray"></i>
                                        <span class="nav-link-text">Message From Customer</span>
                                    </a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="#navbar-components" data-toggle="collapse"
                                       role="button" aria-expanded="false" aria-controls="navbar-components">
                                        <i class="ni ni-ui-04 text-info"></i>
                                        <span class="nav-link-text">Feed</span>
                                    </a>
                                    <div class="collapse" id="navbar-components">
                                        <ul class="nav nav-sm flex-column">
                                            <li class="nav-item">
                                                <a href="{{ route('agent.service.index') }}" class="nav-link">
                                                    <span class="sidenav-normal"> My Service </span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('agent.list-request.index') }}"
                                                class="nav-link {{ \Request::is('agent/list-request*') ? 'active' : '' }}">
                                                    <span class="sidenav-normal"> My Job </span>
                                                </a>
                                            </li>
                                            {{--
                                            <li class="nav-item">
                                                <a href="{{ route('agent.bid-history') }}" class="nav-link">
                                                    <span class="sidenav-normal"> Bid History </span>
                                                </a>
                                            </li>
                                            --}}
                                        </ul>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('agent.profile.index') }}"
                                    class="nav-link {{ Request::is('agent/profile*') ? 'active' : '' }}">
                                        <i class="ni ni-single-02 text-yellow"></i>
                                        <span class="nav-link-text">Profile</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="main-content" id="panel">
            <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="navbar-nav align-items-center">
                            <h1 class="text-white h2 mb-0">@yield('page-name')</h1>
                        </div>
                        <ul class="navbar-nav align-items-center ml-md-auto ml-3">
                            <li class="nav-item d-xl-none">
                                <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin"
                                     data-target="#sidenav-main">
                                    <div class="sidenav-toggler-inner">
                                        <i class="sidenav-toggler-line"></i>
                                        <i class="sidenav-toggler-line"></i>
                                        <i class="sidenav-toggler-line"></i>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul class="navbar-nav align-items-center  ml-auto ml-md-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }} <i class="ni ni-bold-down"></i>
                                </a>
                                <div class="dropdown-menu  dropdown-menu-right">
                                    <div class="dropdown-header">
                                        <h6 class="text-overflow m-0">Welcome!</h6>
                                    </div>
                                    <a href="{{ route('admin.setting') }}" class="dropdown-item">
                                        <i class="ni ni-single-02"></i>
                                        <span>Setting</span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="{{ route('logout') }}" class="dropdown-item"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        <i class="ni ni-user-run"></i>
                                        <span>Logout</span>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="header bg-primary pt-4 pb-6">
                <div class="container-fluid">
                    <div class="header-body">@yield('header')</div>
                </div>
            </div>
            <div class="container-fluid mt--6">
                @yield('content')
                <footer class="footer pt-0">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-6">
                            <div class="copyright text-center  text-lg-left  text-muted">
                                <span id="footer_date"></span>
                                <a href="{{ route('landing-page') }}" class="font-weight-bold ml-1" target="_blank">
                                    Desainin
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com" class="nav-link" target="_blank">
                                        Creative Tim
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('blog.index') }}" class="nav-link" target="_blank">Blog</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md"
                                    class="nav-link" target="_blank">MIT License</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        @yield('element')
        <script src="{{ asset('plugin/argon-dashboard/assets/vendor/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('plugin/argon-dashboard/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}">
        </script>
        <script src="{{ asset('plugin/argon-dashboard/assets/vendor/js-cookie/js.cookie.js') }}"></script>
        <script src="{{ asset('plugin/argon-dashboard/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}">
        </script>
        <script src="{{ asset('plugin/argon-dashboard/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}">
        </script>
        <script src="{{ asset('plugin/argon-dashboard/assets/vendor/chart.js/dist/Chart.min.js') }}"></script>
        <script src="{{ asset('plugin/argon-dashboard/assets/vendor/chart.js/dist/Chart.extension.js') }}"></script>
        <script src="{{ asset('plugin/argon-dashboard/assets/js/argon.js') }}"></script>
        <script src="{{ asset('plugin/slick/slick.min.js') }}"></script>
        <script src="{{ asset('js/bs-custom-file-input.min.js') }}"></script>
        <script src="{{ asset('js/typed.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.js"></script>
        <script src="{{ asset('plugin/nice-select/js/jquery.nice-select.min.js') }}"></script>
        <script src="{{ asset('plugin/jquery-star-rating-plugin/src/jquery.star.rating.min.js') }}"></script>
        <script src="{{ asset('plugin/bootstrap-range/dist/bootstrap-slider.min.js') }}"></script>
        <script src="{{ asset('plugin/air-datepicker/dist/js/datepicker.min.js') }}"></script>
        <script src="{{ asset('plugin/air-datepicker/dist/js/i18n/datepicker.en.js') }}"></script>
        @stack('script')
        <script src="{{ asset('js/native.js') }}" charset="utf-8"></script>
    </body>
</html>
