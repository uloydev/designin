<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['verify'=>true]);

Route::get('/', 'HomeController@index');
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
route::prefix('profile')->middleware('profile')->group(function () {
    route::get('/', 'ProfileController@index')->name('profile.index');
    route::get('edit', 'ProfileController@edit')->name('profile.edit');
    route::match(['update', 'put'], 'edit', 'ProfileController@update');
});

Route::namespace('Admin')->middleware('admin')->prefix('admin')->group(function () {
    Route::get('/', 'HomeController@index')->name('admin.home');
    Route::prefix('manage')->name('manage.')->group(function(){
        Route::get('/', 'HomeController@index');
        Route::resource('user', 'UserController');
        Route::resource('agent', 'AgentController');
        Route::resource('admin', 'AdminController');
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
