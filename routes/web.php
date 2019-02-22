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
        Route::post('category/search', [
            'as' => 'category.search',
            'uses' => 'CategoryController@searchData'
        ]);
        Route::resource('users', 'UserController');
        Route::get('category/children', 'CategoryController@getChildren');
        Route::resource('category', 'CategoryController');
        Route::get('product/detail', 'ProductController@getDetail');
        Route::resource('product', 'ProductController')->except('edit', 'update', 'destroy');
        Route::resource('promotions', 'PromotionController');
        Route::resource('codes', 'CodeController')->except(['show']);
        Route::resource('orders', 'OrderController')->except(['edit']);
        Route::get('comments/change-status', 'CommentController@changeStatus');
        Route::resource('comments', 'CommentController')->only(['index', 'destroy']);
    });
});

Route::group(['namespace' => 'User', 'as' => 'user.'], function () {
    Route::get('/home', 'IndexController@index')->name('index');
    Route::get('/search', 'IndexController@search')->name('search');
    Route::get('get-detail-product', 'ProductController@getDetailProduct');
    Route::get('get-sizes-by-color-id', 'ProductController@getSizesByColorId');
    Route::get('cart', 'OrderController@cart')->name('cart');
    Route::get('cart/applyCode', 'OrderController@applyCode');
    Route::get('checkout', 'OrderController@checkout');
    Route::get('checkout/handle-checkout', 'OrderController@handleCheckout');
    Route::get('getDetailProduct', 'ProductController@getDetailProduct');
    Route::get('get-detail-product', 'ProductController@getDetailProduct');
    Route::get('get-sizes-by-color-id', 'ProductController@getSizesByColorId');
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@handleLogin')->name('login');
    Route::get('logout', 'LoginController@handleLogout')->name('logout');
    Route::get('category/filterProduct', 'ProductController@filterProduct');
    Route::get('category/{id}', 'ProductController@listProductByCatId')->name('category');
    Route::middleware(['auth'])->group(function () {
        Route::get('profile', 'ProfileController@showProfile')->name('profile');
        Route::post('profile', 'ProfileController@handleProfile')->name('profile');
        Route::get('password', 'ProfileController@showPassword')->name('password');
        Route::post('password', 'ProfileController@handlePassword')->name('password');
        Route::get('orders', 'OrderController@index')->name('orders');
        Route::get('order/{id}', 'OrderController@show')->name('order.show');
    });
    Route::get('/{provider}/redirect', 'SocialController@redirect');
    Route::get('/{provider}/callback', 'SocialController@callback');
});
