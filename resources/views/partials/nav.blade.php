<nav>
  <div class="container">
    <ul>
      <li class="nav__list nav__list--logo">
        @if (\Request::is('blog*'))
          <a href="" class="nav__link">
            <img src="{{ asset('img/logo.png') }}">
          </a>
        @else
          <a href="{{ url('/') }}" class="nav__link">Desainin</a>
        @endif
        <i class='bx bx-menu-alt-right nav__toggle'></i>
      </li>
      <li class="nav__list"><a href="{{ route('contact-us.index') }}" class="nav__link">Contact us</a></li>
      <li class="nav__list"><a href="{{ route('faq.index') }}" class="nav__link">faq</a></li>
      @auth
        @if (Auth::user()->role == 'admin')
          <li class="nav__list nav__list--separate nav__list--dropdown">
            <span class="nav__link">blog <i class='bx bxs-chevron-down dropdown-icon'></i></span>
            <ul class="nav-dropdown-list">
              <li class="nav__list nav-dropdown-list__item"><a href="{{ route('manage.blog.index') }}" class="nav__link">home</a></li>
              <li class="nav__list nav-dropdown-list__item pb-0"><a href="{{ route('manage.blog.create') }}" class="nav__link">create</a></li>
            </ul>
          </li>
        @endif
        <li class="nav__list"><a href="" class="nav__link">my transaction</a></li>
        <li class="nav__list"><a href="" class="nav__link">my subscription</a></li>
        <li class="nav__list"><a href="" class="nav__link">my profile</a></li>
        <li class="nav__list">
          <a class="nav__link" href="{{ route('logout') }}"
             onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </li>
      @endauth
      @guest
        <li class="nav__list nav__list--separate"><a href="{{ route('blog.index') }}" class="nav__link">Blog</a></li>
        <li class="nav__list"><a href="{{ route('login') }}" class="nav__link">Login / Signup</a></li>
      @endguest
    </ul>
  </div>
</nav>
