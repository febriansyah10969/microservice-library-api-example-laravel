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

Route::group(['prefix' => 'v1'], function () {
    Route::group(['namespace' => 'Auth'], function () {
        Route::post('register', 'RegisterController@register');
        Route::post('login', 'LoginController@login')->name('login');;
    });

    Route::get('profile', 'Profile\ProfileController@index')->middleware(['auth:api']);
});
