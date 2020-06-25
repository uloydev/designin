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
          <div class="landing__slogan">
              <h1 class="header__text">Bikin desain apa saja <span>Gak pake ribet</span></h1>
              <form action="{{ route('service.search') }}" method="get" class="search-service">
                  <label for="search-landing" class="d-none">Search design</label>
                  <input type="search" id="search-landing" class="search-service__input" name="search_agent_job"
                  list="all-service" placeholder="Cari desain melalui jaringan desainer kami..." autocomplete="off" required>
                  <button class="search-service__btn"><i class='bx bx-search-alt'></i></button>
              </form>
              <datalist id="all-service">
                  @foreach($services as $service)
                      <option value="{{ $service->title }}">{{ $service->title }}</option>
                  @endforeach
              </datalist>
          </div>
      </div>
  </header>
  <section id="client">
      <div class="container">
          <div class="client__slider">
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
  <main>
      <section id="services">
          <div class="container">
              <h1 class="section__heading">Explore our top service</h1>
              <a href="{{ route('services') }}" class="service__all-link">
                  See all service <i class='bx bxs-right-arrow-alt'></i>
              </a>
              <div class="row">
                  @foreach ($topService as $category)
                      <div class="col-6 col-md-4 col-lg-2">
                          <div class="service__item">
                              <img src="{{ Storage::url($category->image_url) }}" class="services__icon" alt="Our service">
                              <p class="services__name">{{ $category->name }}</p>
                              <a href="{{ route('services') . '#' . Str::slug($category->name) }}"
                                 class="services__btn"></a>
                          </div>
                      </div>
                  @endforeach
              </div>
          </div>
      </section>
      <section id="reasons">
          <div class="container">
              <h1 class="section__heading">Pasti beres dengan desainin.id, Gak perlu ribet!</h1>
              <div class="row">
                  <div class="col-12 col-md-7 col-lg-6">
                      <ul class="reason-list">
                          <li class="reason-list__item">
                              <p class="reason-list__item-title">
                                  <img src="{{ asset('img/reason-icon1.svg') }}" alt="Reason 1" height="40">
                                  Bikin desain tanpa pusing
                              </p>
                              <p class="reason-list__item-desc">
                                  Jaminan kualitas desain kami pastikan. Jaringan desainer kami
                                  sudah melalui veriﬁkasi skill dan tema desain yang pasti sesuai kebutuhan user kami
                              </p>
                          </li>
                          <li class="reason-list__item">
                              <p class="reason-list__item-title">
                                  <img src="{{ asset('img/reason-icon2.svg') }}" alt="Reason 2" height="40">
                                  Harga jujur di depan, pasti mujur
                              </p>
                              <p class="reason-list__item-desc">
                                  segala keperluanmu, dengan jasa profesional dari jaringan desainer kami.
                                  Dari tugas sekolah sampai bisnis. gak ada biaya sembunyi-sembunyi
                              </p>
                          </li>
                          <li class="reason-list__item">
                              <p class="reason-list__item-title">
                                  <img src="{{ asset('img/reason-icon3.svg') }}" alt="Reason 2" height="30">
                                  Layanan Personal, 24/7
                              </p>
                              <p class="reason-list__item-desc">
                                  desainin.id selalu bersamamu, hubungi kami semudah chat
                                  melalui apa saja. Telpon, Whatsapp atau chat in-Web. Diskusikan
                                  kebutuhan project kamu melalui tim kami. Bukan bot apalagi yang bukan-bukan.
                              </p>
                          </li>
                      </ul>
                  </div>
                  <div class="col-12 col-md-5 col-lg-6 reason-trust">
                      <a href="javascript:void(0);" class="reason-trust__btn"><i class='bx bx-play'></i></a>
                      <img src="{{ asset('img/reason-trust.webp') }}" width="100%" alt="How desainin work">
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
              <h1 class="section__heading">Cari tahu cara kerja desainin.id</h1>
              <div class="row">
                  <div class="col-12 col-md-4 mb-4 mb-md-0">
                      <div class="how-we-work__list">
                          <img src="{{ asset('img/how-we-work1.svg') }}" alt="How we work">
                          <p>Cari desain yang kamu inginkan</p>
                          <p>
                              Cari desain yang kamu butuhkan melalui jaringan desainer profesional kami.
                              selesaikan pembayaran melalui saluran aman kami.
                          </p>
                      </div>
                  </div>
                  <div class="col-12 col-md-4 mb-4 mb-md-0">
                      <div class="how-we-work__list">
                          <img src="{{ asset('img/how-we-work2.svg') }}" alt="How we work">
                          <p>Submit desain impian kamu </p>
                          <p>
                              Lakukan brief untuk desain yang kamu inginkan. sampaikan
                              secara lengkap kepada kami. akan kami pastikan desain terbaik untuk kamu.
                          </p>
                      </div>
                  </div>
                  <div class="col-12 col-md-4">
                      <div class="how-we-work__list">
                          <img src="{{ asset('img/how-we-work3.svg') }}" alt="How we work">
                          <p>Dapatkan desain kamu!</p>
                          <p>
                              tadaaa!! desain kamu sudah jadi. Jangan lupa berikan review
                              untuk jaringan desainer kami. untuk akses terbaik bagi desain berkualitas.
                          </p>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <section id="inspire">
          <div class="container">
              <h1>Inspirasi desain dari jaringan desainer <br> kami</h1>
              <div class="inspire__slider">
                  @foreach($inspirations as $inspire)
                  <figure class="inspire__item">
                      <img src="{{ Storage::url($inspire->image) }}" class="inspire__img"
                           alt="Inspiration from desainin">
                      <figcaption class="inspire__detail">
                          <img src="{{ Storage::url($inspire->agent->profile->avatar) }}" alt="Agent desainin"
                               height="70" class="inspire__avatar">
                          <div class="inspire__caption">
                              <p class="inspire__title">{{ $inspire->title}}</p>
                              <small>By {{ $inspire->agent->name }}</small>
                          </div>
                      </figcaption>
                      <a href="" class="inspire__link">item link</a>
                  </figure>
                  @endforeach
              </div>
          </div>
      </section>
      <section id="interest">
          <div class="container">
              <h1 class="section__heading text-center">Our Promo</h1>
              <div class="interest-slider">
                  <img src="{{ asset('img/promo1.webp') }}" alt="Desainin Promo" class="interest__img">
                  <p class="interest-slider__title">
                      Langganan sekarang <span class="d-block">desain lebih hemat sampai <br> 50%</span>
                  </p>
                  <a href="{{ route('blog.index') }}" class="interest-slider__link">Read more</a>
              </div>
          </div>
      </section>
      <section id="promo">
          <div class="container">
              <div class="row">
                  <div class="col-12 col-md-7 col-lg-6">
                      <ul class="reason-list">
                          <li class="reason-list__item">
                              <p class="reason-list__item-title">
                                  <img src="{{ asset('img/reason-icon1.svg') }}" alt="Reason 1" height="40">
                                  Pasti lebih murah, makin gak pusing
                              </p>
                              <p class="reason-list__item-desc">
                                  Dengan berlangganan, dapatkan request desain dengan harga
                                  yang lebih murah, hingga 50%. Cara baru untuk memastikan
                                  urusan desain tanpa ribet.
                              </p>
                          </li>
                          <li class="reason-list__item">
                              <p class="reason-list__item-title">
                                  <img src="{{ asset('img/reason-icon2.svg') }}" alt="Reason 2" height="40">
                                  Tanpa kontrak, sesuai kebutuhan
                              </p>
                              <p class="reason-list__item-desc">
                                  dan gunakan tanpa ribet. Jangan batasi ide anda dengan kontrak
                                  dan administrasi. 100% akses ke jaringan desainer kami.
                              </p>
                          </li>
                          <li class="reason-list__item">
                              <p class="reason-list__item-title">
                                  <img src="{{ asset('img/reason-icon3.svg') }}" alt="Reason 2" height="30">
                                  Layanan khusus langganan
                              </p>
                              <p class="reason-list__item-desc">
                                  Jangan khawatir, kami akan pastikan user langganan kami memiliki pelayanan prioritas
                                  dari A sampai Z, kami siap untuk anda.
                              </p>
                          </li>
                      </ul>
                  </div>
                  <div class="col-12 col-md-5 col-lg-6 reason-trust text-center">
                      <img src="{{ asset('img/people-promo.webp') }}" height="300"
                           alt="How desainin work" class="d-block mx-auto">
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
                          <div class="subscription__item">
                              <p class="subscription__name">{{$sub->title}}</p>
                              <div class="subscription__box">
                                  <img src="{{ Storage::url($sub->img) }}" class="subscription__img" alt="{{$sub->title}}">
                                  <div class="subscription__caption">
                                      <p class="subscription__duration">Berlaku: {{ $sub->duration }} Day</p>
                                      <p class="subscription__price">
                                          <var class="subscription__currency">{{ $sub->price }}</var>
                                      </p>
                                  </div>
                              </div>
                              <a href="{{ route('user.subscription.show', $sub->id) }}" class="subscription__btn">
                                  Beli Paket
                              </a>
                          </div>
                      </div>
                  @endforeach
              </div>
          </div>
      </section>
      <section id="blog">
          <div class="container">
              <h1 class="section__heading mb-5">Food for Thoughts</h1>
              @foreach($blogs as $blog)
                  <article class="blog-article">
                      <img src="{{ Storage::url($blog->header_image) }}" alt="{{ $blog->title }}"
                           class="blog-article__img">
                      <div class="blog-article__detail">
                          <p class="blog-article__title">{{ $blog->title }}</p>
                          <p>{{ Str::words($blog->contents, 30) }}</p>
                      </div>
                      <a href="{{ route('blog.show', $blog->id) }}" class="blog-article__link">src only</a>
                  </article>
              @endforeach
          </div>
      </section>
      <section id="help">
          <div class="container">
              <img src="{{ asset('img/help.webp') }}" alt="Help" class="help__bg">
              <div class="help__box">
                  <h1>
                      <span>Oopss...</span>
                      <span>butuh bantuan atau bingung dengan layanan kami?</span>
                  </h1>
                  <a href="https://wa.me/628118696858" class="help__btn" target="_blank">Whatsapp us</a>
              </div>
          </div>
      </section>
    </main>
    @include('partials.footer')
    @stack('element')
    @include('partials.script')
  </body>
</html>
