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

Route::group(['prefix' => 'v1', 'as' => 'v1.'], function() {
    Route::group(['prefix' => 'users', 'as' => 'users.'], function() {
        Route::resource('/', 'API\V1\UsersController');

        // Auth Routes
        Route::post('login', 'API\V1\AuthController@login')->name('login');

        // Route::group([
        //     'middleware' => 'auth:api'
        // ], function() {
        //     Route::get('profile', 'App\Http\Controllers\API\V1\AuthController');
        // });
    });
});