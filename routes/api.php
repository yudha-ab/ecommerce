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

Route::group(['prefix' => 'v1', 'as' => 'v1.'], function() {
    Route::group(['prefix' => 'user', 'as' => 'user.'], function() {
        // Route::resource('/', 'API\V1\UsersController');

        // Auth Routes
        Route::post('login', 'API\V1\AuthController@login')->name('login');

        Route::group([
            'middleware' => 'auth:api'
        ], function() {
            // user
            Route::get('profile', 'API\V1\AuthController@getUser')->name('profile');
            Route::get('logout', 'API\V1\AuthController@logout')->name('logout');
        });
    });

    Route::group([
        'middleware' => 'auth:api',
        'prefix' => 'admin',
        'as' => 'admin.'
    ], function() {
        Route::get('categories', 'API\V1\Categories\CategoriesController@index')->name('categories');

        Route::group([
            'prefix' => 'category',
            'as' => 'category'
        ], function() {
            Route::post('/', 'API\V1\Categories\CategoriesController@store')->name('add');
            Route::get('/{id}', 'API\V1\Categories\CategoriesController@show')->name('show');
            Route::put('/{id}', 'API\V1\Categories\CategoriesController@update')->name('patch');
        });
    });
});