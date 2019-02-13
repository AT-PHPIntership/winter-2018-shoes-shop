<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
    Auth::routes();
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('index', 'HomeController@index')->name('index');
        Route::resource('product', 'ProductController');
        Route::post('category/search', [
            'as' => 'category.search',
            'uses' => 'CategoryController@searchData'
        ]);
        Route::resource('users', 'UserController');
        Route::resource('category', 'CategoryController');
        Route::resource('promotions', 'PromotionController');
        Route::resource('codes', 'CodeController')->except(['show']);
        Route::resource('orders', 'OrderController')->only(['index']);
    });
});

Route::group(['namespace' => 'User', 'as' => 'user.'], function () {
    Route::get('/', 'IndexController@index')->name('index');
    Route::get('cart', 'OrderController@cart')->name('cart');
    Route::get('cart/applyCode', 'OrderController@applyCode');
    Route::get('checkout', 'OrderController@checkout');
    Route::get('getDetailProduct', 'ProductController@getDetailProduct');
 });
