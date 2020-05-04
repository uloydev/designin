<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify'=>true]);

Route::get('/', 'HomeController@index')->name('landing-page');
Route::get('/services/search', 'HomeController@serviceSearch');
Route::get('/services', 'HomeController@services')->name('services');
Route::get('contact-us', 'ContactController@index')->name('contact-us.index');
Route::get('faq', 'HomeController@faq')->name('faq.index');
Route::resource('blog', 'BlogController');
Route::resource('blog/categories', 'BlogCategoryController')->names([
    'index' => 'blog-category.index',
    'create' => 'blog-category.create',
    'show' => 'blog-category.show',
    'edit' => 'blog-category.edit',
    'update' => 'blog-category.update',
    'destroy' => 'blog-category.destroy'
]);
// Route::get('blog', 'BlogController@index')->name('blog.index');
// Route::get('blog/{id}', 'BlogController@show')->name('blog.single');

// Route::get('create', 'Admin\BlogController@create');
// Route::post('create', 'Admin\BlogController@store')->name('blog.store');
Route::post('contact-us', 'ContactController@contactUs');

// profile route for all user role
Route::prefix('profile')->middleware('profile')->group(function () {
    Route::get('/', 'ProfileController@index')->name('profile.index');
    Route::get('edit', 'ProfileController@edit')->name('profile.edit');
    Route::match(['update', 'put'], 'edit', 'ProfileController@update');
});

Route::namespace('Admin')->middleware('admin')->prefix('admin')->group(function () {
    Route::get('dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::prefix('manage')->name('manage.')->group(function(){
        Route::get('/', 'HomeController@index');
        Route::resource('user', 'UserController');
        Route::resource('agent', 'AgentController');
        Route::resource('admin', 'AdminController')->except('index');
        Route::resource('faq', 'FaqController')->except(['show']);
        Route::resource('blog', 'BlogController');
        Route::resource('blog-category', 'BlogCategoryController');
        Route::resource('service', 'ServiceController');
        Route::resource('service-category', 'ServiceCategoryController');
        Route::resource('contact-us', 'ContactController')->except(['create', 'store', 'show']);
    });
});

Route::middleware(['auth', 'verified'])->prefix('user')->namespace('User')->group(function () {
    Route::redirect('/', 'dashboard');
    Route::get('dashboard', 'HomeController@index')->name('user.home');
});

Route::prefix('agent')->namespace('Agent')->group(function () {
    Route::get('profile/{agent_id}', 'HomeController@showAgentProfile')->name('agent.profile');
    Route::middleware(['agent', 'verified'])->name('agent.')->group(function () {
        Route::redirect('/', 'dashboard');
        Route::get('dashboard', 'HomeController@index')->name('home');
        Route::resource('portfolio', 'PortfolioController');
    });
});
