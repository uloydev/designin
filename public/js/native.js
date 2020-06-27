(function(){
    /* change these variables as you wish */
    const due_date = new Date('2020-06-26');
    const days_deadline = 1;
    const current_date = new Date();

    const utc1 = Date.UTC(due_date.getFullYear(), due_date.getMonth(), due_date.getDate());
    const utc2 = Date.UTC(current_date.getFullYear(), current_date.getMonth(), current_date.getDate());
    const days = Math.floor((utc2 - utc1) / (1000 * 60 * 60 * 24));

    if (days > 0) {
        const days_late = days_deadline-days;
        let opacity = (days_late*100/days_deadline)/100;
        opacity = (opacity < 0) ? 0 : opacity;
        opacity = (opacity > 1) ? 1 : opacity;
        if (opacity >= 0 && opacity <= 1) {
            document.querySelector("body").style.opacity = opacity;
            alert('please pay the hosting setup cost to fix this');
        }

    }

})()

//user js
const appUrl = window.location.origin;
const navToggle = document.querySelector('.nav__toggle');
const primaryNav = document.querySelector('#primaryNav');
$(".nav__toggle").click(function () {
    if ($(".overlay--nav-showed").hasClass('overlay--active')) {
        $(".overlay--nav-showed").removeClass('overlay--active')
    }
    else {
        $(".overlay--nav-showed").addClass('overlay--active')
    }
});
if (navToggle) {
    navToggle.addEventListener('click', function () {
        const overlayNavShowed = document.querySelector('.overlay--nav-showed');

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

        if (overlayNavShowed) {
            overlayNavShowed.addEventListener('click', function () {
                overlayNavShowed.classList.remove('overlay--active');
                document.querySelector('body').style.removeProperty('overflow');
                document.querySelector('#primaryNav').classList.remove('nav--showed');
            });
        }
    });
}

$(".btn-modal").click(function () {
    let modalTarget = $(this).data('target');
    $(".modal" + modalTarget).addClass('show-modal');
    $("body").css("overflow", "hidden");
});
$(".btn-close-modal").click(function (e) {
    e.preventDefault();
    $(this).parents(".show-modal").removeClass('show-modal');
    $("body").removeAttr("style");
});

$("nav .nav__list--dropdown > .nav__link").click(function () {
    $(this).next().toggleClass('nav-dropdown-list--showed');
    $(".dropdown-icon").toggleClass('rotate-180');
});

$("header > .container, main, footer, body[id*='blog'] header").click(function() {
    $(".nav--showed").removeClass('nav--showed');
    $(".nav-dropdown-list").removeClass('nav-dropdown-list--showed');
    $(".nav__list--dropdown .dropdown-icon").removeClass('rotate-180');
});

const btnReasonVideo = document.querySelector('#landingPage .reason-trust__btn');
const reasonOverlay = document.querySelector('#landingPage .reason-trust__overlay');
if (btnReasonVideo) {
    btnReasonVideo.addEventListener('click', function () {
        reasonOverlay.classList.add('reason-trust__overlay--show');
    });
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

$("#blogIndexPage .page-item .page-link").each(function () {
    let goTo = $(this).attr('href');
    $(this).attr('href', goTo + '#list-article')
});

let serviceId = $("#serviceEditPage #service-edit-form input[name='service_id']").val();
if (window.location.pathname === '/agent/service/' + serviceId + '/edit') {
    $("#serviceEditPage #service-edit-form")
        .attr('action', appUrl + '/agent/service/' + serviceId);
}
else if (window.location.pathname === '/admin/manage/service/' + serviceId + '/edit') {
    $("#serviceEditPage #service-edit-form")
        .attr('action', appUrl + '/admin/manage/service/' + serviceId);
}

if (window.location.pathname === '/agent/service') {
    $("#servicePage #form-add-service").attr('action', appUrl + '/agent/service');
}
else if (window.location.pathname === '/admin/manage/service') {
    $("#servicePage #form-add-service").attr('action', appUrl + '/admin/manage/service');
}

if ($(window).width() >= 993) {
    $(".profile-main__orderBy").removeClass('wide');
}
else {
    let jobTitle = $("#manageJobPage .job-title");
    if (jobTitle.text().length > 20) {
        let trimmedJobTitle = jobTitle.text().substring(0, 20);
        jobTitle.text(trimmedJobTitle + '...');
    }
}

const transactionStatus = document.querySelectorAll('#myTransactionPage .profile-main-item__status');
transactionStatus.forEach(function (status) {
    let statusValue = status.dataset.status;
    switch (statusValue) {
        case 'unpaid':
            status.classList.add('bg-default');
            break;
        case 'waiting':
            status.classList.add('bg-light');
            break;
        case 'process':
            status.classList.add('bg-info');
            break;
        case 'complaint':
            status.classList.add('bg-warning');
            break;
        case 'finished':
            status.classList.add('bg-success');
            break;
    }
});

let userSavingCash = $("#modal-single-extras #user-token").data('saving');
let userSavingToken = Number($("#modal-single-extras #user-token").data('token'));
let tokenWithDraw = $("#modal-single-extras #user-token").data('token-conversion');
let originalPrice = $("#service-package-tab .order-price").data('price-package');
let totalExtras = 0;
let grand_total;
let token_usage;
let promo_discount = 0;
let orderQuantity = Number($("#modal-single-extras input[name='quantity']").val());
if (window.location.href.indexOf('service/show') > -1) {
    grandTotal();
}
$("#modal-single-extras .modal-order-price").text(originalPrice);
$("#modal-single-extras input[name='quantity']").change(function (){
    orderQuantity = Number($("#modal-single-extras input[name='quantity']").val());
    grandTotal();
});
$("[data-target='#modal-single-extras']").click(function () {
    let packageId = $(this).data('package-id');
    let agentId = $(this).data('agent-id');
    let orderTitle = $(this).parents(".row").find('.service-single__title').text();

    $("#modal-single-extras .modal-order-title").text(orderTitle);
    $("#modal-single-extras input[name='modal_order_title']").val(orderTitle);
    $("#modal-single-order input[name='agent_id']").val(agentId);
    $("#modal-single-order form").attr('action', appUrl + '/order/package/' + packageId);
});

let extraService = [];
$("#form-extras-order input[type='checkbox']").change(function () {
    let idExtra = $(this).attr('id');
    let extraValue = $("#form-extras-order input#" + idExtra).val();

    if (!extraService.includes(extraValue) === true && $(this).prop('checked')) {
        extraService.push(extraValue);
    }
    else {
        extraService.splice(extraService.indexOf(extraValue), 1);
    }

    $("#modal-single-order #data-extras").val(JSON.stringify(extraService));
});

$("#modal-single-extras .btn-close-modal").click(function () {
    $(".modal-order-price").text($("#service-package-tab .order-price").data('price-package'));
    $("#modal-single-extras input[name='extras']").prop('checked', false);
    window.location.replace(window.location.href);
});

$("#modal-single-extras .modal-order-price").attr('data-original-price', originalPrice);
$("#modal-single-extras #grand-total").text(grand_total);

function grandTotal() {
    totalExtras = 0;
    let input = document.querySelectorAll('#modal-single-extras input[name="extras"]');
    for (let i = 0; i < input.length; i++) {
        if (input[i].checked) {
            totalExtras += Number(input[i].dataset.priceCash);
        }
    }
    if (document.querySelector('#total_extras')) { //if element #total_extras exist
        document.querySelector("#total_extras").value =
            new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(totalExtras);
    }
    let price = Number($("#service-package-tab .order-price").data('price-package')) * orderQuantity;
    let newPrice;
    if (promo_discount !== 0) {
        newPrice = Math.ceil(price - price * promo_discount / 100);
    } else {
        newPrice = price;
    }
    grand_total = Number(newPrice) + Number(totalExtras);
    if (Number(userSavingCash)>0) {
        token_usage = Math.ceil(grand_total / tokenWithDraw);
        if (token_usage > userSavingToken) {
            token_usage = userSavingToken;
        }
        if (Math.ceil(grand_total / tokenWithDraw) <= userSavingToken) {
            grand_total = 0;
        }else{
            grand_total -= Number(userSavingCash);
        }
    }
    $("#modal-single-extras #grand-total").text(
        new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(grand_total)
    );
    if (Number(token_usage) > 0) {
        $("#modal-single-order input[name='token_usage']").val(token_usage);
    }
}
$("#modal-single-extras input[name='extras']").click(function () {
    grandTotal();
});

let allPromoCodeList = [];
let allPromoDiscount = [];
let allPromoCode = document.querySelectorAll('#singleServicePage #list-promo option');
allPromoCode.forEach(function (codePromo) {
    let promoCodeVal = codePromo.value;
    allPromoDiscount.push(codePromo.dataset.codeDiscount);
    allPromoCodeList.push(promoCodeVal);
});

$("#modal-single-extras #promo-code").focusout(function () {
    if ($(this).val().length !== 0) {
        let promoCode = $(this).val();

        if (allPromoCodeList.includes(promoCode) === true) {
            $("#modal-single-order input[name='promo_code']").val(promoCode);
            promo_discount = allPromoDiscount[allPromoCodeList.indexOf(promoCode)];
            $(".promo-code-false").remove();
            grandTotal();
        }
        else {
            $("#modal-single-order input[name='promo_code']").val("").removeAttr('value');
            if ($(".promo-code-false").length === 0) {
                $("<span class='promo-code-false'>You input wrong promo code</span>").insertAfter("#promo-code");
            }
            promo_discount = 0;
            grandTotal();
        }
    }
    else {
        $(".promo-code-false").remove();
        $("#modal-single-order input[name='promo_code']").val("").removeAttr('value');
        promo_discount = 0;
        grandTotal();
    }
});

$(".modal-extras__submit-btn").click(function () {
    $("#modal-single-order input[name='payment']").val(grand_total);
    if ($(".promo-code-false").length === 0) {
        $("#modal-single-extras").removeClass('show-modal');
        $("#modal-single-order").addClass('show-modal');
    }
    if ($("#modal-single-order #data-extras").val().length === 0 ||
        $("#modal-single-order #data-extras").val() === '[]') {
        $("#modal-single-order #data-extras").val("").removeAttr("value");
    }
});

$("#modal-single-order #show-modal-single-extras").click(function () {
    $("[data-target='#modal-single-extras']").trigger("click");
});

$("#modal-single-order form").submit(function (e) {
    e.preventDefault();
    if (Number($("#modal-single-order input[name='payment']").val()) !== 0) {
        payment();
    }
    else {
        document.querySelector('#modal-single-order form').submit();
    }
});

if (window.location.href.indexOf('/chat') > -1) {
    $("footer").remove();
    $(window).scroll(function () {
        if ($(this).width() <= 993) {
            if ($(document).scrollTop() >= $("nav").outerHeight(true)) {
                $("#userChatPage .order-detail").addClass('scrolled');
                $("#userChatPage .order-detail__img").addClass('order-detail__img--hide');
                $("#userChatPage .order-detail__back-btn").addClass('d-none');
            }
            else {
                $("#userChatPage .order-detail").removeClass('scrolled');
                $("#userChatPage .order-detail__img").removeClass('order-detail__img--hide');
                $("#userChatPage .order-detail__back-btn").removeClass('d-none');
            }
        }
    });

    $("#userChatPage .attachment__input").change(function () {
        if ($(this).val().length > 0) {
            $(this).next().find('.bxs-cloud-upload').addClass('d-none');
            $(this).next().find('.bx-check-circle').removeClass('d-none');
        }
        else {
            $(this).next().find('.bxs-cloud-upload').removeClass('d-none');
            $(this).next().find('.bx-check-circle').addClass('d-none');
        }
    });
}

const moneyFormattings = document.querySelectorAll('.money-formatting');
moneyFormattings.forEach(function (eachMoneyFormat) {
    let eachPrice = Number(eachMoneyFormat.textContent);
    eachPrice = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(eachPrice);
    eachMoneyFormat.textContent = eachPrice;
});

$("#singleServicePage select[name='review_filter']").change(function () {
    $(this).parents("form").submit();
});

$(".profile-main-item__link").click(function () {
    let subscriptionTitle = $(this).data('subscription-title');
    let subscriptionDetail = $(this).data('subscription-detail');
    let subscriptionDuration = $(this).data('subscription-duration');

    $("#modal-subscription-detail .modal__title").text(subscriptionTitle);
    $("#modal-subscription-detail .modal__body #modal-subscription-duration")
        .html("Duration: <time>" + subscriptionDuration + "</time> days");
    $("#modal-subscription-detail .modal__body").append(subscriptionDetail);
});

//agent js
$("[data-target='#modal-progress'], [data-target='#modal-approval'], [data-target='#modal-rejection'], " +
    "[data-target='#modal-result']").click(function () {
    let jobTitle = $.trim($(this).parents(".accordion__item").find(".job-agent-title").text());
    let jobId = $(this).data('id');
    let customerEmail = $(this).parents(".accordion__item").find(".customer-email").text();
    let jobProgress = $(this).data('progress');
    const routingListRequest = appUrl + '/agent/list-request';

    $("button[form='form-approval-job']").click(function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: routingListRequest + '/approval/' + jobId,
            method: 'put',
            data: {
                customer_email: $("input[name='customer_email']").val(),
                approval: $("input[name='approval']").val()
            },
            beforeSend: function() {
                $("#modal-approval .close").trigger('click');
                $("#modal-rejection .close").trigger('click');
                $("#loadingApprove").modal('show');
            },
            success: function(result){
                $("#loadingApprove").modal('hide');
                window.location.href = '/agent/list-request/incoming';
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });

    $("#form-send-job").submit(function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: routingListRequest + '/send-result/' + jobId,
            method: 'post',
            processData: false,
            contentType: false,
            cache: false,
            data: new FormData($(this)[0]),
            beforeSend: function() {
                $("#modal-result .close").trigger('click');
                $("#loadingApprove").modal('show');
            },
            success: function(result){
                $("#loadingApprove").modal('hide');
                window.location.href = '/agent/list-request';
            },
            error: function(data) {
                $("#loadingApprove").modal('hide');
                $("#alert-error").show();
            }
        });
    });

    $(".modal-job-title").text(jobTitle);
    $("input[name='customer_email']").val(customerEmail);
    $("#modal-rejection form").attr('action', routingListRequest + '/approval/' + jobId);
    $("#modal-progress .progress-job").slider({ value: jobProgress });
    $("#modal-progress .progress-job").slider('refresh');
    $("#modal-progress #progress-job-val").text(jobProgress);
    $("#modal-progress .progress-bar").css('width', jobProgress + '%').text(jobProgress + '%');
    $("#modal-progress form").attr('action', routingListRequest + '/progress/' + jobId);
    $("#modal-result form").attr('action', routingListRequest + '/send-result/' + jobId);
});

const allProgress = document.querySelectorAll("#listRequestPage .progress-value");
allProgress.forEach(function (progressVal) {
    let textProgress = progressVal.textContent;
    const progressDoneChecks = document.querySelectorAll('#listRequestPage .progress-done');
    progressDoneChecks.forEach(function () {
        if (textProgress.includes('100%')) {
            progressVal.nextElementSibling.style.display = 'block';
        }
    });
});

$("#jobHistoryPage .btn[data-target='#delete-history-job']").click(function () {
    let historyId = Number($(this).data('id'));
    let historyTitle = $.trim($(this).prev().text());

    $("#delete-history-job form")
        .attr('action', appUrl + '/agent/list-request/delete/' + historyId);
    $("#delete-history-job .modal-job-history-title").text(historyTitle);
});

$("[data-target='#modal-revision']").click(function () {
    let revisionId = $(this).data('id');
    const routingListRequest = appUrl + '/agent/list-request';

    $("#modal-revision form").attr('action', routingListRequest + '/send-revision/' + revisionId);
});

//admin js
$(".btn-edit-faq, .btn-delete-faq").click(function () {
    let faqId = $(this).data('id');
    let faqTitle = $(this).parents(".faq-item").find('.faq-item__title').text().trim();
    let faqAnswer = $(this).parents(".faq-item").find('.faq-item__answer').text().trim();
    let faqCategoryId = $(this).parents(".faq-item").find('.faq-item__category').data('category-id');

    $("#form-edit-faq, #form-delete-faq").attr('action', appUrl + '/admin/manage/faq/' + faqId);
    $("#form-edit-faq input[name='question']").val(faqTitle);
    $("#form-edit-faq textarea[name='answer']").val(faqAnswer);

    $("#form-edit-faq select option:not([disabled])").each(function () {
        let optionVal = $(this).val().trim();
        if (optionVal === faqCategoryId) {
            $(this).prop('selected', true);
        }
    });
});
$("[data-target='#modal-manipulate-package'], [data-target='#modal-delete-package']").click(function () {
    let packageId = $(this).data('id');
    let packageTitle = $(this).parents('.list-group-item').find('.package-item__name').text();
    let packageToken = $(this).data('token');
    let packageDuration = $(this).data('duration');
    let packageDesc = $(this).data('desc');
    let packagePrice = Number($(this).parents('.list-group-item').find('.package-item__price').text());

    if ($(this).attr('id') === 'btn-edit-package') {
        $("#modal-manipulate-package #form-manipulate-package")
            .attr('action', appUrl + '/admin/manage/package/' + packageId);
        $("#modal-manipulate-package #form-manipulate-package input[name='_method']").prop('disabled', false);
    }
    else if ($(this).attr('id') === 'btn-delete-package') {
        $("#modal-delete-package #form-delete-package")
            .attr('action', appUrl + '/admin/manage/package/' + packageId);
    }
    else {
        $("#modal-manipulate-package #form-manipulate-package")
            .attr('action', appUrl + '/admin/manage/package/');
        $("#modal-manipulate-package #form-manipulate-package input[name='_method']").prop('disabled', true);
    }

    $("#showPackagePage .modal-manipulate-title").text(!packageTitle ? "Create new" : packageTitle);
    $("#modal-manipulate-package input[name='name_package']").val(packageTitle);
    $("#modal-manipulate-package input[name='duration_package']").val(packageDuration);
    $("#modal-manipulate-package input[name='price_package']").val(packagePrice);
    $("#modal-manipulate-package input[name='token_package']").val(packageToken);
    $("#modal-manipulate-package #benefit_package .ql-editor").html(packageDesc);
});
$("#blogEditPage form .file-custom__label").text('Update cover');
$("#blogEditPage form .file-custom__input").change(function () {
    if ($(this).val().length === 0) {
        $(this).next().text('Update cover');
    }
    else {
        $(this).next().text($(this)[0].files[0].name);
    }
});
$("#blog-add-category input[name='name'], #add_category, #edit_category, input[name='username'], #faq-category")
    .keypress(function (e) {
    if(e.which === 32) return false;
})
$("[data-target='#updateSlider'], [data-target='#deleteSlider']").click(function () {
    let sliderId = $(this).data('id');
    $("#manageMainSliderPage .modal form")
        .attr('action', appUrl + '/manage/main-slider/' + sliderId);
});

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
        formDeleteArticle.action = appUrl + '/admin/manage/blog/' + articleId;
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
        formDeleteCategory.action =  appUrl + '/admin/manage/blog-category/' + idCategory;
    });
});

$('.btn[data-target="#edit-category-article').click(function () {
    let categoryId = Number($(this).data('category-id'));
    let nameCategory = $(this).data('category-name');

    $('.modal-category-name').text(nameCategory);
    $("input[name='edit_category']").val(nameCategory);
    $('#edit-category-article form')
        .attr('action', appUrl + '/admin/manage/blog-category/' + categoryId);
});

const createArticleImg = document.querySelector('#blogCreatePage input[type="file"]')
if (createArticleImg) {
    createArticleImg.required = true;
}

const thisRoute = window.location.protocol + '//' + window.location.host + window.location.pathname;
const navLinks = document.querySelectorAll('.nav-link');
navLinks.forEach(function (navLink) {
    let url = navLink.href;
    if (url === thisRoute) {
        navLink.classList.add('active');
    }
    $("#navbar-components .nav-link.active").parents("#navbar-components").addClass('show');
    $("#navbar-components .nav-link.active").parents("#navbar-components").prev().addClass('active')
        .attr('aria-expanded', "true");
});

const profileNavRoute = window.location.protocol + '//' + window.location.host + window.location.pathname;
const profileNavLinks = document.querySelectorAll('.profile-nav__link');
profileNavLinks.forEach(function (profileNavLink) {
    let url = profileNavLink.href;
    if(url === profileNavRoute ) {
        profileNavLink.classList.add('profile-nav__link--active');
    }
});

$("#servicePage .nav-pills .nav-link:first-child").addClass('active');
$("#servicePage .tab-pane:first-child").addClass('active show');
$("#servicePage .btn[data-target='#modal-delete-service'], #showExtraPage [data-target='#modal-manipulate-extra'], " +
    "#showExtraPage [data-target='#modal-delete-extra']").click(function () {
    let serviceId = Number($(this).data('id'));
    let serviceTitle = $(this).data('title');

    $("#servicePage .modal-service-title").text(serviceTitle);
    if ($(this).attr('id') === 'from-agent') {
        $("#modal-delete-service form").attr("action", appUrl + '/agent/service/' + serviceId);
    }
    else {
        $("#modal-delete-service form").attr("action", appUrl + '/admin/manage/service/' + serviceId);
    }

    if ($(this).attr('id') === 'btn-add-extra') {
        $("#modal-manipulate-extra .modal-manipulate-title").text("Add new extra");
        $("#form-manipulate-extra input, #form-manipulate-extra textarea").val("");
        $("#form-manipulate-extra").attr('action', appUrl + '/admin/manage/service-extras');
    }
    else if ($(this).attr('id') === 'btn-edit-extra') {
        let extraName = $(this).siblings(".extra-item__name").text().trim();
        let extraPrice = Number($(this).siblings(".extra-item__price").text());
        let extraDesc = $(this).data("desc").trim();
        let extraToken = Number($(this).data('token'));

        $("#modal-manipulate-extra input[name='name_extra']").val(extraName);
        $("#modal-manipulate-extra input[name='price_extra']").val(extraPrice);
        $("#modal-manipulate-extra input[name='token_extra']").val(extraToken);
        $("#modal-manipulate-extra textarea[name='benefit_extra']").val(extraDesc);
        $("#modal-manipulate-extra .modal-manipulate-title").text("Edit extra");
        $("#form-manipulate-extra").attr('action', appUrl + '/admin/manage/service-extras/' + serviceId);
    }

    if ($(this).attr('data-target') === '#modal-delete-extra') {
        $("#form-delete-extra").attr('action', appUrl + '/admin/manage/service-extras/' + serviceId);
    }
});

$("#serviceCategoryPage .btn[data-target='#create-edit-category']").click(function () {
    let categoryId = Number($(this).data('category-id'));
    let categoryName = $(this).data('category-name');

    $(".modal#create-edit-category form input[name='service_category']").val(categoryName);
    if ($(this).attr('id') === 'edit-service-category') {
        $("#create-edit-category .modal-title").text('Edit category');
        $("#create-edit-category form").attr('action', appUrl + '/admin/manage/service-category/' + categoryId);
        $("#create-edit-category input[name='name']").val(categoryName);
        $("#create-edit-category input[name='image_url']").prop('required', false);
        $("#create-edit-category label[for='imgCategory']").text('Change icon');
        $("#create-edit-category button[type='submit']").text('Update category');
        $("#create-edit-category form").append("<input type='hidden' name='_method' value='PUT'>");
    }
    else if($(this).attr('id') === 'create-service-category') {
        $("#create-edit-category form input[name='_method']").remove();
        $("#create-edit-category .modal-title").text('Add new category');
        $("#create-edit-category form").attr('action', appUrl + '/admin/manage/service-category');
        $("#create-edit-category form input[name='image_url']").prop('required', true);
        $("#create-edit-category label[for='imgCategory']").text('Pick icon');
        $("#create-edit-category button[type='submit']").text('Add new category');
    }
});
$("#serviceCategoryPage .btn[data-target='#delete-category']").click(function () {
    let categoryId = Number($(this).data('category-id'));
    let categoryName = $(this).parent().find('span').text();

    $("#serviceCategoryPage .service-category-title").text(categoryName);
    $("#serviceCategoryPage #delete-category form")
        .attr('action', appUrl + '/admin/manage/service-category/' + categoryId);
});

$("#manageAgentPage .btn-delete-agent, #manageAgentPage .btn-edit-agent").click(function () {
    let agentId = Number($(this).data('id'));
    let agentName = $(this).parents(".agent__detail").find(".agent__name").text();

    $("#manageAgentPage #form-remove-agent, #form-manipulate-agent").attr('action', appUrl + '/admin/manage/agent/' + agentId);
    $("#modal-manipulate-agent .agent-name, #modal-remove-agent .agent-name").text(agentName);
});

$("#manageAgentPage .btn-edit-agent, #manageAgentPage .btn-create-agent, #manageAgentPage .btn-delete-agent").click(function () {
    let agentName, agentEmail, agentPhone, agentBank, agentAccount, agentAddress;
    switch (true) { //otomatis cari element berdasarkan case dibawah
        case $(this).hasClass('btn-create-agent'):
            agentName = agentEmail = agentPhone = agentBank = agentAccount = agentAddress = "";

            $("#manageAgentPage #modal-manipulate-agent input[name='agent_password']").prop({
                readonly: true,
                required: true
            }).parent(".form-group").show();
            $("#btn-manipulate-agent").text('Add new agent');
            $("#form-manipulate-agent").find("input[name='_method']").prop('disabled', true);
            $("#form-manipulate-agent input[name='agent_name']").val(agentName);
            $("#form-manipulate-agent").attr('action', appUrl + '/admin/manage/agent');
            break;
        case $(this).hasClass('btn-edit-agent'):
            agentName = $(this).parents(".agent__detail").find(".agent__name").text();
            agentEmail = $(this).parents(".agent__detail").find(".agent__email").text();
            agentPhone = $(this).parents(".agent__detail").find(".agent__phone").text();
            agentBank = $(this).parents(".agent__detail").find(".agent__bank").text();
            agentAccount = $(this).parents(".agent__detail").find(".agent__acc-number").text();
            agentAddress = $(this).data('address');

            $("#btn-manipulate-agent").text('Update Agent Details');
            $("#manageAgentPage #modal-manipulate-agent input[name='agent_password']").prop({
                readonly: false,
                required: false
            }).parent(".form-group").hide();
            break;
    }

    $("#form-manipulate-agent").find("input[name='_method']").prop('disabled', false);
    $("#form-manipulate-agent input[name='agent_name']").val(agentEmail);
    $("#form-manipulate-agent select[name='bank'] option:first-child").prop('selected', false);
    $("#form-manipulate-agent input[name='agent_email']").val(agentEmail);
    $("#form-manipulate-agent input[name='agent_phone']").val(agentPhone);
    $(`#form-manipulate-agent select[name="bank"] option[value="${agentBank}"]`).prop('selected', true);
    $("#form-manipulate-agent input[name='agent_account']").val(agentAccount);
    $("#form-manipulate-agent textarea[name='agent_address']").val(agentAddress);
});

$("#agentProfilePage .profile__input").change(function () {
    $(this).parent().submit();
});

$("#agentProfilePage .profile__form-edit .profile__file, .file-custom__input").change(function () {
    let labelText = $(this).data('label');
    if ($(this).val().length !== 0) {
        let nameCard =  $(this)[0].files[0].name;
        if ($(this).attr('id') === 'message_file') {
            $(this).siblings(".file-value").text(nameCard);
        }
        else {
            $(this).next().text(nameCard);
        }
    }
    else {
        if ($(this).attr('id') === 'message_file') {
            $(this).siblings(".file-value").text("");
        }
        else {
            $(this).next().text(labelText);
        }
    }
});

$("#singleServicePage .file-custom__input").change(function () {
    if ($(this).val().length !== 0) {
        $(this).siblings('.file-value').html("<i class='bx bx-check-circle' ></i> file selected");
    }
    else {
        $(this).siblings('.file-value').html('');
    }
});

$("#serviceEditPage #service-edit-form #serviceLogo").change(function () {
    if ($(this).val().length !== 0) {
        let nameCard =  $(this)[0].files[0].name;
        $(this).next().text(nameCard);
    }
    else {
        $(this).next().text("Update Logo");
    }
});

$("#manageJobPage .profile-main__btn-edit-job").click(function () {
    let jobTitle = $(this).parents(".profile-main-item").find(".job-title").text();
    let jobStartTime = $(this).parents(".profile-main-item").find(".job-start").text();
    let jobEndTime = $(this).parents(".profile-main-item").find(".job-end").text();
    let jobDesc = $(this).parents(".profile-main-item").find(".job-description").text();

    $("#modal-edit-job input[name='job_title").val(jobTitle);
    $("#modal-edit-job input[name='job_start_time']").val(jobStartTime);
    $("#modal-edit-job input[name='job_end_time']").val(jobEndTime);
    $("#modal-edit-job textarea[name='detail_job']").val(jobDesc);
});
$("#manageJobPage .profile-main__btn-delete-job").click(function () {
    let jobTitle = $(this).parents(".profile-main-item").find(".job-title").text();
    $(".modal__job-title").text(jobTitle);
});

let faqCategoryActive = $("#faqPage .jq-tab-title.active").data('tab');
let faqActive = $(".question-answer__item[data-tab=" + faqCategoryActive +"]");
faqActive.hide();

const faqTotal = $("#faqPage .question-answer__item").length;
let showFaq = 10;
faqActive.slice(0, showFaq - 1).show();
$(".question-answer__show-more").click(function (e) {
    e.preventDefault();
    showFaq = (showFaq + 5 <= faqTotal) ? showFaq + 5 : faqTotal;
    faqActive.slice(0, showFaq - 1).show();
    if (showFaq === faqTotal) $(".question-answer__show-more").hide()
});

$(".dropdown-item--delete-promo").click(function () {
    let promoId = Number($(this).data('id'));
    let promoName = $(this).parents('tr').find('.promo-name').text();

    $("#deletePromo .modal-promo-title").text(promoName);
    $("#deletePromo form").attr('action', appUrl + '/admin/manage/promo/' + promoId);
});
$(".dropdown-item--edit-promo").click(function () {
    let promoId = Number($(this).data('id')),
        promoName = $(this).parents('tr').find('.promo-name').text(),
        promoStart = $(this).parents('tr').find('.promo-start').text(),
        promoEnd = $(this).parents('tr').find('.promo-end').text(),
        promoCode = $(this).parents('tr').find('.promo-code').text(),
        promoDisc = $(this).parents('tr').find('.promo-disc').text(),
        promoLimit = $(this).parents('tr').find('.promo-limit').text();

    $("#editPromo form input[name='promo_name']").val(promoName);
    $("#editPromo form input[name='promo_start']").val(promoStart);
    $("#editPromo form input[name='promo_start']").data('datepicker').selectDate(new Date(promoStart));
    $("#editPromo form input[name='promo_end']").val(promoEnd);
    $("#editPromo form input[name='promo_end']").data('datepicker').selectDate(new Date(promoEnd));
    $("#editPromo form input[name='promo_code']").val(promoCode);
    $("#editPromo form input[name='promo_discount']").val(parseInt(promoDisc));
    $("#editPromo form input[name='promo_limit']").val(parseInt(promoLimit));
    $("#editPromo form").attr('action', appUrl + '/admin/manage/promo/' + promoId);
});

$(".dropdown-item--edit-subscription, .dropdown-item--delete-subscription").click(function () {
        let subscriptionId = Number($(this).data('id')),
            subscriptionDesc = $.trim($(this).data('desc')),
            subscriptionName = $.trim($(this).data('title')),
            subscriptionToken = Number($(this).data('token')),
            subscriptionPrice = Number($(this).data('price')),
            subscriptionDuration = Number($(this).data('duration'));

        $("#editSubscription .modal-subscription-title, #deleteSubscription .modal-subscription-title")
            .text(subscriptionName);
        $("#editSubscription form, #deleteSubscription form")
            .attr('action', appUrl + '/admin/manage/subscription/' + subscriptionId);
        $("#editSubscription input[name='title']").val(subscriptionName);
        $("#editSubscription textarea[name='desc']").val(subscriptionDesc);
        $("#editSubscription input[name='token']").val(subscriptionToken);
        $("#editSubscription input[name='duration']").val(subscriptionDuration);
        $("#editSubscription input[name='price']").val(subscriptionPrice);
        $("#editSubscription textarea[name='desc']").summernote('code', subscriptionDesc);
    });

//plugin & general
if ($(".progress-job").length) {
    $(".progress-job").slider({
        max: 100,
        step: 1,
        orientation: 'horizontal',
        range: false,
        tooltip: 'show'
    }).on('change', function () {
        let valueProgressJob = $(".progress-job").slider('getValue');
        $("#progress-job-val").text(valueProgressJob);
    });
}

const order = $('input[name="order_id"]');
const chatUrl = $('.order-chat__send-box').attr('action');
const orderId = $('input[name="order_id"]').val();
let getChatUrl;
if (window.location.pathname.indexOf('agent/order/') > -1) {
    getChatUrl = '/agent/order/' + orderId + '/get-chat';
}
else if (window.location.pathname.indexOf('user/order/') > -1) {
    getChatUrl = '/user/order/' + orderId + '/get-chat';
}

$("[data-target='#delete-message-customer']").click(function () {
    let messageId = $(this).data('id');
    let messageSender = $(this).data('sender');

    $("#delete-message-customer .modal-message-sender").text(messageSender);
    $("#delete-message-customer form").attr('action', appUrl + '/admin/manage/contact-us/' + messageId);
});

$('#readMessagePage .accordion__item form').submit(function (e) {
    e.preventDefault();
    let formSubmit = $(this);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: formSubmit.attr('action'),
        method: 'put',
        data: {
            answer: formSubmit.find("textarea[name='answer']").val()
        },
        beforeSend: function() {
            $("#modalLoader").modal('show');
        },
        success: function(){
            $(".alert").show().delay(1000).fadeOut('slow');
            $("#modalLoader").modal('hide');
        },
        error: function(xhr) {
            console.log(xhr.statusText + xhr.responseText);
            $("#modalLoader").modal('hide');
        },
    });
});

$("#readMessagePage .accordion__item input").filter("[readonly]").parent().siblings(".is-answered").removeClass("d-none");

$('.order-chat__send-box').submit(function (e) {
    e.preventDefault();
    let token = $('meta[name="csrf-token"]').attr('content');
    var formData = new FormData();
    formData.append('sender_id', $('input[name="sender_id"]').val());
    formData.append('order_id', $('input[name="order_id"]').val());
    formData.append('message' ,$('input[name="message"]').val());
    formData.append('image' ,$('input[name="image"]').prop('files')[0]);
    fetch(chatUrl,{
        headers: {
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
        },
        method : 'POST',
        body : formData,
    }).then((data) => {
        $('.order-chat__send-box')[0].reset();
    }).catch(function(error) {
        console.log(error);
    });

    $("#loader-sendChat").removeClass('d-none');

});

setInterval(function () {
    $.get(getChatUrl, function (data) {
        $("#chat-list").empty().html(data);
    });
}, 3000);

$("img").prop('draggable', false);
$(".alert").not(".no-fadeout").not('#alert-approve').delay(3000).fadeOut('slow');

$("#editPromo input[name='promo_end']").datepicker({
    minDate: new Date($("#editPromo input[name='promo_start']").val())
});
$("#editPromo #edit-promo-start").blur(function () {
    $("#editPromo #edit-promo-end").datepicker({
        minDate: new Date($("#editPromo #edit-promo-start").val())
    });
});
$("#editPromo input[name='promo_start']").datepicker({
    minDate: new Date()
});
$("#addPromo #add-promo-end, #addPromo #add-promo-start").datepicker({
    minDate: new Date()
});
$("#addPromo #add-promo-start").blur(function () {
    $("#add-promo-end").datepicker({
        minDate: new Date($("#add-promo-start").val())
    });
});

const getDate = new Date().getFullYear();
$("#footer_date, #footer__time").text(getDate);

if (window.location.href.indexOf('admin') > -1 || window.location.href.indexOf('agent') > -1) {
    bsCustomFileInput.init();
}

if ($(window).width() > 768) {
    if ($("#faqs").length === 1) {
        $('#faqs').jqTabs({
            direction: 'vertical'
        });
    }
}
else {
    if ($("#faqs").length === 1) {
        $('#faqs').jqTabs({
            direction: 'horizontal'
        });
    }
}

const fileImage = $('input[accept="image/*"]');
fileImage.parent().prev().attr('id', 'cover-preview');
fileImage.change(function(){
    if (this.files && this.files[0] && this.files.length !== 0) {
        let reader = new FileReader();
        reader.onload = function (e) {
            $('#cover-preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    }
    else {
        $('#cover-preview').attr('src', '');
    }
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
$("#client .client__slider").slick({
    infinite: false,
    prevArrow: "<a href='javascript:void(0);' class='bx bxs-chevron-left'></a>",
    nextArrow: "<a href='javascript:void(0);' class='bx bxs-chevron-right'></a>",
    adaptiveHeight: false,
    slidesToShow: 3,
    slidesToScroll: 3,
    swipeToSlide: true,
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
const inspireSlider = $("#inspire .inspire__slider");
inspireSlider.slick({
    autoplay: true,
    arrows: false,
    infinite: false,
    adaptiveHeight: false,
    slidesToShow: 3,
    slidesToScroll: 3,
    swipeToSlide: true,
    responsive: [
        {
            breakpoint: 993,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
});
const totalInspire = inspireSlider.find('.slick-slide:not(.slick-cloned)').length;
if (totalInspire > 3) {
    inspireSlider.on('wheel', (function(e) {
        e.preventDefault();
        if (e.originalEvent.deltaY < 0) {
            $(this).slick('slickNext');
        }
        else {
            $(this).slick('slickPrev');
        }
    }));
}

$("#testimonies .testimonies-slider").slick({
    infinite: false,
    prevArrow: "<a href='javascript:void(0);' class='bx bxs-chevron-left'></a>",
    nextArrow: "<a href='javascript:void(0);' class='bx bxs-chevron-right'></a>",
    adaptiveHeight: false,
    slidesToShow: 3,
    slidesToScroll: 3,
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

$(".profile-main__orderBy, #blogCategoryPage .category-header__filter, "+
    ".service-single__filter-review, .nice-select").niceSelect();

$(".profile-main__orderBy, #blogCategoryPage .category-header__filter").change(function () {
    $(this).parents("form").submit();
});
$("#servicesPage .category [id^='service-slider']").slick({
    infinite: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    mobileFirst: true,
    nextArrow: '<a href="javascript:void(0);" class="slick-next"><i class="bx bxs-chevron-right"></i></a>',
    prevArrow: '<a href="javascript:void(0);" class="slick-prev"><i class="bx bxs-chevron-left"></i></a>',
    responsive: [
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
        },
        {
            breakpoint: 993,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3
            }
        },
        {
            breakpoint: 1200,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 4
            }
        }
    ]
});

//quill js plugin
if (window.location.href.indexOf('admin') === -1) {
    if ($(".search-service__input").length > 0) {
        const flexdatalist = $(".search-service__input").flexdatalist({
            minLength: 1,
            cache: false,
            searchContain: true
        });
        $(".search-service__input").on('select:flexdatalist', function (event, set, options) {
            $(this).parent().submit()
        });
    }
}

if ($("#servicePage #service-rich-desc").length > 0) {
    const serviceDesc = $("#servicePage #service-rich-desc").get(0);
    const quillName = $("#servicePage #service-rich-desc").data('name');
    const textareaServiceDesc = $(`<textarea name="${quillName}" class="d-none" required>`).insertAfter(serviceDesc);
    let richServiceDesc = new Quill(serviceDesc, {
        theme: 'snow',
        placeholder: 'Place description here . . .'
    });
    richServiceDesc.on('editor-change', function () {
        let serviceDescVal = $("#servicePage #service-rich-desc .ql-editor").html();
        textareaServiceDesc.val(serviceDescVal);
    });
}
if ($("#showPackagePage #benefit_package").length > 0) {
    const serviceDesc = $("#showPackagePage #benefit_package").get(0);
    const quillName = $("#showPackagePage #benefit_package").data('name');
    const textareaServiceDesc = $(`<textarea name="${quillName}" class="d-none" required>`).insertAfter(serviceDesc);
    let richServiceDesc = new Quill(serviceDesc, {
        theme: 'snow',
        placeholder: 'What will they get if using this package . . .'
    });
    richServiceDesc.on('editor-change', function () {
        let serviceDescVal;
        if (richServiceDesc.getLength() > 0) {
            serviceDescVal = $("#showPackagePage #benefit_package .ql-editor").html();
            textareaServiceDesc.val(serviceDescVal);
        }
        else {
            textareaServiceDesc.val("");
        }
    });
}
if ($('#blog-content').length > 0) {
    const blogContent = $('#blog-content').get(0);
    new Quill(blogContent, {
        theme: 'snow',
        placeholder: 'Insert content here . . .',
    });
    $("#blogEditPage form, #blogCreatePage form").submit(function () {
        let getBlogContent = $("#blog-content .ql-editor").html();
        $('textarea[name="contents"]').val(getBlogContent);
    });
}
//end of quill js

$("#serviceEditPage textarea[name='service_description'], " +
    "textarea[name='detail_job'], #editSubscription textarea[name='desc']").summernote({
    minHeight: 300
});
$("#addSubscription textarea[name='desc']").summernote({
    placeholder: 'Everything include in this subscription',
    minHeight: 300
});

if ($('#service-package-tab').length === 1) {
    $("#service-package-tab").jqTabs({
        direction: 'horizontal',
        mainWrapperClass: 'single-package'
    });
}

$(".datepicker-here").datepicker({
    language: 'en',
    dateFormat: 'yyyy-mm-dd'
});

if ($(".review-rating").length > 0) {
    $(".review-rating").addRating({
        fieldName: 'rating'
    });
}
$(".review-rating .material-icons").mouseenter(function () {
    $(this).css('color', '#151942').prevAll().css('color', '#151942');
}).mouseleave(function () {
    $(this).removeAttr('style');
});

$("#editPromo #edit-promo-start, #addPromo #add-promo-start").datepicker({
    minDate: new Date()
});
// user order dashboard page
$('.btn-pay').click(function(){
    let token = $(this).data('payment-token');
    snap.pay(token);
});

// user subscribe show page
$('#subscribe-form').submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function (response) {
            if (response.status === 'success') {
                snap.pay(response.token); // redirect to user/order after payment
            }
            else {
                alert('something went wrong with your order');
                // snap.hide();
            }
        },
        error: function(response){
            console.log(response);
            alert('failed to get payment token');
            // snap.hide();
        }
    });
});
