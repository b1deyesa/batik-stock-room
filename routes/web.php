<?php

use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Auth')->name('auth.')->group( function () {
    Route::get('/', 'LoginController@index')->name('login.index');
    Route::post('/', 'LoginController@post')->name('login.post');
    // Route::get('/register', 'RegisterController@index')->name('register.index');
    Route::post('/register', 'RegisterController@post')->name('register.post');
    Route::post('/logout', 'LogoutController@post')->name('logout.post');
});

Route::namespace('App\Http\Controllers\Dashboard')->middleware('auth')->prefix('dashboard')->name('dashboard.')->group( function () {
    Route::get('/', 'IndexController@index')->name('index');
    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::get('/profile/ganti-password', 'ProfileController@gantiPassword')->name('profile.ganti-password');
    Route::post('/profile/ganti-password', 'ProfileController@gantiPasswordPost')->name('profile.ganti-password.post');
    Route::post('/inventory/{inventory}', 'InventoryController@updateMinimumStock')->name('inventory.update-minimum-stock');
    Route::get('/inventory/report', 'InventoryController@report')->name('inventory.report');
    Route::resource('/user', 'UserController');
    Route::resource('/customer', 'CustomerController');
    Route::resource('/inventory', 'InventoryController');
    Route::resource('/requestion', 'RequestionController');
    Route::resource('/returned', 'ReturnedController');
    Route::resource('/buy', 'BuyController');
    Route::resource('/sell', 'SellController');
    Route::get('/report/buy', 'BuyController@report')->name('buy.report');
    Route::get('/report/buy/download', 'BuyController@generateReport')->name('buy.report.download');
    Route::get('/report/sell', 'SellController@report')->name('sell.report');
    Route::get('/report/sell/download', 'SellController@generateReport')->name('sell.report.download');
});