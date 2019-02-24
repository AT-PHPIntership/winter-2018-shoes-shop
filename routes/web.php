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
        Route::get('index', 'IndexController@index')->name('index');
        Route::resource('product', 'ProductController');
        Route::post('category/search', [
            'as' => 'category.search',
            'uses' => 'CategoryController@searchData'
        ]);
        Route::resource('users', 'UserController');
        Route::resource('category', 'CategoryController');
        Route::resource('promotions', 'PromotionController');
        Route::resource('codes', 'CodeController')->except(['show']);
        Route::get('orders/export/{id}', 'OrderController@export')->name('orders.export');
        Route::resource('orders', 'OrderController')->except(['edit']);
        Route::get('comments/change-status', 'CommentController@changeStatus');
        Route::resource('comments', 'CommentController')->only(['index', 'destroy']);
        Route::get('statisticals/revenue', 'StatisticalController@revenue')->name('statisticals.revenue');
        Route::get('statisticals/product', 'StatisticalController@product')->name('statisticals.product');
        Route::get('statisticals/product/export/{str}', 'StatisticalController@exportProduct')->name('statisticals.product.export');
    });
});
