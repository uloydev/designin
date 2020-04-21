<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::view('/', 'landing');

Route::namespace('Admin')->middleware('admin')->prefix('admin')->group(function(){
    Route::get('/', 'HomeController@index')->name('admin.home');
});

Route::middleware('auth')->group(function () {
    Route::prefix('user')->namespace('User')->group(function(){
        Route::get('/', 'HomeController@index')->name('user.home');
    });
    Route::prefix('agent')->namespace('Agent')->group(function(){
        Route::get('/', 'HomeController@index')->name('agent.home');
    });
});
