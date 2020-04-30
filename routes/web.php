<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['verify'=>true]);

Route::get('/', 'HomeController@index')->name('landing-page');
Route::get('/services/search', 'HomeController@serviceSearch');
Route::get('/services', 'HomeController@services')->name('services');
Route::get('contact-us', 'ContactController@index')->name('contact-us.index');
Route::get('faq', 'HomeController@faq')->name('faq.index');
Route::get('blog', 'BlogController@index')->name('blog.index');
Route::get('blog/{id}', 'BlogController@show')->name('blog.single');
// Route::get('create', 'Admin\BlogController@create');
// Route::post('create', 'Admin\BlogController@store')->name('blog.store');
Route::post('contact-us', 'ContactController@contactUs');

// profile route for all user role
Route::prefix('profile')->middleware('profile')->group(function () {
    Route::get('/', 'ProfileController@index')->name('profile.index');
    Route::get('edit', 'ProfileController@edit')->name('profile.edit');
    Route::match(['update', 'put'], 'edit', 'ProfileController@update');
});

Route::namespace('Admin')->middleware('admin')->prefix('admin')->name('manage.')->group(function () {
    Route::get('dashboard', 'AdminController@index')->name('dashboard');
    Route::prefix('manage')->group(function(){
        Route::get('/', 'HomeController@index');
        Route::resource('user', 'UserController');
        Route::resource('agent', 'AgentController');
        Route::resource('admin', 'AdminController')->except('index');
        Route::resource('faq', 'FaqController')->except(['show']);
        Route::resource('blog', 'BlogController');
    });
});

Route::middleware(['auth', 'verified'])->prefix('user')->namespace('User')->group(function () {
  Route::get('/', 'HomeController@index')->name('user.home');
});

Route::prefix('agent')->namespace('Agent')->middleware(['agent', 'verified'])->group(function () {
  Route::get('/', 'HomeController@index')->name('agent.home');
});
