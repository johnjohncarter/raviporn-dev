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

    Route::get('order-new', 'Order\OrderNewController@index');
    Route::get('order-new/create', 'Order\OrderNewController@create');
    Route::put('order-new/{order_id}/is-pay', 'Order\OrderNewController@isPay');
    Route::get('order-new/{order_id}/view', 'Order\OrderNewController@view');
    Route::get('order-new/{order_id}/edit', 'Order\OrderNewController@edit');
    Route::get('order-new/{order_id}/update', 'Order\OrderNewController@update');
    Route::delete('order-new/{order_id}/delete', 'Order\OrderNewController@destroy');

    Route::get('order-history', 'Order\OrderHistoryController@index');
    Route::get('order-history/{order_id}/view', 'Order\OrderController@show');
    Route::get('order-history/{order_id}/delete', 'Order\OrderHistoryController@getNewOrder');
    Route::put('order-history/{order_id}/is-pay', 'Order\OrderHistoryController@isPay');

    Route::get('stock', 'Stock\StockController@index');
    Route::get('stock/create', 'Stock\StockController@create');
    Route::get('stock/{stock_id}/view', 'Stock\StockController@view');
    Route::get('stock/{stock_id}/edit', 'Stock\StockController@edit');
    Route::get('stock/{stock_id}/update', 'Stock\StockController@update');
    Route::get('stock/{stock_id}/delete', 'Stock\StockController@destroy');

    Route::get('product', 'Product\ProductController@index');
    Route::get('product/create', 'Product\ProductController@create');
    Route::post('product/create', 'Product\ProductController@store');
    Route::get('product/{product_id}/view', 'Product\ProductController@view');
    Route::get('product/{product_id}/edit', 'Product\ProductController@edit');
    Route::put('product/{product_id}/update', 'Product\ProductController@update');
    Route::delete('product/{product_id}/delete', 'Product\ProductController@destroy');

    Route::get('manage-user', 'Manage\ManageUserController@index');
    Route::get('manage-user/create', 'Manage\ManageUserController@create');
    Route::post('manage-user/create', 'Manage\ManageUserController@store');
    Route::get('manage-user/{user_id}/view', 'Manage\ManageUserController@view');
    Route::get('manage-user/{user_id}/edit', 'Manage\ManageUserController@edit');
    Route::put('manage-user/{user_id}/update', 'Manage\ManageUserController@update');
    Route::delete('manage-user/{user_id}/delete', 'Manage\ManageUserController@destroy');
});
