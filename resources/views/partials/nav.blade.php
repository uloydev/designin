<nav id="primaryNav">
    <div class="container">
        <ul>
            <li class="nav__list nav__list--logo">
                @if (\Request::is('*blog*') or Route::currentRouteName() === 'manage.blog.create')
                    <a class="nav__link" href="{{ route('blog.index') }}">
                        <img alt="Desainin" src="{{ asset('img/logo.png') }}" height="30">
                        <span class="ml-3" style="color: #9e9e9e">Official Blog</span>
                    </a>
                @else
                    <a href="{{ route('landing-page') }}" class="nav__link">Desainin</a>
                @endif
                <i class='bx bx-menu-alt-right nav__toggle'></i>
            </li>
            <li class="nav__list nav__list--search">
                <form action="{{ route('service.search') }}" class="search-service" method="get">
                    @csrf
                    <label class="d-none" for="search-service">Search Service</label>
                    <input type="search" class="search-service__input" name="search_agent_job"
                    placeholder="Find design ..." id="search-service" value="{{ $query ?? '' }}" required>
                    <button class="search-service__btn"><i class='bx bx-search-alt'></i></button>
                </form>
            </li>
            <li class="nav__list ml-lg-auto">
                <a href="{{ route('services') }}" class="nav__link">All Service</a>
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
                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'agent')
                    <li class="nav__list">
                        <a href="{{ route(Auth::user()->role . '.dashboard') }}" class="nav__link">Dashboard</a>
                    </li>
                @else
                    <li class="nav__list nav__list--dropdown">
                        <span class="nav__link">Order menu <i class='bx bxs-chevron-down dropdown-icon'></i></span>
                        <ul class="nav-dropdown-list">
                            <li class="nav__list">
                                <a href="{{ route('user.transaction.index') }}" class="nav__link">my transaction</a>
                            </li>
                            <li class="nav__list">
                                <a href="{{ route('user.subscription.index') }}" class="nav__link">my subscription</a>
                            </li>
{{--                            <li class="nav__list">--}}
{{--                                <a href="{{ route('user.job.index') }}" class="nav__link">my jobs</a>--}}
{{--                            </li>--}}
                            <li class="nav__list">
                                <a href="{{ route('user.order.index') }}" class="nav__link">my order</a>
                            </li>
                        </ul>
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
