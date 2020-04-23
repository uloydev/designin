$(document).ready(function() {
  $(".nav__toggle").click(function() {
    $(".overlay--nav-showed").addClass('overlay--active');
    $(".overlay--nav-showed").click(function() {
      $(this).removeClass('overlay--active');
      $("nav").removeClass('nav--showed');
      $("body").removeAttr('style');
    });

    if ($("nav").hasClass('nav--showed')) {
      $("nav").removeClass('nav--showed');
      $(".overlay--nav-showed.overlay--active").removeClass('overlay--active');
      $("body").removeAttr('style');
    }
    else {
      $("nav").addClass('nav--showed');
      $("body").css('overflow', 'hidden');
    }
  });
  $(".reason-trust__btn").click(function() {
    $(".reason-trust__overlay").addClass('reason-trust__overlay--show');
  });
  $(".reason-trust__close-btn").click(function(e) {
    e.preventDefault();
    const videoPromo = $(".reason-trust__video").clone();
    $(".reason-trust__video").remove();
    $(".reason-trust__overlay").removeClass('reason-trust__overlay--show');
    $(".reason-trust__close-btn").after(videoPromo);
  });

  //plugin
  $("#services .row").slick({
    infinite: false,
    slidesToShow: 3,
    slidesToScroll: 3,
    prevArrow: "<a href='javascript:void(0);' class='bx bxs-chevron-left'></a>",
    nextArrow: "<a href='javascript:void(0);' class='bx bxs-chevron-right'></a>",
    responsive: [
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });
  $("#reasons .reason-slider").slick({
    infinite: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    mobileFirst: true,
    prevArrow: "<a href='javascript:void(0);' class='bx bxs-chevron-left'></a>",
    nextArrow: "<a href='javascript:void(0);' class='bx bxs-chevron-right'></a>",
    responsive: [
      {
        breakpoint: 992,
        settings: {
          dots: true
        }
      }
    ]
  });
  $("#subscription .subscription__slider").slick({
    infinite: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    mobileFirst: true,
    prevArrow: "<a href='javascript:void(0);' class='bx bxs-chevron-left'></a>",
    nextArrow: "<a href='javascript:void(0);' class='bx bxs-chevron-right'></a>",
    responsive: [
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      }
    ]
  });
  $("#testimonies .testimonies-slider, #client .row").slick({
    infinite: false,
    rows: 1,
    slidesPerRow: 2,
    slidesToShow: 2,
    prevArrow: "<a href='javascript:void(0);' class='bx bxs-chevron-left'></a>",
    nextArrow: "<a href='javascript:void(0);' class='bx bxs-chevron-right'></a>",
    responsive: [
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 1
        }
      }
    ]
  });
});
