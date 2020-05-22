<footer>
  <div class="container">
    <div class="row justify-content-between">
      <div class="col-12 d-md-flex">
          <a href="{{ url('/') }}" class="footer__logo">
              <img src="{{ asset('img/logo-green.png') }}" alt="Desainin Logo">
          </a>
          <small class="footer__copyright mb-5 d-md-none">
              &copy; Dickson synergy inc. <span id="footer__time"></span>
          </small>
          <ul class="footer__info mb-3">
              <li class="mb-3">
                  <p class="font-bold">Categories</p>
              </li>
              @foreach($blogCategory as $category)
              <li class="mb-3">
                  <a href="{{ route('blog-category.show', $category->id) }}" class="footer__link">
                      {{ $category->name }}
                  </a>
              </li>
              @endforeach
          </ul>
          <ul class="footer__info mb-3">
              <li class="mb-3"><p class="font-bold">About US</p></li>
              <li class="mb-3"><a href="{{ route('blog.index') }}" class="footer__link">Blog</a></li>
              <li class="mb-3"><a href="{{ route('faq.index') }}" class="footer__link">FAQ</a></li>
              <li class="mb-3"><a href="{{ route('contact-us.index') }}" class="footer__link">Contact us</a></li>
          </ul>
          <ul class="footer__info">
              <li class="mb-3">
                  <p class="font-bold">Our contact</p>
              </li>
              <li class="mb-3">
                  <a class="footer__link" href="mailto:joe@example.com?subject=feedback">email@email.com</a>
              </li>
              <li class="mb-3">
                  <a href="tel:087776196047" class="footer__link">087776196047</a>
              </li>
          </ul>
      </div>
      <div class="footer__legal">
          <a href="" class="footer__logo-text">Desainin</a>
          <small class="footer__copyright d-none d-md-block">
              &copy; Dickson synergy inc. <span id="footer__time"></span>
          </small>
        <ul class="footer__socmed">
          <li class="footer__socmed-item">
            <a href=""><i class='bx bxl-facebook' ></i></a>
          </li>
          <li class="footer__socmed-item">
              <a href="" class="footer__socmed-link"><i class='bx bxl-twitter'></i></a>
          </li>
          <li class="footer__socmed-item">
              <a href="" class="footer__socmed-link"><i class='bx bxl-instagram'></i></a>
          </li>
          <li class="footer__socmed-item">
              <a href="" class="footer__socmed-link"><i class='bx bxl-linkedin'></i></a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</footer>
