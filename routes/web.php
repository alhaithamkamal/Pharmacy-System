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

Route::get('/', function () {
    return view('Dashboard');
});

Route::get('/users', function () {
    return view('users.index');
});

Route::get('/users/create', function () {
    return view('users.create');
});


Route::get('/doctors', 'DoctorController@index')->name('doctors.index');
//Route::get('/doctors', 'UserController@index');

Route::get('/status/update', 'UserController@updateStatus')->name('users.update.status');



Route::get('/doctors/create', 'DoctorController@create')->name('doctors.create');

Route::post('/doctors','DoctorController@store')->name('doctors.store') ;

Route::get('/doctors/{doctor}','DoctorController@show')->name('doctors.show');


Auth::routes();
Auth::routes(['verify' => true]);


Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/pharmacies', function () {
    return view('pharmacies.index');
});
Route::get('/orders', function () {
    return view('orders.index');
});


Route::get('/revenues', function () {
    return view('revenues.index');
});

