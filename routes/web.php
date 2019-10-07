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

Route::post ('address/update',     'SupplierController@updateAddress');
Route::post ('phone/update',     'SupplierController@updatePhone');


// -------------------------restaurant  routes--------------------------------
Route::resource('restaurant','RestaurantController');
Route::post ('restaurant/{id}/stock','RestaurantController@stock')->name('restaurant.stock');
// -------------------------department  routes--------------------------------
Route::resource('department','DepartmentController');
Route::any('departments/stock','DepartmentController@stock')->name('department.stock');

// ------------------------supplier routes--------------------------------
Route::resource('supplier','SupplierController');
Route::any  ('product/create/{supplier_id}',    'ProductController@products');
Route::post ('product/update/{supplier_id}',     'ProductController@updateProduct');
Route::get  ('product/delete/{supplier_id}',     'ProductController@deleteProduct');


// -------------------------unit routes--------------------------------

Route::resource('unit','UnitController');
Route::get('unit/delete/{id}','UnitController@destroy');
Route::post ('unit/update',     'UnitController@update');

//--------------------------purchase from supplier  routes------------------------------
Route::get ('purchase/create',     'PursesController@addPurchase');
Route::post('/save-purses','PursesController@savePurses');
Route::get('/get-unit-of-product/{id}','PursesController@getUnitOfProduct');
Route::get('purchase/show/{id}','PursesController@editPurses');
Route::post('/supplier-products/{supplier_id}','PursesController@supplierProducts');
Route::post('save-purses-product/{id}','PursesController@savePursesProduct');
Route::get('deleted-purses-product/{id}','PursesController@deletePursesProduct');
Route::get('purchase/summery','PursesController@SummeryIndex');
Route::get('purchase/detailed','PursesController@detailedIndex');

// -------------------------stock reports --------------------------------
Route::any('stock/index','StockController@index')->name('stock.index');


// -------------------------Assign to department or branch --------------------------------
Route::get('assign/create','AssignController@CreateAssign');
Route::post('/get-assignable/{id}','AssignController@getAssignable');
Route::post('/save-assign','AssignController@saveAssign');


Route::post('payment/store','PaymentController@savePayment')->name('payment.create');
Route::get('purchase/delete/{id}','PaymentController@deletePayment')->name('payment.delete');





Route::post('states','SupplierController@states');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
