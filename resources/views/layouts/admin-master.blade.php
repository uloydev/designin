<!--
=========================================================
Argon Dashboard - v1.2.0
Product Page: https://www.creative-tim.com/product/argon-dashboard
Copyright  Creative Tim (http://www.creative-tim.com) Coded by www.creative-tim.com
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software
=========================================================
-->
<!DOCTYPE html>
<html>
<head>
  @include('partials.meta')
  <title>Desainin Admin - @yield('page-title')</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <link rel="stylesheet" href="{{ asset('plugin/argon-dashboard/assets/vendor/nucleo/css/nucleo.css') }}">
  <link rel="stylesheet" href="{{ asset('plugin/argon-dashboard/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugin/argon-dashboard/assets/css/argon.css') }}">
  <link rel="stylesheet" href="{{ asset('plugin/slick/slick.css') }}"/>
  <link rel="stylesheet" href="{{ asset('plugin/slick/slick-theme.css') }}"/>
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
  <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <img src="{{ asset('img/logo.png') }}" class="navbar-brand-img" alt="Desainin Logo">
        </a>
      </div>
      <div class="navbar-inner">
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link {{ \Request::is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('manage.blog.index') }}">
                      <i class="ni ni-map-big text-primary"></i>
                      <span class="nav-link-text">Blog</span>
                  </a>
              </li>
            <li class="nav-item">
              <a class="nav-link" href="examples/map.html">
                <i class="ni ni-pin-3 text-primary"></i>
                <span class="nav-link-text">Services</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="examples/profile.html">
                <i class="ni ni-single-02 text-yellow"></i>
                <span class="nav-link-text">Promo</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('manage.agent.index') }}">
                <i class="ni ni-bullet-list-67 text-default"></i>
                <span class="nav-link-text">Agent</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <div class="main-content" id="panel">
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
            <div class="form-group mb-0">
              <div class="input-group input-group-alternative input-group-merge">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input class="form-control" placeholder="Search" type="text">
              </div>
            </div>
            <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </form>
          <ul class="navbar-nav align-items-center  ml-md-auto ">
            <li class="nav-item d-xl-none">
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>
            <li class="nav-item d-sm-none">
              <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                <i class="ni ni-zoom-split-in"></i>
              </a>
            </li>
          </ul>
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->name }}
                  <i class="ni ni-bold-down"></i>
              </a>
              <div class="dropdown-menu  dropdown-menu-right ">
                <div class="dropdown-header noti-title">
                  <h6 class="text-overflow m-0">Welcome!</h6>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
                  <i class="ni ni-single-02"></i>
                  <span>My profile</span>
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
              &copy; {{ date('Y') }} <a href="{{ route('landing-page') }}" class="font-weight-bold ml-1" target="_blank">Designin</a>
            </div>
          </div>
          <div class="col-lg-6">
            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
              <li class="nav-item">
                <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="{{ route('manage.blog.index') }}" class="nav-link" target="_blank">Blog</a>
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
  <script src="{{ asset('plugin/argon-dashboard/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('plugin/argon-dashboard/assets/vendor/js-cookie/js.cookie.js') }}"></script>
  <script src="{{ asset('plugin/argon-dashboard/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
  <script src="{{ asset('plugin/argon-dashboard/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
  <script src="{{ asset('plugin/argon-dashboard/assets/vendor/chart.js/dist/Chart.min.js') }}"></script>
  <script src="{{ asset('plugin/argon-dashboard/assets/vendor/chart.js/dist/Chart.extension.js') }}"></script>
  <script src="{{ asset('plugin/argon-dashboard/assets/js/argon.js') }}"></script>
  <script src="{{ asset('plugin/slick/slick.min.js') }}"></script>
  <script src="{{ asset('js/bs-custom-file-input.min.js') }}"></script>
  <script src="{{ asset('js/native.js') }}" charset="utf-8"></script>
</body>
</html>
