<nav id="primaryNav">
    <div class="container">
        <ul>
            <li class="nav__list nav__list--logo">
                @if (\Request::is('blog*'))
                    <a class="nav__link" href="{{ route('landing-page') }}">
                        <img alt="Desainin" src="{{ asset('img/logo.png') }}">
                    </a>
                @else
                    <a href="{{ route('landing-page') }}" class="nav__link">Desainin</a>
                @endif
                <i class='bx bx-menu-alt-right nav__toggle'></i>
            </li>
            <li class="nav__list">
                <a href="{{ route('contact-us.index') }}" class="nav__link">Contact us</a>
            </li>
            <li class="nav__list">
                <a href="{{ route('faq.index') }}" class="nav__link">faq</a>
            </li>
            <li class="nav__list nav__list--separate">
                <a href="{{ route('blog.index') }}" class="nav__link">Blog</a>
            </li>
            @auth
                @if (Auth::user()->role == 'admin')
                    <li class="nav__list">
                        <a href="{{ route('admin.dashboard') }}" class="nav__link">Dashboard</a>
                    </li>
                @else
                    <li class="nav__list">
                        <a href="" class="nav__link">my profile</a>
                    </li>
                    <li class="nav__list">
                        <a href="" class="nav__link">my transaction</a>
                    </li>
                    <li class="nav__list">
                        <a href="" class="nav__link">my subscription</a>
                    </li>
                @endif
                <li class="nav__list">
                    <a class="nav__link" href="javascript:void(0);"
                       onclick="document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endauth
            @guest
                <li class="nav__list">
                    <a href="{{ route('login') }}" class="nav__link">{{ __('Login / Sign up') }}</a>
                </li>
            @endguest
        </ul>
    </div>
</nav>
