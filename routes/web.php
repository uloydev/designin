<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['verify'=>true]);

Route::get('/', 'HomeController@index');
Route::get('/services/search', 'HomeController@serviceSearch');
Route::get('/services', 'HomeController@services')->name('services');
Route::get('contact-us', 'ContactController@showContactUsForm')->name('contact-us.index');
Route::get('faq', 'HomeController@faq')->name('faq.index');
Route::get('blog', 'HomeController@blog')->name('blog.index');

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
        Route::Resource('user', 'UserController');
        Route::Resource('agent', 'AgentController');
        Route::Resource('admin', 'AdminController');
        Route::Resource('faq', 'FaqController');
        Route::Resource('blog', 'BlogController');
    });
});

Route::middleware(['auth', 'verified'])->prefix('user')->namespace('User')->group(function () {
    Route::get('/', 'HomeController@index')->name('user.home');
});

Route::prefix('agent')->namespace('Agent')->middleware(['agent', 'verified'])->group(function () {
    Route::get('/', 'HomeController@index')->name('agent.home');
});
