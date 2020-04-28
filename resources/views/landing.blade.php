<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <meta name="keywords" content="@foreach ($keywords as $keyword) {{ $keyword->value }} @endforeach"> --}}
    @include('partials.stylesheet')
    <title>Desainin | No-fuss graphic design service solutions</title>
  </head>
  <body id="landingPage">
    <header>
      @include('partials.nav')
      <div class="container">
        <h1 class="header__text">Find designer just like <br class="d-none d-md-block"> turning your hand</h1>
        <a href="#services" class="header__btn">Order What You Want</a>
      </div>
    </header>
    {{-- <h4>Carousel</h4>
    @foreach ($images as $image)
    <img src="{{$image->url}}" alt="{{$image->name}}">
    @endforeach
    <hr>
    <h4>Services</h4>
    @foreach ($services as $service)
    <div>title : {{ $service->title }}</div>
    @if (!is_null($service->image))
    <div>image : {{ $service->image }}</div>
    @endif
    <div>description : {{ $service->description }}</div>
    <div>title : {{ $service->title }}</div>
    <div>agent : {{ $service->agent->name }}</div>
    @endforeach
    <a href="{{route('services')}}">view more</a>
    <hr>
    <h4>News</h4>
    @foreach ($news as $item)
    <div>title : {{ $item->title }}</div>
    @if (!is_null($item->header_image))
    <div>header image : {{ $item->header_image }}</div>
    @endif
    <div>content : {{ $item->content }}</div>
    <div>author : {{ $item->author }}</div>
    @endforeach
    {{$news->links()}} --}}
    <main>
      <section id="services">
        <div class="container">
          <h1 class="section__heading">our services</h1>
          <div class="row">
            @foreach ($serviceCategories as $category)
            <div class="px-3">
              <img src="{{ Storage::url('img/' . $category->image_url) }}" class="services__icon">
              <p class="services__name">{{ $category->name }}</p>
              <a href="{{ url('services') }}" class="services__btn btn-light">See detail</a>
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
              <img src="{{ asset('img/how-we-work.png') }}" width="100%">
              <div class="reason-trust__overlay">
                <div class="reason-trust__modal">
                  <a href="" class="reason-trust__close-btn"><i class='bx bx-x' ></i></a>
                  <iframe class="reason-trust__video embed-video" src="https://www.youtube.com/embed/xpQLFH5OCEY??enablejsapi=1&start=0"
                  frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-7 col-lg-6 reason-slider">
              {{-- foreach --}}
              <div class="reason-slider__item">
                <p class="reason-slider__title">Reason 1</p>
                <p class="reason-slider__desc">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
                  magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                  Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                  Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
              </div>
              <div class="reason-slider__item">
                <p class="reason-slider__title">Reason 2</p>
                <p class="reason-slider__desc">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
                  magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                  Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                  Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
              </div>
              {{-- endforeach --}}
            </div>
          </div>
        </div>
      </section>
      <section id="subscription">
        <div class="container">
          <h1 class="section__heading">Subscripe for more benefit to you</h1>
          <div class="subscription__slider row">
            {{-- foreach --}}
            <div class="px-3">
              <figure class="subscription__item">
                <img src="{{ asset('img/social-media.jpg') }}" class="subscription__img">
                <figcaption class="subscription__caption">
                  <p class="subscription__name">Social Media</p>
                  <p class="subscription__price">Price: <var class="subscription__currency">20USD</var></p>
                </figcaption>
                <div class="subscription__detail">
                  <p class="subscription__name">Social Media</p>
                  <p class="subscription__desc">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque praesentium odio facere doloribus assumenda.
                    Vel explicabo dolorem suscipit, fugiat fuga adipisci iste reiciendis ipsa esse officiis,
                    voluptas quis velit. Ratione.
                  </p>
                  <a href="javascript:void(0);" class="subscription__btn">Subscribe Now</a>
                </div>
              </figure>
            </div>
            {{-- endforeach --}}
          </div>
        </div>
      </section>
      <section id="testimonies">
        <div class="container">
          <h1 class="section__heading text-center">Testimoni</h1>
          <div class="row testimonies-slider">
            {{-- foreach --}}
            <div class="px-2">
              <div class="card testimony-card">
                <div class="card__header testimony-card__header">
                  <img src="{{ asset('img/people.jpg') }}" alt="desainin testimony" class="card__img card__img--circle testimony__img">
                  <p class="testimony__name">People name</p>
                  <p class="card__text">People jobs</p>
                </div>
                <div class="card__body testimony-card__detail">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
                  magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                  Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </div>
              </div>
            </div>
            <div class="px-2">
              <div class="card testimony-card">
                <div class="card__header testimony-card__header">
                  <img src="{{ asset('img/people.jpg') }}" alt="desainin testimony" class="card__img card__img--circle testimony__img">
                  <p class="testimony__name">People name</p>
                  <p class="card__text">People jobs</p>
                </div>
                <div class="card__body testimony-card__detail">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
                  magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                  Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </div>
              </div>
            </div>
            <div class="px-2">
              <div class="card testimony-card">
                <div class="card__header testimony-card__header">
                  <img src="{{ asset('img/people.jpg') }}" alt="desainin testimony" class="card__img card__img--circle testimony__img">
                  <p class="testimony__name">People name</p>
                  <p class="card__text">People jobs</p>
                </div>
                <div class="card__body testimony-card__detail">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
                  magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                  Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </div>
              </div>
            </div>
            <div class="px-2">
              <div class="card testimony-card">
                <div class="card__header testimony-card__header">
                  <img src="{{ asset('img/people.jpg') }}" alt="desainin testimony" class="card__img card__img--circle testimony__img">
                  <p class="testimony__name">People name</p>
                  <p class="card__text">People jobs</p>
                </div>
                <div class="card__body testimony-card__detail">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
                  magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                  Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </div>
              </div>
            </div>
            {{-- endforeach --}}
          </div>
        </div>
      </section>
      <section id="client">
        <div class="container">
          <h1 class="section__heading text-center">Our client</h1>
          <div class="row">
            {{-- foreach --}}
            <div class="px-2">
              <div class="client__item">
                <img src="{{ asset('img/client.png') }}" class="client__img">
              </div>
            </div>
            {{-- endforeach --}}
          </div>
        </div>
      </section>
    </main>
    @include('partials.footer')
    <div class="overlay overlay--nav-showed"></div>
    @include('partials.script')
  </body>
</html>
