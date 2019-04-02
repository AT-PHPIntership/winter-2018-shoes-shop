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
        Route::post('category/search','CategoryController@searchData')->name('category.search');
        Route::get('users/trash', 'UserController@trash')->name('users.trash');
        Route::patch('users/restore/{id}', 'UserController@restore')->name('users.restore');
        Route::delete('users/force-delete/{id}', 'UserController@forceDelete')->name('users.force-delete');
        Route::resource('users', 'UserController');
        Route::get('category/children', 'CategoryController@getChildren');
        Route::resource('category', 'CategoryController');
        Route::get('product/detail', 'ProductController@getDetail');
        Route::get('product/{id}/detail', 'ProductController@getDetail');
        Route::get('product/export/sample', 'ProductController@exportSampleFile')->name('product.export.sample');
        Route::get('product/export/data', 'ProductController@exportDataFile')->name('product.export.data');
        Route::get('product/import', 'ProductController@importFile')->name('product.import');
        Route::post('product/import/process', 'ProductController@processImport')->name('product.import.process');
        Route::resource('product', 'ProductController');
        Route::resource('colors', 'ColorController')->except(['show']);
        Route::resource('sizes', 'SizeController')->except(['show']);
        Route::resource('promotions', 'PromotionController');
        Route::resource('codes', 'CodeController')->except(['show']);
        Route::get('orders/export/{id}', 'OrderController@export')->name('orders.export');
        Route::resource('orders', 'OrderController')->except(['edit']);
        Route::get('comments/change-status', 'CommentController@changeStatus');
        Route::resource('comments', 'CommentController')->only(['index', 'destroy']);
        Route::get('reviews/change-status', 'ReviewController@changeStatus');
        Route::resource('reviews', 'ReviewController')->only(['index', 'destroy']);
        Route::get('statisticals/revenue', 'StatisticalController@revenue')->name('statisticals.revenue');
        Route::get('statisticals/product', 'StatisticalController@product')->name('statisticals.product');
        Route::get('statisticals/product/export/{str}', 'StatisticalController@exportProduct')->name('statisticals.product.export');
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
    Route::get('checkout/confermation', 'OrderController@confermation');
    Route::get('getDetailProduct', 'ProductController@getDetailProduct');
    Route::post('detail/add-comment', 'CommentController@addComment');
    Route::get('detail/get-list-comment', 'CommentController@getListComment');
    Route::get('detail/remove-comment', 'CommentController@removeComment');
    Route::post('add-review', 'ReviewController@addReview')->middleware('auth');
    Route::get('detail/{id}', 'ProductController@detail')->name('detail');
    Route::get('get-detail-product', 'ProductController@getDetailProduct');
    Route::get('get-sizes-by-color-id', 'ProductController@getSizesByColorId');
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@handleLogin')->name('login');
    Route::get('logout', 'LoginController@handleLogout')->name('logout');
    Route::get('register', 'RegisterController@showRegister')->name('register');
    Route::post('register', 'RegisterController@handleRegister')->name('register');
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
    Route::get('password/request', 'PasswordResetController@showRequestForm')->name('password.request');
    Route::post('password/email', 'PasswordResetController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'PasswordResetController@showResetForm')->name('password.reset.token');
    Route::post('password/reset', 'PasswordResetController@reset')->name('password.reset');
    
});
