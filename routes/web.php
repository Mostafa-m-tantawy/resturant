<?php

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

Route::get('/','HomeController@index');
Route::resource('supplier','SupplierController');

Route::post ('address/update',     'SupplierController@updateAddress');
Route::post ('phone/update',     'SupplierController@updatePhone');



Route::resource('restaurant','RestaurantController');

Route::any  ('product/create/{supplier_id}',    'ProductController@products');
Route::post ('product/update/{supplier_id}',     'ProductController@updateProduct');
Route::get  ('product/delete/{supplier_id}',     'ProductController@deleteProduct');


Route::resource('unit','UnitController');
Route::get('unit/delete/{id}','UnitController@destroy');
Route::post ('unit/update',     'UnitController@update');


Route::get ('purchase',     'PursesController@addPurchase');
//Route::get ('purchase/index',     'PursesController@index');
Route::get('/get-unit-of-product/{id}','PursesController@getUnitOfProduct');
Route::post('/save-purses','PursesController@savePurses');
Route::get('purchase/show/{id}','PursesController@editPurses');
Route::post('save-purses-product/{id}','PursesController@savePursesProduct');
Route::get('deleted-purses-product/{id}','PursesController@deletePursesProduct');




Route::post('payment/store','PaymentController@savePayment')->name('payment.create');
Route::get('purchase/delete/{id}','PaymentController@deletePayment')->name('payment.delete');





Route::post('states','SupplierController@states');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
