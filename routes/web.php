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

Route::get('/', 'CheckoutController@show');
Route::post('/checkout/store', 'CheckoutController@store')->name('checkout.store');
Route::get('/checkout/sucesso', 'CheckoutController@success')->name('checkout.success');
