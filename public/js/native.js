//user js
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

let serviceId = $("#serviceEditPage #service-edit-form input[name='service_id']").val();
if (window.location.href.pathname === '/agent/service/' + serviceId + '/edit') {
    $("#serviceEditPage #service-edit-form")
        .attr('action', window.location.origin + '/agent/service/' + serviceId);
}
else if (window.location.href.pathname === '/admin/manage/service/' + serviceId + '/edit') {
    $("#serviceEditPage #service-edit-form")
        .attr('action', window.location.origin + '/admin/manage/service/' + serviceId);
}

if (window.location.pathname === '/agent/service') {
    $("#servicePage #form-add-service").attr('action', window.location.origin + '/agent/service');
}
else if (window.location.pathname === '/admin/manage/service') {
    $("#servicePage #form-add-service").attr('action', window.location.origin + '/admin/manage/service');
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
let originalPrice = $(".order-price").text().replace(/IDR /g, '');
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
    $("#modal-single-order form").attr('action', window.location.origin + '/order/package/' + packageId);
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
    $(".modal-order-price").text($(".order-price").text().replace(/IDR /g, ''));
    $("#modal-single-extras input[name='extras']").prop('checked', false);
    window.location.replace(window.location.href);
});

$("#modal-single-extras .modal-order-price").attr('data-original-price', originalPrice);
$("#modal-single-extras #grand-total").text(grand_total);

function grandTotal() {
    totalExtras = 0;
    let input = document.getElementsByName("extras");
    for (let i = 0; i < input.length; i++) {
        if (input[i].checked) {
            totalExtras += Number(input[i].dataset.priceCash);
        }
    }
    if (document.querySelector('#total_extras')) { //if element #total_extras exist
        document.querySelector("#total_extras").value = "IDR " + totalExtras.toFixed(2);
    }
    let price = Number($("#singleServicePage .order-price").text().replace(/IDR /, '')) * orderQuantity;
    if (promo_discount !== 0) {
        newPrice =  Math.ceil(price - price * promo_discount / 100);
    }else{
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
    $("#modal-single-extras #grand-total").text(grand_total);
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

$("#promo-code").focusout(function () {
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
    if ($("#modal-single-order #data-extras").val().length === 0 || $("#modal-single-order #data-extras").val() === '[]') {
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
}

//agent js
$("[data-target='#modal-progress'], [data-target='#modal-approval'], [data-target='#modal-rejection'], " +
    "[data-target='#modal-result']").click(function () {
    let jobTitle = $.trim($(this).parents(".accordion__item").find(".job-agent-title").text());
    let jobId = $(this).data('id');
    let customerEmail = $(this).parents(".accordion__item").find(".customer-email").text();
    let jobProgress = $(this).data('progress');
    const routingListRequest = window.location.origin + '/agent/list-request';

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
        .attr('action', window.location.origin + '/agent/list-request/delete/' + historyId);
    $("#delete-history-job .modal-job-history-title").text(historyTitle);
});

$("[data-target='#modal-revision']").click(function () {
    let revisionId = $(this).data('id');
    const routingListRequest = window.location.origin + '/agent/list-request';

    $("#modal-revision form").attr('action', routingListRequest + '/send-revision/' + revisionId);
});

//admin js
$("[data-target='#updateSlider'], [data-target='#deleteSlider']").click(function () {
    let sliderId = $(this).data('id');
    $("#manageMainSliderPage .modal form")
        .attr('action', window.location.origin + '/manage/main-slider/' + sliderId);
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
        formDeleteArticle.action = window.location.origin + '/admin/manage/blog/' + articleId;
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
        formDeleteCategory.action =  window.location.origin + '/admin/manage/blog-category/' + idCategory;
    });
});

$('.btn[data-target="#edit-category-article').click(function () {
    let categoryId = Number($(this).data('category-id'));
    let nameCategory = $(this).data('category-name');

    $('.modal-category-name').text(nameCategory);
    $("input[name='edit_category']").val(nameCategory);
    $('#edit-category-article form')
        .attr('action', window.location.origin + '/admin/manage/blog-category/' + categoryId);
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
    let serviceId = Number($(this).data("id"));
    let serviceTitle = $(this).data('title');

    $("#servicePage .modal-service-title").text(serviceTitle);
    if ($(this).attr('id') === 'from-agent') {
        $("#modal-delete-service form").attr("action", window.location.origin + '/agent/service/' + serviceId);
    }
    else {
        $("#modal-delete-service form")
            .attr("action", window.location.origin + '/admin/manage/service/' + serviceId);
    }

    if ($(this).attr('id') === 'btn-add-extra') {
        $("#modal-manipulate-extra .modal-manipulate-title").text("Add new extra");
        $("#form-manipulate-extra input, #form-manipulate-extra textarea").val("");
        $("#form-manipulate-extra").attr('action', window.location.origin + '/admin/manage/service-extras');
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
        $("#form-manipulate-extra").attr('action', window.location.origin + '/admin/manage/service-extras/' + serviceId);
    }

    if ($(this).attr('data-target') === '#modal-delete-extra') {
        $("#form-delete-extra").attr('action', window.location.origin + '/admin/manage/service-extras/' + serviceId);
    }
});

$("#serviceCategoryPage .btn[data-target='#create-edit-category']").click(function () {
    let categoryId = Number($(this).data('category-id'));
    let categoryName = $(this).data('category-name');

    $(".modal#create-edit-category form input[name='service_category']").val(categoryName);
    if ($(this).attr('id') === 'edit-service-category') {
        $("#create-edit-category .modal-title").text('Edit category');
        $("#create-edit-category form").attr('action', window.location.origin + '/admin/manage/service-category/' + categoryId);
        $("#create-edit-category input[name='name']").val(categoryName);
        $("#create-edit-category input[name='image_url']").prop('required', false);
        $("#create-edit-category label[for='imgCategory']").text('Change icon');
        $("#create-edit-category button[type='submit']").text('Update category');
        $("#create-edit-category form").append("<input type='hidden' name='_method' value='PUT'>");
    }
    else if($(this).attr('id') === 'create-service-category') {
        $("#create-edit-category form input[name='_method']").remove();
        $("#create-edit-category .modal-title").text('Add new category');
        $("#create-edit-category form").attr('action', window.location.origin + '/admin/manage/service-category');
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
        .attr('action', window.location.origin + '/admin/manage/service-category/' + categoryId);
});

$("#manageAgentPage .btn[data-target='#modal-remove-agent'], " +
    "#manageAgentPage .btn[data-target='#modal-edit-agent']").click(function () {
    if ($(this).attr('id') === 'btn-create-agent') {
        $("button[form='form-edit-agent']").text('Add new agent');
        $("#manageAgentPage #modal-edit-agent form").find("input[name='_method']").prop('disabled', true);
        $("#manageAgentPage #modal-edit-agent form")
            .attr('action', window.location.origin + '/admin/manage/agent/');
    }
    else {
        let agentId = Number($(this).data('id')),
            agentName = $(this).parents("tr").find("#agent__name").text(),
            agentEmail = $(this).parents("tr").find("#agent__email").text(),
            agentPhone = $(this).parents("tr").find("#agent__phone").text(),
            agentBank = $(this).parents("tr").find("#agent__bankbank").text(),
            agentAccount = $(this).parents("tr").find("#agent__acc-number").text(),
            agentAddress = $(this).data('address');

        if ($(this).hasClass('edit-agent')) {
            $("#manageAgentPage #form-edit-agent").find("input[name='_method']").prop('disabled', false);
        }

        $("#manageAgentPage #form-edit-agent input[name='agent_name']").val(agentName);
        $("#manageAgentPage #form-edit-agent input[name='agent_email']").val(agentEmail);
        $("#manageAgentPage #form-edit-agent input[name='agent_phone']").val(agentPhone);
        $("#manageAgentPage #form-edit-agent input[name='agent_bank']").val(agentBank);
        $("#manageAgentPage #form-edit-agent input[name='agent_account']").val(agentAccount);
        $("#manageAgentPage #form-edit-agent textarea[name='agent_address']").val(agentAddress);
        $("#manageAgentPage .agent-name").text(agentName);
        $("#manageAgentPage .modal[id*='agent'] form")
            .attr('action', window.location.origin + '/admin/manage/agent/' + agentId);
    }
});

$("#agentProfilePage .profile__input").change(function () {
    $(this).parent().submit();
});

$("#agentProfilePage .profile__form-edit .profile__file, .file-custom__input").change(function () {
    let labelText = $(this).data('label');
    let fileValue = $(this).val();
    if (fileValue.trim().length !== 0) {
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
    if ($.trim($(this).val()).length !== 0) {
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
    const jobEditModal = $("#modal-edit-job");

    jobEditModal.find("input[name='job_title").val(jobTitle);
    jobEditModal.find("input[name='job_start_time']").val(jobStartTime);
    jobEditModal.find("input[name='job_end_time']").val(jobEndTime);
    jobEditModal.find("textarea[name='detail_job']").val(jobDesc);
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

$("#add_category, #edit_category").keypress(function (e) {
    if (e.which === 32) return false;
});

$(".dropdown-item[data-target='#deletePromo']").click(function () {
    let promoId = Number($(this).data('id'));
    let promoName = $(this).parents('tr').find('.promo-name').text();

    $("#deletePromo .modal-promo-title").text(promoName);
    $("#deletePromo form").attr('action', window.location.origin + '/admin/manage/promo/' + promoId);
});
$(".dropdown-item[data-target='#editPromo']").click(function () {
    let promoId = Number($(this).data('id'));
    let promoName = $(this).parents('tr').find('.promo-name').text();
    let promoStart = $(this).parents('tr').find('.promo-start').text();
    let promoEnd = $(this).parents('tr').find('.promo-end').text();
    let promoCode = $(this).parents('tr').find('.promo-code').text();
    let promoDisc = $(this).parents('tr').find('.promo-disc').text();

    $("#editPromo form input[name='promo_name']").val(promoName);
    $("#editPromo form input[name='promo_start']").val(promoStart);
    $("#editPromo form input[name='promo_start']").data('datepicker').selectDate(new Date(promoStart));
    $("#editPromo form input[name='promo_end']").val(promoEnd);
    $("#editPromo form input[name='promo_end']").data('datepicker').selectDate(new Date(promoEnd));
    $("#editPromo form input[name='promo_code']").val(promoCode);
    $("#editPromo form input[name='promo_discount']").val(promoDisc);

    $("#editPromo form").attr('action', window.location.origin + '/admin/manage/promo/' + promoId);
});

$("[data-target='#editSubscription'], [data-target='#deleteSubscription']")
    .click(function () {
        let subscriptionId = Number($(this).data('id')),
            subscriptionDesc = $.trim($(this).data('desc')),
            subscriptionName = $.trim($(this).data('title')),
            subscriptionToken = Number($(this).data('token')),
            subscriptionPrice = Number($(this).data('price')),
            subscriptionDuration = Number($(this).data('duration'));

        $("#editSubscription .modal-subscription-title, #deleteSubscription .modal-subscription-title")
            .text(subscriptionName);
        $("#editSubscription form, #deleteSubscription form")
            .attr('action', window.location.origin + '/admin/manage/subscription/' + subscriptionId);
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

    fetch(chatUrl,{
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
        },
        method : 'POST',
        body : JSON.stringify({
            'sender_id' : $('input[name="sender_id"]').val(),
            'order_id' : $('input[name="order_id"]').val(),
            'message' : $('input[name="message"]').val()
        }),
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
$(".alert").not(".no-fadeout").not('#alert-approve').delay(2000).fadeOut('slow');

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
inspireSlider.on('wheel', (function(e) {
    e.preventDefault();
    if (e.originalEvent.deltaY < 0) {
        $(this).slick('slickNext');
    }
    else {
        $(this).slick('slickPrev');
    }
}));

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

$("#blog-content").summernote({
    placeholder: 'Insert your content here',
    minHeight: 300
});

$("#servicePage textarea[name='description'], #serviceEditPage textarea[name='service_description'], " +
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
$('#pay-button').click(function(){
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
                snap.pay(response.token);
                // redirect to user/order after payment
            }else{
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
