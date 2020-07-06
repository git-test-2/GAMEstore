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

//Route::get('/', function () {
//    return view('welcome');
//});
//Route::get('/', 'GoodsController@index')->name('goods');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/goods', 'GoodsController@index')->name('goods');
Route::get('/goods/category/{id}', 'CategoryController@index')->name('category');

Route::get('/goods/single/{id}', 'GoodsController@single')->name('single');

Route::get('/goods/order/{id}', 'GoodsController@order')->name('order');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function ()
{

        Route::get('/', 'AdminController@index')->name('admin');

        Route::get('/game/create', 'AdminController@create')->name('game.create');

        Route::post('/game/create/add', 'GoodsController@add')->name('game.add');

        Route::get('/game/delete/{id}', 'GoodsController@delete')->name('game.delete');

        Route::get('/game/edit/{id}', 'AdminController@edit')->name('game.edit');

        Route::get('/game/save/{id}', 'GoodsController@save')->name('game.save');


    Route::get('/category/create', 'AdminController@createCategory')->name('category.create');

    Route::post('/category/create/add', 'CategoryController@add')->name('category.add');

    Route::get('/category/delete/{id}', 'CategoryController@delete')->name('category.delete');

    Route::get('/category/edit/{id}', 'AdminController@editCategory')->name('category.edit');

    Route::get('/category/save/{id}', 'AdminController@saveCategory')->name('category.save');


        Route::get('address/change', 'AdressController@change')->name('address.change');

        Route::post('address/save/{id}', 'AdressController@save')->name('address.save');



});



