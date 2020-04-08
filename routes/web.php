<?php

use Illuminate\Support\Facades\Auth;
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
Route::get('/clients/create','ClientController@create')->name('clients.create');

//to store client data
 Route::post('/clients','ClientController@store')->name('clients.store');

//route to edit client
Route::get('/clients/{client}/edit','ClientController@edit')->name('clients.edit');

//update client
Route::patch('/clients/{client}','ClientController@update')->name('clients.update');

//soft delete client
Route::post('/clients/{client}','ClientController@destroy')->name('clients.destroy');

//show trashed clients
Route::get('/trashed-client', 'ClientController@trashed')->name('clients.trashed');

//restore clients
Route::post('/trashed-client/{client}', 'ClientController@restoreClient')->name('clients.restore');

// ==================Area routes=======================

//show areas in table
Route::get('/areas','AreaController@index')->name('areas.index');

//route to areas form
Route::get('/areas/create','AreaController@create')->name('areas.create');

//to store area data
 Route::post('/areas','AreaController@store')->name('areas.store');

//route to edit area
Route::get('/areas/{area}/edit','AreaController@edit')->name('areas.edit');

//update areas
Route::patch('/areas/{area}','AreaController@update')->name('areas.update');

//soft delete area
Route::post('/areas/{area}','AreaController@destroy')->name('areas.destroy');




// ==================Doctor routes=======================
Route::get('/doctors', 'DoctorController@index')->name('doctors.index');

Route::get('/doctors/create', 'DoctorController@create')->name('doctors.create');

Route::post('/doctors', 'DoctorController@store')->name('doctors.store');

Route::get('/doctors/{doctor}', 'DoctorController@show')->name('doctors.show');

Route::get('/doctors/{doctor}/edit', 'DoctorController@edit')->name('doctors.edit');
Route::put('/doctors/{doctor}', 'DoctorController@update')->name('doctors.update');
Route::delete('/doctors/{doctor}','DoctorController@destroy')->name('doctors.destroy') ;

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

Route::get('/orders/{order}/edit', 'OrdersController@edit')->name('orders.edit');

Route::put('/orders/{order}', 'OrdersController@update')->name('orders.update');

//=============================================

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
