$(document).ready(function() {
  $(".nav__list--dropdown").click(function() {
    $(this).find('.dropdown-icon').toggleClass('rotate-180');
    $(this).find('.nav-dropdown-list').toggleClass('nav-dropdown-list--showed');
  });
  $(".nav__toggle").click(function() {
    $(".overlay--nav-showed").addClass('overlay--active');
    $(".overlay--nav-showed").click(function() {
      $(this).removeClass('overlay--active');
      $("nav").removeClass('nav--showed');
      $("body").removeAttr('style');
    });

    if ($(window).width() <= 992) {
      if ($("nav").hasClass('nav--showed')) {
        $("nav").removeClass('nav--showed');
        $(".overlay--nav-showed.overlay--active").removeClass('overlay--active');
        $("body").removeAttr('style');
      }
      else {
        $("nav").addClass('nav--showed');
        $("body").css('overflow', 'hidden');
      }
    }
    else {
      $("nav").removeClass('nav--showed');
      $(".overlay--nav-showed.overlay--active").removeClass('overlay--active');
    }
  });

  $("header > .container, main, footer, body[id*='blog'] header").click(function() {
    $(".nav--showed").removeClass('nav--showed');
    $(".nav-dropdown-list").removeClass('nav-dropdown-list--showed');
    $(".nav__list--dropdown .dropdown-icon").removeClass('rotate-180');
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

  const articleCategoryWidth = $("#blogIndexPage main .article__category").outerWidth(true);
  $("#blogIndexPage #main-article .col-12").filter(":nth-child(-n+2)").addClass('col-md-6')
  $("#blogIndexPage #main-article .col-12").filter(':not(:nth-child(-n+2))').addClass('col-md-3');
  $("#blogIndexPage main section .article__time").css('left', articleCategoryWidth + 30);

  //plugin & general
  $("input[accept='image/*']").change(function(){
    const blogCover = this;
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        $(this).parent().prev().attr('id', 'cover-preview');
        reader.onload = function (e) {
            blogCover.parent().prev('#cover-preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    }
  });
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

  if ($('#blogCreatePage #blog-content').length == 1) {
    const blogContent = new FroalaEditor('#blog-content', {
      placeholderText: 'Content of your article...',
      heightMin: 300
    });
  }
});
