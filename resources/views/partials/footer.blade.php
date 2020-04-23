<footer>
  <div class="container">
    <div class="row justify-content-between">
      <div class="footer__info col-12 col-md-6 col-lg-4">
        <a href="{{ url('/') }}">
          <img src="{{ asset('img/logo.png') }}">
        </a>
        <address class="footer__address">
          Metropolitan Tower 22nd Floor, Jl. R.A.Kartini No.Kav. 14, RT.10/RW.4,
          West Cilandak, Cilandak, South Jakarta City, Jakarta 12430
        </address>
        <a class="footer__link" href="mailto:joe@example.com?subject=feedback">email@email.com</a>
        <a href="rtel:087776196047" class="footer__link">087776196047</a>
      </div>
      <div class="footer__legal col-12 col-md-6 col-lg-7">
        <ul class="footer__socmed">
          <li class="footer__socmed-item">
            <a href=""><i class='bx bxl-facebook' ></i></a>
          </li>
          <li class="footer__socmed-item"><a href="" class="footer__socmed-link"><i class='bx bxl-twitter' ></i></a></li>
          <li class="footer__socmed-item"><a href="" class="footer__socmed-link"><i class='bx bxl-instagram' ></i></a></li>
          <li class="footer__socmed-item"><a href="" class="footer__socmed-link"><i class='bx bxl-linkedin' ></i></a></li>
        </ul>
        <small class="footer__copyright">&copy; {{ date('Y') }} Copyright Dickson synergy inc. All rights reserved.</small>
      </div>
    </div>
  </div>
</footer>
