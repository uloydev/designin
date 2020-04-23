<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['verify'=>true]);

Route::get('/', 'HomeController@index');
Route::get('/services/search', 'HomeController@serviceSearch');
Route::get('/services', 'HomeController@services')->name('services');
Route::get('contact-us', 'ContactController@showContactUsForm')->name('contact-us.index');
Route::get('faq', 'HomeController@faq');
Route::get('blog', 'HomeController@blog');

Route::post('contact-us', 'ContactController@contactUs');

Route::Resource('profile', 'ProfileController')->middleware('auth');

Route::namespace('Admin')->middleware('admin')->prefix('admin')->group(function () {
    Route::get('/', 'HomeController@index')->name('admin.home');
    Route::Resource('faq', 'FaqController');
    Route::Resource('blog', 'BlogController');
});

Route::middleware(['auth', 'verified'])->prefix('user')->namespace('User')->group(function () {
    Route::get('/', 'HomeController@index')->name('user.home');
});

Route::prefix('agent')->namespace('Agent')->middleware(['agent', 'verified'])->group(function () {
    Route::get('/', 'HomeController@index')->name('agent.home');
});
