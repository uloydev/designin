<?php

use App\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify'=>true]);
// Route::get('login', 'Auth\LoginController@loginlogin')->name('login');

Route::get('/', 'HomeController@index')->name('landing-page');
Route::get('services/search', 'HomeController@searchAgentJob')->name('service.search');
Route::get('services', 'HomeController@services')->name('services');
Route::get('service/show/{id}', 'HomeController@showService')->name('service.show');
Route::get('subscription/show/{id}', 'HomeController@showSubscription')->name('subscription.show');
// Route::post('service/show/{id}/contact', 'HomeController@contactAgent')->name('service.contact');
// Route::redirect('/service/show/{id}/contact', '/service/show/{id}');
Route::post('order/package/{id}', 'HomeController@makeOrder')->name('order.store')->middleware('auth');
Route::post('order/package/{id}/payment', 'PaymentController@orderPayment')->name('order.payment');
Route::get('order/package/{id}', 'HomeController@redirectOrderPage');
Route::post('payment/notification', 'PaymentController@notification');
Route::get('promo/check', 'HomeController@checkPromoCode')->name('promo.check');
Route::get('contact-us', 'ContactController@index')->name('contact-us.index');
//Route::get('faq/search', 'HomeController@searchFaq')->name('faq.search');
Route::get('faq', 'HomeController@faq')->name('faq.index');
Route::get('testimony', 'HomeController@testimonies')->name('testimony');
Route::resource('blog', 'BlogController')->only(['index', 'show']);
Route::get('search/blog', 'BlogController@search')->name('blog.search');
Route::get('search/agentjob', 'HomeController@searchAgentJob')->name('agentjob.search');
Route::get('blog/categories/{id}', 'BlogCategoryController@show')->name('blog-category.show');
Route::resource('manage/main-slider', 'LandingHeaderSliderController', ['as' => 'manage'])->only(['store', 'update', 'destroy']);
Route::name('message.')->prefix('message')->middleware('exceptAdmin')->group(function () {
    Route::get('/', 'MessageController@index')->name('index');
    Route::get('fetch/{session_id}', 'MessageController@fetch')->name('fetch');
    Route::post('send/{session_id}', 'MessageController@send')->name('send');
});
Route::post('contact-us', 'ContactController@send')->name('contact-us.store');
Route::get('payment/redirect', 'PaymentController@redirect')->name('payment.redirect');

Route::namespace('Admin')->middleware('admin')->prefix('admin')->group(function () {
    Route::get('dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::get('setting', 'AdminController@setting')->name('admin.setting');
    Route::put('token-conversion', 'AdminController@updateToken')->name('admin.convert-token');
    Route::prefix('manage')->name('manage.')->group(function(){
        Route::get('/', 'HomeController@index');
        Route::get('agent/search', 'AgentController@search')->name('agent.search');
        Route::resource('user', 'UserController');
        Route::resource('agent', 'AgentController');
        Route::resource('admin', 'AdminController')->except('index');
        Route::resource('faq', 'FaqController')->except(['show']);
        Route::resource('blog', 'BlogController');
        Route::resource('blog-category', 'BlogCategoryController')->only(['store', 'update', 'destroy']);
        Route::resource('service', 'ServiceController')->except(['create']);
        Route::resource('service-category', 'ServiceCategoryController')->except(['create', 'show', 'edit']);
        Route::get('contact-us/search', 'ContactController@search')->name('contact-us.search');
        Route::resource('contact-us', 'ContactController')->except(['create', 'store', 'show']);
        Route::resource('testimony', 'TestimonyController')->only(['index', 'update', 'destroy']);
        Route::resource('promo', 'PromoController')->except(['create', 'show', 'edit']);
        Route::resource('subscription', 'SubscriptionController');
        Route::resource('reason', 'ReasonController')->except(['show']);
        Route::get('package/{id}', 'PackageController@index')->name('package.index');
        Route::resource('package', 'PackageController')->except(['index']);
        Route::get('service-extras/{id}', 'ServiceExtrasController@index')->name('service-extras.index');
        Route::resource('service-extras', 'ServiceExtrasController')->except(['index']);
    });
});

Route::name('user.')->prefix('user')->middleware(['auth', 'verified'])->group(function () {
    Route::resource('subscription', 'SubscriptionController');
    Route::Post('subscription/show/{id}/payment', 'PaymentController@subscriptionPayment')->name('subscription.payment');
    Route::get('order/{id}/chat', 'MessageController@chat')->name('chat.index');
    Route::get('order/{id}/get-chat', 'MessageController@getChat')->name('chat.get');
    Route::post('order/chat', 'MessageController@sendChat')->name('chat.store');
    Route::prefix('profile')->group(function () {
        Route::get('/', 'ProfileController@index')->name('profile.index');
        Route::get('edit', 'ProfileController@edit')->name('profile.edit');
        Route::put('edit', 'ProfileController@update')->name('profile.update');
        Route::put('edit/avatar', 'ProfileController@avatarUpdate')->name('profile.avatar.update');
    });
    Route::namespace('User')->group(function() {
        Route::get('dashboard', 'HomeController@index')->name('dashboard');
        Route::resource('order', 'OrderController');
        Route::resource('job', 'JobController');
        Route::resource('testimony', 'TestimonyController')->only(['index', 'create', 'store']);
        Route::resource('transaction', 'TransactionController');
    });
});

Route::prefix('agent')->name('agent.')->middleware(['agent', 'verified'])->group(function () {
    Route::get('order/{id}/chat', 'MessageController@chat')->name('chat.index');
    Route::post('order/chat', 'MessageController@sendChat')->name('chat.store');
    Route::get('order/{id}/get-chat', 'MessageController@getChat')->name('chat.get');
    Route::prefix('profile')->group(function () {
        Route::get('/', 'ProfileController@index')->name('profile.index');
        Route::put('edit', 'ProfileController@update')->name('profile.update');
        Route::put('edit/avatar', 'ProfileController@avatarUpdate')->name('profile.avatar.update');
    });
    Route::namespace('Agent')->group(function () {
        Route::get('bid-history', 'OrderController@bidHistory')->name('bid-history');
        Route::redirect('/', 'dashboard');
        Route::get('dashboard', 'HomeController@index')->name('dashboard');
        Route::get('testimony', 'TestimonyController@index')->name('testimony.index');
        Route::get('testimony/{service_id}', 'TestimonyController@show')->name('testimony.show');
        Route::get('service/see-extras/{id}', 'ServiceController@seeExtras')->name('service.extras');
        Route::resource('service', 'ServiceController');
        Route::get('service/manage-package/{id}', 'ServiceController@managePackage')->name('service.package');
        Route::get('list-request/complaint', 'OrderController@complaint')->name('list-request.complaint');
        Route::get('list-request/history', 'OrderController@history')->name('list-request.history');
        Route::get('list-request/incoming', 'OrderController@incoming')->name('list-request.incoming');
        Route::put('list-request/approval/{id}', 'OrderController@approval')->name('list-request.approval');
        Route::put('list-request/progress/{id}', 'OrderController@progressUpdate')->name('list-request.progress');
        Route::post('list-request/send-review/{id}', 'OrderController@sendReview')->name('list-request.send-review');
        Route::post('list-request/send-result/{id}', 'OrderController@sendResult')->name('list-request.send-result');
        Route::post('list-request/send-revision/{id}', 'OrderController@sendRevision')->name('list-request.send-revision');
        Route::get('list-request/search', 'OrderController@search')->name('list-request.search');
        Route::resource('list-request', 'OrderController');
        Route::resource('portfolio', 'PortfolioController');

        //preview mailable
        Route::get('accept', function () {
            $invoice = Order::findOrFail(3);
            if ($invoice->status == 'canceled' or $invoice->status == 'process') {
                return new App\Mail\OrderAcceptedNotification($invoice);
            }
            else {
                return "you don't need an email";
            }
        });
    });
});
