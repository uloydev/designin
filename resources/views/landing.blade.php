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
          <div class="landing__slider">
              @foreach ($landingHeaders as $slider)
                  <img src="{{ Storage::url($slider->img) }}" alt="Desainin landing page">
              @endforeach
          </div>
          <div class="landing__slogan">
              <h1 class="header__text">
                  Find designer just like <br class="d-none d-md-block"> <span style="color: #94E5EB"></span>
              </h1>
              <div class="row mx-0 flex-column flex-md-row align-items-center justify-content-end">
                  <a href="javascript:void(0)" class="header__btn header__btn--secondary btn-modal"
                     data-target="#modal-search-service">
                      <i class='bx bx-search-alt mr-2 bx-sm'></i> Find what you want
                  </a>
                  <a href="#services" class="header__btn">
                      Order What You Want <i class='bx bxs-cart-add ml-2 bx-sm'></i>
                  </a>
              </div>
          </div>
      </div>
  </header>
  <main>
      <section id="services">
          <div class="container">
              <h1 class="section__heading">Popular service</h1>
              <a href="{{ route('services') }}" class="service__all-link">
                  See all service <i class='bx bxs-right-arrow-alt'></i>
              </a>
              <div class="row">
                  @foreach ($topService as $service)
                      <div class="col-6 col-lg-3">
                          <div class="service__item">
                              <img src="{{ Storage::url($service->image) }}" class="services__icon" alt="Our service">
                              <p class="services__name">{{ $service->title }}</p>
                              <a href="{{ route('service.show', $service->id) }}" class="services__btn"></a>
                              <div class="service__overlay"></div>
                          </div>
                      </div>
                  @endforeach
              </div>
          </div>
      </section>
      <section id="interest">
          <div class="container">
              <h1 class="section__heading text-center">Our Promo</h1>
              <div class="row justify-content-between">
                  <div class="col-12">
                      <div class="interest-slider">
                          @foreach($promos as $promo)
                              <div class="interest-slider__item">
                                  <p class="interest-slider__title">{{ $promo->title }}</p>
                                  <img src="{{ Storage::url($promo->cover) }}" height="350" alt="Cover">
                                  <a href="{{ route('blog.show', $promo->id) }}" class="interest-slider__link">
                                      src only
                                  </a>
                                  <div class="interest-slider__overlay"></div>
                              </div>
                          @endforeach
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <section id="reasons">
          <div class="container">
              <h1 class="section__heading">Why you should trust <strong>Desainin</strong></h1>
              <div class="row">
                  <div class="col-12 col-md-7 col-lg-6">
                      <ul class="reason-list">
                            @foreach ($reasons as $reason)
                                <li class="reason-list__item">
                                    <p class="reason-list__item-title">
                                    <i class='bx bx-check-circle reason-list__item-icon'></i>
                                    {{ $reason->title }}
                                    </p>
                                    <p class="reason-list__item-desc">
                                    {{ $reason->description }}
                                    </p>
                                </li>
                            @endforeach
                      </ul>
                  </div>
                  <div class="col-12 col-md-5 col-lg-6 reason-trust">
                      <a href="javascript:void(0);" class="reason-trust__btn"><i class='bx bx-play'></i></a>
                      <img src="{{ asset('img/reason-trust.png') }}" width="100%" alt="How desainin work">
                      <div class="reason-trust__overlay">
                          <div class="reason-trust__modal">
                              <a href="" class="reason-trust__close-btn"><i class='bx bx-x' ></i></a>
                              <iframe class="reason-trust__video embed-video" frameborder="0"
                                      src="https://www.youtube.com/embed/xpQLFH5OCEY??enablejsapi=1&start=0"
                                      allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                      allowfullscreen></iframe>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <section id="how-we-work">
          <div class="container">
              <h1 class="section__heading">How we work</h1>
              <div class="row">
                  <div class="col-12 col-md-5 col-lg-6 position-relative pr-5">
                      <img src="{{ asset('img/how-we-work.png') }}" width="100%" alt="How desainin work">
                  </div>
                  <div class="col-12 col-md-7 col-lg-6 d-flex align-items-center">
                      <ul class="how-we-work__list">
                          <li>Select the Subscription Package or single service that you want</li>
                          <li>Describe what you want in our brief design Form</li>
                          <li>Pay your design, and be chill!</li>
                      </ul>
                  </div>
              </div>
          </div>
      </section>
      <section id="subscription">
          <div class="container">
              <h1 class="section__heading">Subscribe for more <br class="d-md-none"> benefit to you</h1>
              <div class="subscription__slider">
                  @foreach ($subscriptions as $sub)
                      <div class="px-3">
                          <figure class="subscription__item">
                              <img src="{{ Storage::url($sub->img) }}" class="subscription__img" alt="{{$sub->title}}">
                              <figcaption class="subscription__caption">
                                  <p class="subscription__name">{{$sub->title}}</p>
                                  <p class="subscription__price">
                                      Price: <var class="subscription__currency">Rp. {{$sub->price}}</var>
                                  </p>
                                  <p class="subscription__duration">Duration: {{ $sub->duration }} Day</p>
                              </figcaption>
                              <div class="subscription__detail">
                                  <p class="subscription__name">{{ $sub->title }}</p>
                                  <p class="subscription__desc">
                                      {!! Str::words($sub->desc, 30) !!}
                                  </p>
                                  <a href="{{ route('user.subscription.show', $sub->id) }}" class="subscription__btn">
                                      Subscribe Now
                                  </a>
                              </div>
                          </figure>
                      </div>
                  @endforeach
              </div>
          </div>
      </section>
      @if (count($testimonies) > 0)
          <section id="testimonies">
              <div class="container">
                  <h1 class="section__heading text-center">Testimony</h1>
                  <div class="testimonies-slider">
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
              </div>
          </section>
      @endif
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
                      <div class="client__item">No client found</div>
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
                <form action="{{ route('service.search') }}" class="search-service" method="get">
                    <label for="search-landing" class="d-none">Search design</label>
                    <input type="search" id="search-landing" class="search-service__input" name="search_agent_job"
                    placeholder="Find design and click enter..." autocomplete="off" required>
                    <button class="search-service__btn"><i class='bx bx-search-alt'></i></button>
                </form>
            </div>
        </div>
    </div>
    <div class="overlay overlay--nav-showed"></div>
    @include('partials.script')
  </body>
</html>
