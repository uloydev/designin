<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
{{--     <meta name="keywords" content="@foreach ($keywords as $keyword) {{ $keyword->value }} @endforeach"> --}}
    @include('partials.stylesheet')
    <title>Desainin | No-fuss graphic design service solutions</title>
  </head>
  <body id="landingPage">
    <header>
      @include('partials.nav')
      <div class="container">
          <div class="row flex-column align-items-end mx-0">
              <h1 class="header__text">
                  Find designer just like <br class="d-none d-md-block"> <span style="color: #94E5EB"></span>
              </h1>
          </div>
          <div class="row mx-0 flex-column flex-md-row align-items-center justify-content-end">
              <a href="javascript:void(0)" class="header__btn header__btn--secondary btn-modal"
                 data-target="#modal-search-service">
                  <i class='bx bx-search-alt mr-2 bx-sm'></i> Find your designer
              </a>
              <a href="#services" class="header__btn">
                  Order What You Want <i class='bx bxs-cart-add ml-2 bx-sm'></i>
              </a>
          </div>
      </div>
    </header>
    <main>
      <section id="services">
        <div class="container">
          <h1 class="section__heading">our service</h1>
          <div class="row">
            @foreach ($serviceCategories as $category)
            <div class="px-3">
                <img src="{{ Storage::url($category->image_url) }}" class="services__icon" alt="Our service">
                <p class="services__name">{{ $category->name }}</p>
                <a href="{{ route('services') . '#' . Str::slug($category->name, '-') }}"
                   class="services__btn btn-light">
                    See all available service
                </a>
            </div>
            @endforeach
          </div>
        </div>
      </section>
      <section id="reasons">
        <div class="container">
          <h1 class="section__heading">Why you should trust <strong>Desainin</strong></h1>
          <div class="row">
            <div class="col-12 col-md-5 col-lg-6 reason-trust">
              <a href="javascript:void(0);" class="reason-trust__btn"><i class='bx bx-play'></i></a>
              <img src="{{ asset('img/how-we-work.png') }}" width="100%" alt="How desainin work">
              <div class="reason-trust__overlay">
                <div class="reason-trust__modal">
                    <a href="" class="reason-trust__close-btn"><i class='bx bx-x' ></i></a>
                    <iframe class="reason-trust__video embed-video"
                            src="https://www.youtube.com/embed/xpQLFH5OCEY??enablejsapi=1&start=0" frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-7 col-lg-6 reason-slider">
              {{-- foreach --}}
              <div class="reason-slider__item">
                <p class="reason-slider__title">Reason 1</p>
                <p class="reason-slider__desc">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore
                    magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                    nulla pariatur.
                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id
                    est laborum.
                </p>
              </div>
              <div class="reason-slider__item">
                <p class="reason-slider__title">Reason 2</p>
                <p class="reason-slider__desc">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore
                    magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                    nulla pariatur.
                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id
                    est laborum.
                </p>
              </div>
              {{-- endforeach --}}
            </div>
          </div>
        </div>
      </section>
      <section id="subscription">
        <div class="container">
          <h1 class="section__heading">Subscribe for more benefit to you</h1>
          <div class="subscription__slider row">
            @foreach ($subscriptions as $sub)
            <div class="px-3">
              <figure class="subscription__item">
                <img src="{{ Storage::url($sub->img) }}" class="subscription__img" alt="{{$sub->title}}">
                <figcaption class="subscription__caption">
                  <p class="subscription__name">{{$sub->title}}</p>
                  <p class="subscription__price">Price: <var class="subscription__currency">Rp. {{$sub->price}}</var></p>
                  <p class="subscription__duration">Duration: {{$sub->duration}} Day</p>
                </figcaption>
                <div class="subscription__detail">
                  <p class="subscription__name">{{$sub->title}}</p>
                  <p class="subscription__desc">
                    {{$sub->description}}
                  </p>
                  <a href="javascript:void(0);" class="subscription__btn">Subscribe Now</a>
                </div>
              </figure>
            </div>
            @endforeach
          </div>
        </div>
      </section>
      <section id="testimonies">
        <div class="container">
            <h1 class="section__heading text-center">Testimony</h1>
            @if (count($testimonies) > 0)
                <div class="row testimonies-slider">
                    @foreach ($testimonies as $testimony)
                        <div class="px-2">
                            <div class="card testimony-card">
                                <div class="card__header testimony-card__header">
                                    <img src="{{ Storage::url($testimony->user->profile->avatar) }}"
                                    alt="desainin testimony" class="card__img card__img--circle testimony__img">
                                    <p class="testimony__name">{{ $testimony->user->name }}</p>
                                    <p class="card__text">{{ $testimony->created_at->format('d M Y') }}</p>
                                </div>
                                <div class="card__body testimony-card__detail" style="text-align: center">
                                    {{ $testimony->content }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="row">
                    <div class="col-12" id="no-testimony">No testimony</div>
                </div>
            @endif
        </div>
      </section>
      <section id="client">
        <div class="container">
          <h1 class="section__heading text-center">Our client</h1>
          <div class="row">
              @forelse ($clients as $client)
                  <div class="px-2">
                      <div class="client__item">
                          <img src="{{ Storage::url($client->logo) }}" class="client__img" alt="client logo">
                      </div>
                  </div>
              @empty
                  <div class="client__item">
                      No client found
                  </div>
              @endforelse
          </div>
        </div>
      </section>
    </main>
    @include('partials.footer')
    <div class="modal" id="modal-search-service">
        <div class="modal__content">
            <div class="modal__header">
                <a href="javascript:void(0)" class="btn-close-modal btn-close-modal--search-service">
                    <i class='bx bx-x' ></i>
                </a>
            </div>
            <div class="modal__body">
                <form action="" class="search-service" method="get">
                    @csrf
                    <input type="search" class="search-service__input" name="search_agent_job"
                           placeholder="Find jobs or agent..." required>
                    <button class="search-service__btn"><i class='bx bx-search-alt'></i></button>
                </form>
            </div>
        </div>
    </div>
    <div class="overlay overlay--nav-showed"></div>
    @include('partials.script')
  </body>
</html>
