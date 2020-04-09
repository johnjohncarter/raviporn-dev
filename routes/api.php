<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('customer', 'API\User\UserController@getCustomer');
Route::get('product', 'API\Product\ProductController@getProduct');
Route::get('products', 'API\Product\ProductController@index');
Route::post('product-price/{user_id}', 'API\Product\ProductPriceController@newProductPrice');
Route::post('order', 'API\Order\OrderController@create');

Route::get('roles', 'API\User\UserController@getRoles');
Route::post('users', 'API\User\UserController@create');
