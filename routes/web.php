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
    return view('welcome');
});
Route::get('register', 'Authen\AuthenController@getRegister');
Route::post('register', 'Authen\AuthenController@register');

Route::get('sign-in', 'Authen\AuthenController@getSignIn');
Route::post('sign-in', 'Authen\AuthenController@signIn');

Route::get('sign-out', 'Authen\UserController@signOut');

Route::group(['middleware' => 'user'], function () {
    Route::get('/dashboard', 'Dashboard\DashboardController@dashboard');
});
