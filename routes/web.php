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
//->middleware(['can:create pharmacy'])
// ==================clients and home routes=======================
Route::group(['middleware' => ['auth','role:admin|doctor|pharmacy']], function () {
    Route::get('/', function () {
        return view('Dashboard');
    });
    
    //show clients in table
    Route::get('/clients', 'ClientController@index')->name('clients.index');

    //route to client form
    Route::get('/clients/create', 'ClientController@create')->name('clients.create');

    //to store client data
    Route::post('/clients', 'ClientController@store')->name('clients.store');

    //show client data
    Route::get('/clients/{client}', 'ClientController@show')->name('clients.show');

    //route to edit client
    Route::get('/clients/{client}/edit', 'ClientController@edit')->name('clients.edit');

    //update client
    Route::patch('/clients/{client}', 'ClientController@update')->name('clients.update');

    //soft delete client
    Route::post('/clients/{client}', 'ClientController@destroy')->name('clients.destroy');

    //show trashed clients
    Route::get('/trashed-clients', 'ClientController@trashed')->name('clients.trashed');

    //restore clients
    Route::post('/trashed-clients/{client}', 'ClientController@restoreClient')->name('clients.restore');
    
// ==================Client addresses routes=======================


    //show clients-addresses in table
    Route::get('/clients-addresses', 'ClientAddressController@index')->name('clientsAddresses.index');

    //route to client-addresses form
    Route::get('/clients-addresses/create', 'ClientAddressController@create')->name('clientsAddresses.create');


    //to store client-addresses data
    Route::post('/clients-addresses', 'ClientAddressController@store')->name('clientsAddresses.store');

    //show client-address data
    Route::get('/clients-addresses/{clientAddress}', 'ClientAddressController@show')->name('clientsAddresses.show');

    //route to edit client-addresses
    Route::get('/clients-addresses/{clientAddress}/edit', 'ClientAddressController@edit')->name('clientsAddresses.edit');

    //update client
    Route::patch('/clients-addresses/{clientAddress}', 'ClientAddressController@update')->name('clientsAddresses.update');

    //soft delete client-addresses
    Route::post('/clients-addresses/{clientAddress}', 'ClientAddressController@destroy')->name('clientsAddresses.destroy');

    //check main client-addresses
    Route::post('/addresses/{check}', 'ClientAddressController@check')->name('clientsAddresses.check');

    //show trashed clients
    Route::get('/trashed-client-addresses', 'ClientAddressController@trashed')->name('clientsAddresses.trashed');

    //restore clients
    Route::post('/trashed-client-addresses/{clientAddress}', 'ClientAddressController@restoreClient')->name('clientsAddresses.restore');



    //============== Orders routes =====================

    Route::get('/orders', 'OrderController@index')->name('orders.index');

    Route::get('/orders/create', 'OrderController@create')->name('orders.create');

    Route::post('/orders', 'OrderController@store')->name('orders.store');

    Route::get('/orders/{order}/edit', 'OrderController@edit')->name('orders.edit');

    Route::put('/orders/{order}', 'OrderController@update')->name('orders.update');

    Route::get('/orders/{order}', 'OrderController@show')->name('orders.show');

    Route::delete('/orders/{order}', 'OrderController@destroy')->name('orders.destroy');

    Route::post('/orders/fetch', 'OrderController@fetch')->name('orders.fetch');

        
    //=============== Stripe Routes ==========================
    Route::get('stripe', 'StripePaymentController@stripe')->name('stripe.stripe');
    Route::post('stripe', 'StripePaymentController@stripePost')->name('stripe.post');
    //=================== Orerer Confirmation ====================
    Route::get('orders/confirm/{order}', 'OrderConfirmationController@confirm');
    Route::get('orders/cancel/{order}', 'OrderConfirmationController@cancel');    

});

Auth::routes(['register' => false]);
Auth::routes(['verify' => true]);




// ==================role and permissions ,area and medicines routes=======================
Route::group(['middleware' => ['auth','role:admin']], function () {
        //show permissions in table
    Route::get('/permissions', 'PermissionController@index')->name('permissions.index');

    //route to permissions form
    Route::get('/permissions/create', 'PermissionController@create')->name('permissions.create');

    //to store permission data
    Route::post('/permissions', 'PermissionController@store')->name('permissions.store');

    //route to edit permission
    Route::get('/permissions/{permission}/edit', 'PermissionController@edit')->name('permissions.edit');

    //update permissions
    Route::patch('/permissions/{permission}', 'PermissionController@update')->name('permissions.update');

    //soft delete permission
    Route::post('/permissions/{permission}', 'PermissionController@destroy')->name('permissions.destroy');

    // ==================role routes=======================

    //show roles in table
    Route::get('/roles', 'RoleController@index')->name('roles.index');

    //route to roles form
    Route::get('/roles/create', 'RoleController@create')->name('roles.create');

    //to store role data
    Route::post('/roles', 'RoleController@store')->name('roles.store');

    //route to edit role
    Route::get('/roles/{role}/edit', 'RoleController@edit')->name('roles.edit');

    //update roles
    Route::patch('/roles/{role}', 'RoleController@update')->name('roles.update');

    //soft delete role
    Route::post('/roles/{role}', 'RoleController@destroy')->name('roles.destroy');

    // ==================Area routes=======================

    //show areas in table
    Route::get('/areas', 'AreaController@index')->name('areas.index');

    //route to areas form
    Route::get('/areas/create', 'AreaController@create')->name('areas.create');

    //to store area data
    Route::post('/areas', 'AreaController@store')->name('areas.store');

    //show area data
    Route::get('/areas/{area}', 'AreaController@show')->name('areas.show');

    //route to edit area
    Route::get('/areas/{area}/edit', 'AreaController@edit')->name('areas.edit');

    //update areas
    Route::patch('/areas/{area}', 'AreaController@update')->name('areas.update');

    //soft delete area
    Route::post('/areas/{area}', 'AreaController@destroy')->name('areas.destroy');

    //==================Medicine===========================
    Route::get('/medicines', 'MedicineController@show')->name('medicine.show');
    Route::get('/medicines/create', 'MedicineController@create')->name('medicine.create');
    Route::post('/medicines', 'MedicineController@store')->name('medicine.store');
    Route::get('/medicines/edit/{medicineId}', 'MedicineController@edit')->name('medicine.edit');
    Route::post('/medicines/{ID}', 'MedicineController@update')->name('medicine.update');
    Route::get('/medicines/delete/{id}', 'MedicineController@delete')->name('medicine.delete');

});



// ==================Doctor routes=======================

Route::group([], function(){
    Route::get('/doctors', 'DoctorController@index')->name('doctors.index');
    Route::get('/doctors/create', 'DoctorController@create')->name('doctors.create');
    Route::post('/doctors', 'DoctorController@store')->name('doctors.store');
    Route::get('/doctors/{doctor}', 'DoctorController@show')->name('doctors.show');
    Route::get('/doctors/{doctor}/ban', 'DoctorController@banned')->name('doctors.banned');
    Route::get('/doctors/{doctor}/edit', 'DoctorController@edit')->name('doctors.edit');
    Route::put('/doctors/{doctor}', 'DoctorController@update')->name('doctors.update');
    Route::delete('/doctors/{doctor}', 'DoctorController@destroy')->name('doctors.destroy');    
});



Auth::routes();


//===================================================


Route::get('/pharmacies', function () {
    return view('pharmacies.index');
});

Route::get('/revenues', function () {
    return view('revenues.index');
});



//====================Pharmacy=========================
Route::group(['middleware' => ['auth','role:admin|pharmacy']], function () {
    Route::get('/pharmacies', 'PharmacyController@show')->name('pharmacy.show');
    Route::get('/pharmacies/edit/{pharmacyId}', 'PharmacyController@edit')->name('pharmacy.edit');
    Route::post('/pharmacies/{ID}', 'PharmacyController@update')->name('pharmacy.update');

//======================Revenue=========================
Route::get('/revenues', 'RevenueController@show')->name('revenue.show');
Route::get('/revenues/create', 'RevenueController@create')->name('revenue.create');
Route::post('/revenues', 'RevenueController@store')->name('revenue.store');
Route::get('/revenues/edit/{revenueId}', 'RevenueController@edit')->name('revenue.edit');
Route::post('/revenues/{ID}', 'RevenueController@update')->name('revenue.update');
Route::get('/revenues/{delId}', 'RevenueController@delete')->name('revenue.delete');
});

Route::group(['middleware' => ['auth','role:admin']], function () {
    
    Route::get('/pharmacies/create', 'PharmacyController@create')->name('pharmacy.create');
    Route::get('/pharmacies/{delId}', 'PharmacyController@delete')->name('pharmacy.delete');
    Route::post('/pharmacies', 'PharmacyController@store')->name('pharmacy.store');
});
