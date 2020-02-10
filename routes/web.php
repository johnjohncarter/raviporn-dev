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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('dashboard');
});
Route::get('register', 'Authen\AuthenController@getRegister');
Route::post('register', 'Authen\AuthenController@register');

Route::get('sign-in', 'Authen\AuthenController@getSignIn');
Route::post('sign-in', 'Authen\AuthenController@signIn');

Route::get('sign-out', 'Authen\UserController@signOut');

Route::group(['middleware' => 'user'], function () {
    Route::get('dashboard', 'Dashboard\DashboardController@dashboard');
//    Route::get('order', 'Order\OrderController@index');
    Route::get('new-order', 'Order\OrderController@getNewOrder');
    Route::get('order-new', 'Order\OrderController@orderNew');
    Route::get('order-history', 'Order\OrderController@orderHistory');
    Route::get('order-view/{order_id}', 'Order\OrderController@show');
    Route::get('stock', 'Stock\StockController@index');
    Route::get('product', 'Product\ProductController@index');
    Route::get('customer', 'Customer\CustomerController@index');
});
