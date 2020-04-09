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

Route::get('/users', function () {
    return view('users.index');
});

Route::get('/users/create', function () {
    return view('users.create');
});

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
//======================================================

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
