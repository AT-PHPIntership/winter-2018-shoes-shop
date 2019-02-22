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
        Route::get('product/{id}/detail', 'ProductController@getDetail');
        Route::get('product/import', 'ProductController@importFile')->name('product.import');
        Route::post('product/import/process', 'ProductController@processImport')->name('product.import.process');
        Route::resource('product', 'ProductController');
        Route::resource('promotions', 'PromotionController');
        Route::resource('codes', 'CodeController')->except(['show']);
    });
});
