<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['verify'=>true]);

Route::get('/', 'HomeController@index');
Route::get('/services/search', 'HomeController@serviceSearch');
Route::get('/services', 'HomeController@services')->name('services');
Route::resource('faq', 'FaqController');
Route::resource('blog', 'BlogController');
Route::namespace('Admin')->middleware('admin')->prefix('admin')->group(function () {
    Route::get('/', 'HomeController@index')->name('admin.home');
});

Route::middleware(['auth', 'verified'])->prefix('user')->namespace('User')->group(function () {
    Route::get('/', 'HomeController@index')->name('user.home');
});

Route::prefix('agent')->namespace('Agent')->group(function () {
    Route::get('register', 'RegisterController@showRegistrationForm')->name('agent.register');
    Route::post('register', 'RegisterController@register');
    Route::middleware(['agent', 'verified'])->group(function () {
        Route::get('/', 'HomeController@index')->name('agent.home');
    });
});
