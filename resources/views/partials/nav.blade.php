<nav>
  <div class="container">
    <ul>
      <li class="nav__list nav__list--logo">
        <a href="{{ url('/') }}" class="nav__link">
          <img src="{{ asset('img/logo.png') }}">
        </a>
        <i class='bx bx-menu-alt-right nav__toggle'></i>
      </li>
      <li class="nav__list"><a href="{{ route('faq.index') }}" class="nav__link">faq</a></li>
      <li class="nav__list nav__list--separate"><a href="{{ route('blog.index') }}" class="nav__link">blog</a></li>
      @auth
        <li class="nav__list"><a href="" class="nav__link">my transaction</a></li>
        <li class="nav__list"><a href="" class="nav__link">my subscription</a></li>
        <li class="nav__list"><a href="" class="nav__link">my profile</a></li>
      @endauth
      @guest
        <li class="nav__list"><a href="{{ route('login') }}" class="nav__link">Login / Signup</a></li>
      @endguest
    </ul>
  </div>
</nav>
