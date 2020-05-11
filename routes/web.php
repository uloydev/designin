<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify'=>true]);

Route::get('/', 'HomeController@index')->name('landing-page');
Route::get('services/search', 'HomeController@serviceSearch');
Route::get('services', 'HomeController@services')->name('services');
Route::get('contact-us', 'ContactController@index')->name('contact-us.index');
Route::get('faq', 'HomeController@faq')->name('faq.index');
Route::get('testimony', 'HomeController@testimonies')->name('testimony');
Route::resource('blog', 'BlogController')->only(['index', 'show']);
Route::resource('blog/categories', 'BlogCategoryController')->names([
    'index' => 'blog-category.index',
    'create' => 'blog-category.create',
    'show' => 'blog-category.show',
    'edit' => 'blog-category.edit',
    'update' => 'blog-category.update',
    'destroy' => 'blog-category.destroy'
]);
Route::post('contact-us', 'ContactController@contactUs');

Route::namespace('Admin')->middleware('admin')->prefix('admin')->group(function () {
    Route::get('dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::get('setting', 'AdminController@setting')->name('admin.setting');
    Route::prefix('manage')->name('manage.')->group(function(){
        Route::get('/', 'HomeController@index');
        Route::get('agent/search', 'AgentController@search')->name('agent.search');
        Route::resource('user', 'UserController');
        Route::resource('agent', 'AgentController');
        Route::resource('admin', 'AdminController')->except('index');
        Route::resource('faq', 'FaqController')->except(['show']);
        Route::resource('blog', 'BlogController');
        Route::resource('blog-category', 'BlogCategoryController');
        Route::resource('service', 'ServiceController')->except(['create']);
        Route::resource('service-category', 'ServiceCategoryController')->except(['create', 'show', 'edit']);
        Route::resource('contact-us', 'ContactController')->except(['create', 'store', 'show']);
        Route::resource('testimony', 'TestimonyController')->only(['index', 'update', 'destroy']);
    });
});

Route::name('user.')->prefix('user')->middleware(['auth', 'verified'])->group(function () {
    Route::prefix('profile')->middleware('profile')->group(function () {
        Route::get('/', 'ProfileController@index')->name('profile.index');
        Route::get('edit', 'ProfileController@edit')->name('profile.edit');
        Route::put('edit', 'ProfileController@update')->name('profile.update');
        Route::put('edit/avatar', 'ProfileController@avatarUpdate')->name('profile.avatar.update');
    });
    Route::namespace('User')->group(function() {
        Route::get('dashboard', 'HomeController@index')->name('dashboard');
        Route::resource('testimony', 'TestimonyController')->only(['index', 'create', 'store']);
    });
});

Route::prefix('agent')->name('agent.')->middleware(['agent', 'verified'])->group(function () {
    Route::put('edit/avatar', 'ProfileController@avatarUpdate')->name('profile.avatar.update');
    Route::resource('profile', 'ProfileController');
    Route::namespace('Agent')->group(function () {
        Route::redirect('/', 'dashboard');
        Route::get('dashboard', 'HomeController@index')->name('dashboard');
        Route::get('testimony', 'TestimonyController@index')->name('testimony.index');
        Route::get('testimony/{service_id}', 'TestimonyController@show')->name('testimony.show');
        Route::resource('service', 'ServiceController');
        Route::resource('portfolio', 'PortfolioController');
    });
});
