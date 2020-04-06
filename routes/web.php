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

//show clients in table
Route::get('/clients','ClientController@index')->name('clients.index');

//route to client form
// Route::get('/clients/create','ClientController@create')->name('clients.create');

//to store client data
// Route::post('/clients','ClientController@store')->name('clients.store');



Route::get('/doctors', 'DoctorController@index')->name('doctors.index');

Route::get('/doctors/create', 'DoctorController@create')->name('doctors.create');

Route::post('/doctors', 'DoctorController@store')->name('doctors.store');

Route::get('/doctors/{doctor}', 'DoctorController@show')->name('doctors.show');


Auth::routes();
Auth::routes(['verify' => true]);


Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/pharmacies', function () {
    return view('pharmacies.index');
});

Route::get('/revenues', function () {
    return view('revenues.index');
});

//============== Orders routes ================
Route::get('/orders', 'OrdersController@index')->name('orders.index');

Route::get('/orders/create', 'OrdersController@create')->name('orders.create');

Route::post('/orders', 'OrdersController@store')->name('orders.store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
