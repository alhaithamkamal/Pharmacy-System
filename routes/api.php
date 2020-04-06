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
Route::post('/login', 'API\UserController@login');
Route::post('/register', 'API\UserController@store');
Route::put('/users/{user}', 'API\UserController@update');

Route::group([], function()
{
    Route::get('/users/{user}/addresses', 'API\AddressController@index');
    Route::post('/users/{user}/addresses', 'API\AddressController@store');
    Route::get('/users/{user}/addresses/{address}', 'API\AddressController@show');
    Route::put('/users/{user}/addresses/{address}', 'API\AddressController@update');
    Route::delete('/users/{user}/addresses/{address}', 'API\AddressController@destroy');
});