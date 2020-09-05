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

/*Route::get('/', function () {
    return view('welcome');
});*/


Route::get('/', function () {
    return view('items');
});

Route::get('/cart', function () {
    return view('cart');
});

Route::get('/payment', function () {
    return view('payment');
});

Route::get('/items', 'ItemController@index');

Route::get('/carts', 'CartController@index');

Route::post('/cart', 'CartController@add');

Route::put('/cart/{cart}', 'CartController@update');

Route::delete('/cart/{cart}', 'CartController@delete');

Route::post('/order', 'OrderController@add');


