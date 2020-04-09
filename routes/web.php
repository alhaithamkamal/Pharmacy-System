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
Route::get('/clients', 'ClientController@index')->name('clients.index');

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

Auth::routes(['verify' => true]);


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

// ==================Client addresses routes=======================


//show clients-addresses in table
Route::get('/clients-addresses','ClientAddressController@index')->name('clientsAddresses.index');

//route to client-addresses form
Route::get('/clients-addresses/create','ClientAddressController@create')->name('clientsAddresses.create');

//to store client-addresses data
 Route::post('/clients-addresses','ClientAddressController@store')->name('clientsAddresses.store');

//route to edit client-addresses
Route::get('/clients-addresses/{clientAddress}/edit','ClientAddressController@edit')->name('clientsAddresses.edit');

//update client
Route::patch('/clients-addresses/{clientAddress}','ClientAddressController@update')->name('clientsAddresses.update');

//soft delete client-addresses
Route::post('/clients-addresses/{clientAddress}','ClientAddressController@destroy')->name('clientsAddresses.destroy');

//show trashed clients
Route::get('/trashed-client-addresses', 'ClientAddressController@trashed')->name('clientsAddresses.trashed');

//restore clients
Route::post('/trashed-client-addresses/{clientAddress}', 'ClientAddressController@restoreClient')->name('clientsAddresses.restore');



// ==================Doctor routes=======================
Route::get('/doctors', 'DoctorController@index')->name('doctors.index');

Route::get('/doctors/create', 'DoctorController@create')->name('doctors.create');

Route::post('/doctors', 'DoctorController@store')->name('doctors.store');

Route::get('/doctors/{doctor}', 'DoctorController@show')->name('doctors.show');

Route::get('/doctors/{doctor}/edit', 'DoctorController@edit')->name('doctors.edit');
Route::put('/doctors/{doctor}', 'DoctorController@update')->name('doctors.update');
Route::delete('/doctors/{doctor}', 'DoctorController@destroy')->name('doctors.destroy');

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

//==================Medicine===========================
Route::get('/medicines','MedicineController@show')->name('medicine.show');
Route::get('/medicine/create','MedicineController@create')->name('medicine.create');
Route::post('/medicines','MedicineController@store')->name('medicine.store');
Route::get('/medicines/edit/{medicineId}','MedicineController@edit')->name('medicine.edit');
Route::post('/medicines/{ID}','MedicineController@update')->name('medicine.update');
Route::get('/medicines/delete/{id}','MedicineController@delete')->name('medicine.delete');
//====================Pharmacy=========================
Route::get('/pharmacies','PharmacyController@show')->name('pharmacy.show');
Route::get('/pharmacy/create','PharmacyController@create')->name('pharmacy.create');
Route::get('/pharmacy/edit/{pharmacyId}','PharmacyController@edit')->name('pharmacy.edit');
Route::post('/pharmacy/{ID}','PharmacyController@update')->name('pharmacy.update');
Route::get('/pharmacy/{delId}','PharmacyController@delete')->name('pharmacy.delete');
Route::post('/pharmacies','PharmacyController@store')->name('pharmacy.store');
//======================Revenue=========================
Route::get('/revenues','RevenueController@show')->name('revenue.show');
Route::get('/revenue/create','RevenueController@create')->name('revenue.create');
Route::post('/revenues','RevenueController@store')->name('revenue.store');
Route::get('/revenue/edit/{revenueId}','RevenueController@edit')->name('revenue.edit');
Route::post('/revenue/{ID}','RevenueController@update')->name('revenue.update');
Route::get('/revenue/{delId}','RevenueController@delete')->name('revenue.delete');
Route::get('image/{filename}', 'RevenueController@displayImage')->name('revenue.displayImage');
//======================================================
Route::delete('/orders/{order}', 'OrdersController@destroy')->name('orders.destroy');

//=============================================

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
