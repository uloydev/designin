$(document).ready(function() {
    //user js
    const navToggle = document.querySelector('.nav__toggle');
    const primaryNav = document.querySelector('#primaryNav');
    if (navToggle) {
        navToggle.addEventListener('click', function () {
            const overlayNavShowed = document.querySelector('.overlay--nav-showed');

            if (overlayNavShowed.length === 1) {
                if (!overlayNavShowed.classList.contains('overlay--active')) {
                    overlayNavShowed.classList.add('overlay--active');
                }
                else {
                    overlayNavShowed.classList.add('overlay--active');
                }
            }

            if (window.screen.width <= 992) {
                if (primaryNav.classList.contains('nav--showed')) {
                    primaryNav.classList.remove('nav--showed');
                    document.querySelector('body').removeAttribute('style');
                }
                else {
                    primaryNav.classList.add('nav--showed');
                    document.querySelector('body').style.cssText = 'overflow: hidden';
                }
            }
            else {
                primaryNav.classList.remove('nav--showed');
                overlayNavShowed.classList.remove('overlay--active');
            }

            overlayNavShowed.addEventListener('click', function () {
                overlayNavShowed.classList.remove('overlay--active');
                document.querySelector('body').style.removeProperty('overflow');
                document.querySelector('#primaryNav').classList.remove('nav--showed');
            });
        });
    }

    $("header > .container, main, footer, body[id*='blog'] header").click(function() {
        $(".nav--showed").removeClass('nav--showed');
        $(".nav__list--dropdown .dropdown-icon").removeClass('rotate-180');
    });

    const btnReasonVideo = document.querySelector('#landingPage .reason-trust__btn');
    const reasonOverlay = document.querySelector('#landingPage .reason-trust__overlay');
    if (btnReasonVideo) {
        btnReasonVideo.addEventListener('click', function () {
            reasonOverlay.classList.add('reason-trust__overlay--show');
        });
    }

    const btnCloseReasonVideo = document.querySelector('.reason-trust__close-btn');
    if (btnCloseReasonVideo) {

    }
    $(".reason-trust__close-btn").click(function(e) {
        e.preventDefault();
        const videoPromo = $(".reason-trust__video").clone();
        $(".reason-trust__video").remove();
        $(".reason-trust__overlay").removeClass('reason-trust__overlay--show');
        $(".reason-trust__close-btn").after(videoPromo);
    });

    const articleCategoryWidth = $("#blogIndexPage main .article__category").outerWidth(true);
    $('#blogIndexPage #main-article .col-12').filter(":nth-child(-n+2)").addClass('col-md-6');
    $('#blogIndexPage #main-article .col-12').filter(':not(:nth-child(-n+2))').addClass('col-md-3');
    $("#blogIndexPage main section .article__time").css('left', articleCategoryWidth + 40);
    $("body[id^='blog'] main section nav").addClass('nav-pagination');

    //admin js
    const btnArticles = document.querySelectorAll('.btn[data-target="#delete-article');
    btnArticles.forEach(function (btnArticle) {
        let articleId = btnArticle.dataset.articleId;
        let articleTitle = btnArticle.dataset.articleTitle;
        btnArticle.addEventListener("click", function () {
            let modalArticlesName = document.querySelectorAll('.modal-article-title');
            modalArticlesName.forEach(function (modalArticleName) {
                modalArticleName.textContent = articleTitle;
            });
            const formDeleteArticle = document.querySelector('#delete-article form');
            formDeleteArticle.action = '/admin/manage/blog/' + articleId;
        });
    });

    const btnCategories = document.querySelectorAll('.btn[data-target="#delete-category-article');
    btnCategories.forEach(function (btnCategory) {
        let idCategory = btnCategory.dataset.categoryId;
        let nameCategory = btnCategory.dataset.categoryName;
        btnCategory.addEventListener("click", function () {
            let modalCategoryNames = document.querySelectorAll('.modal-category-name');
            modalCategoryNames.forEach(function (modalCategoryName) {
                modalCategoryName.textContent = nameCategory;
            });
            const formDeleteCategory = document.querySelector('#delete-category-article form');
            formDeleteCategory.setAttribute('action', '/admin/manage/blog-category/' + idCategory);
        });
    });

    const createArticleImg = document.querySelector('#blogCreatePage input[type="file"]')
    if (createArticleImg) {
        createArticleImg.required = true;
    }

    const thisRoute = window.location.href;
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(function (navLink) {
        let url = navLink.href;
        if(url === thisRoute) {
            navLink.classList.add('active');
        }
    });

    $("#serviceCategoryPage .btn[data-target='#create-edit-category']").click(function () {
        let categoryId = $(this).data('category-id');
        let categoryName = $(this).data('category-name');

        $(".modal#create-edit-category form input[name='service_category']").val(categoryName);
        if ($(this).attr('id') === 'edit-category') {
            $(".modal#create-edit-category form").attr('action', '/admin/manage/blog-category/' + categoryId);
            $(".modal#create-edit-category form input[name='image_url']").prop('required', false);
        }
        else {
            $(".modal#create-edit-category form").attr('action', '/admin/manage/blog-category');
            $(".modal#create-edit-category form input[name='image_url']").prop('required', true);
        }
    });
    $("#serviceCategoryPage .btn[data-target='#delete-category']").click(function () {
        let categoryId = $(this).data('category-id');
        let categoryName = $(this).parent().find('span').text();

        $("#serviceCategoryPage .service-category-title").text(categoryName);
        $("#serviceCategoryPage #delete-category form").attr('action', '/admin/manage/blog-category/' + categoryId);
    });

    //plugin & general
    if (window.location.href.indexOf('blog/categories') > -1) {
        $("#blogCategoryPage .category-header__filter").niceSelect();
    }
    if (window.location.href.indexOf('admin') > -1) {
        bsCustomFileInput.init();
    }

    if ($(window).width() > 768 && $("#faqs").length === 1) {
        $('#faqs').jqTabs({
            direction: 'vertical'
        });
    }
    else if ($(window).width() < 768 && $("#faqs").length === 1) {
        $('#faqs').jqTabs({
            direction: 'horizontal'
        });
    }

    $('input[accept="image/*"]').change(function(){
        if (this.files && this.files[0]) {
            let reader = new FileReader();
            $(this).parent().prev().attr('id', 'cover-preview');
            console.log($(this).val());
            reader.onload = function (e) {
                $('#cover-preview').attr('src', e.target.result);
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

    if($("#blog-content").length === 1) {
        $("#blog-content").summernote({
            placeholder: 'Insert your content here',
            minHeight: 300
        });
    }
});
