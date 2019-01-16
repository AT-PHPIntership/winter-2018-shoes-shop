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
        Route::resource('users', 'UserController');
        Route::resource('category', 'CategoryController');
        Route::get('product/detail', 'ProductController@getDetail');
        Route::get('product/import', 'ProductController@importFile')->name('product.import');
        Route::post('product/import/process', 'ProductController@processImport')->name('product.import.process');
        Route::resource('product', 'ProductController');
    });
});
