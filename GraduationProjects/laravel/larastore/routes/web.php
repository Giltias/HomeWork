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

use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::middleware(['auth', 'admin'])->group(function() {
    Route::prefix('admin')->group(function () {
        Route::get('/', 'AdminController@goods');
        Route::get('/orders', 'AdminController@orders');
        Route::get('/notification/edit', 'AdminController@edit');
        Route::post('/notification/change', 'AdminController@change');
        Route::prefix('goods')->group(function () {
            Route::get ('/add/form'   , 'GoodsController@add');
            Route::post('/add/create' , 'GoodsController@create');
            Route::get ('/edit/{id}'  , 'GoodsController@edit');
            Route::post('/edit/change', 'GoodsController@change');
            Route::get('/delete/{id}' , 'GoodsController@delete');
        });
        Route::prefix('categories')->group(function () {
            Route::get('/'            , 'AdminController@categories');
            Route::get ('/add/form'   , 'CategoryController@add');
            Route::post('/add/create' , 'CategoryController@create');
            Route::get ('/edit/{id}'  , 'CategoryController@edit');
            Route::post('/edit/change', 'CategoryController@change');
            Route::get('/active/{id}' , 'CategoryController@active');
        });
    });
});


Route::get('/goods/{id}', 'GoodsController@select')->where('id', '[0-9]+');
Route::get('/goods/json/{id}', 'GoodsController@goods')->where('id', '[0-9]+');

Route::prefix('category')->group(function () {
    Route::get('/', 'CategoryController@index')->name('category');
    Route::get('/filter/{id}', 'CategoryController@filter')->where('id', '[0-9]+');
});

Route::post('/order/confirm', 'OrderController@create');
