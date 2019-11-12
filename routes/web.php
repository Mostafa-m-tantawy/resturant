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
Route::get('/home', 'HomeController@index')->name('home');
Route::post('states','SupplierController@states');
Auth::routes();
Route::resource('restaurant','RestaurantController')->only([
    'store',
]);

include('seperated/employee.php');

Route::middleware(['auth'])->group(function () {
    Route::get ('download',     'DashboardController@download');
    Route::post ('chang-lang',     'DashboardController@changLang');



Route::post ('address/update',     'SupplierController@updateAddress');
Route::post ('phone/update',     'SupplierController@updatePhone');
Route::post ('delete/address-phones',     'SupplierController@deleteAddressPhones');


// -------------------------product category  routes--------------------------------
Route::resource('product-category','ProductCategoryController')->except(['update']);
Route::post ('product-category/update',     'ProductCategoryController@update');





// -------------------------product   routes--------------------------------
Route::resource('product','ProductController')->except(['update']);
Route::post ('product/update',     'ProductController@update');
Route::post ('product/quantity/{id}',     'ProductController@getProductQuantity');





// -------------------------restaurant  routes--------------------------------
Route::resource('restaurant','RestaurantController')->except(['store']);;
Route::post ('restaurant/{id}/stock','RestaurantController@stock')->name('restaurant.stock');




// -------------------------department  routes--------------------------------
Route::resource('department','DepartmentController');
Route::any('departments/stock','DepartmentController@stock')->name('department.stock');






// ------------------------supplier routes--------------------------------
Route::resource('supplier','SupplierController');
Route::any  ('product/create/{supplier_id}',    'ProductController@products');
Route::post ('product/update/{supplier_id}',     'ProductController@updateProduct');
Route::get  ('product/delete/{supplier_id}',     'ProductController@deleteProduct');
Route::get  ('product/index',     'ProductController@index');





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
Route::get('assign/index','AssignController@index');
Route::get('assign/create','AssignController@CreateAssign');
Route::post('/get-sourceable/{id}','AssignController@getSource');
Route::post('/get-sourceable-products','AssignController@getSourceProducts');
Route::post('/save-assign','AssignController@saveAssign');






// -------------------------  payment  --------------------------------

Route::post('payment/store','PaymentController@savePayment')->name('payment.create');
Route::get('purchase/delete/{id}','PaymentController@deletePayment')->name('payment.delete');





//--------------------- refund-------------------------
Route::get ('refund','RefundController@index')->name('refund.index');
Route::get ('refund/create','RefundController@newRefund')->name('refund.create');
Route::post('/save-refund','RefundController@saveRefund')->name('refund.store');;
Route::get('refund/delete/{id}','RefundController@deleteRefund')->name('refund.delete');;






//--------------------- ruined-------------------------
Route::get ('ruined','RuinedController@index')->name('ruined.index');
Route::get ('ruined/create','RuinedController@newRuined')->name('ruined.create');
Route::post('/get-assignable-ruined/{id}','RuinedController@getAssignable');
Route::post('ruined-products','RuinedController@ruinedProducts');
Route::post('get-product-cost/{id}','RuinedController@getProductQuantity');
Route::post('/save-ruined','RuinedController@saveRuined')->name('ruined.store');;






// -----------------expenses ----------------------------
Route::resource ('expenses','ExpensesController');




// -------------------------   dish category  routes--------------------------------
    Route::resource('dish-category','DishCategoryController')->except(['update']);;
    Route::post ('dish-category/update',     'DishCategoryController@update');


//-------------dish--------------------------
Route::resource ('dish',            'DishController');
Route::post('category-dishes/{id}', 'DishController@getDishes');



//--------------dish size-----------------
Route::get('/dish-size/{id}',       'DishSizeController@index')     ->name('dish.size.index');
Route::post('/dish-size/store',     'DishSizeController@store')     ->name('dish.size.store');
Route::post('/dish-size/update',    'DishSizeController@update')    ->name('dish.size.update');
Route::get('/dish-size/delete/{id}','DishSizeController@delete')    ->name('dish.size.delete');






//------------- Recipe  --------------------------
Route::get ('dish-size/recipe/{dish_size_id}',    'RecipeController@index')   ->name('dish.recipe.index');;
Route::post('dish-size/recipe',                  'RecipeController@store')   ->name('dish.recipe.store');
Route::get('dish-size/recipe/delete/{id}',       'RecipeController@delete')  ->name('dish.recipe.delete');




//------------- side  --------------------------
Route::get ('dish-size/side/{dish_size_id}',    'SideDishController@index')   ->name('dish.side.index');;
Route::post('dish-size/side',                  'SideDishController@store')   ->name('dish.side.store');
Route::get('dish-size/side/delete/{id}',       'SideDishController@delete')  ->name('dish.side.delete');





//------------- side  --------------------------
Route::get ('dish-size/extra/{dish_size_id}',   'ExtraDishController@index')   ->name('dish.extra.index');;
Route::post('dish-size/extra',                  'ExtraDishController@store')   ->name('dish.extra.store');
Route::get('dish-size/extra/delete/{id}',       'ExtraDishController@delete')  ->name('dish.extra.delete');

//------------- dish ruined  --------------------------

    Route::get ('dish-ruined',                  'DishRuinedController@index')                ->name('dish-ruined.index');;
    Route::get ('dish-ruined/create',           'DishRuinedController@newOrder')             ->name('dish-ruined.create');;
    Route::post('save-dish-ruined',             'DishRuinedController@saveOrder')            ->name('dish-ruined.save');;
    Route::get ('dish-ruined/edit/{id}',        'DishRuinedController@edit')                 ->name('dish-ruined.edit');;
    Route::post('dish-ruined/edit-json/{id}',   'DishRuinedController@editJson')             ->name('dish-ruined.edit.json');;
    Route::post('dish-ruined/update',           'DishRuinedController@update')               ->name('dish-ruined.update');;
    Route::get ('dish-ruined/delete/{id}',      'DishRuinedController@delete')               ->name('dish-ruined.delete');;


//------------- order  --------------------------
Route::get ('order',                'OrderController@index')                ->name('order.index');;
Route::get ('order/create',         'OrderController@newOrder')             ->name('order.create');;
Route::get ('order/cost',           'OrderController@costOrder')             ->name('order.cost');;
Route::post('save-order',           'OrderController@saveOrder')            ->name('order.save');;
Route::post('dish-available-units', 'OrderController@dishAvailableUnits')   ->name('order.dish.available');;
Route::post('all-delete-pending',   'OrderController@allDeletePending')     ->name('order.delete.pending');;
Route::post('dish-delete-pending',  'OrderController@DishDeletePending')    ->name('order.delete.pending');;
Route::get ('order/edit/{id}',      'OrderController@edit')                 ->name('order.edit');;
Route::post('order/edit-json/{id}', 'OrderController@editJson')             ->name('order.edit.json');;
Route::post('order/update',         'OrderController@update')               ->name('order.update');;
Route::get ('order/delete/{id}',    'OrderController@delete')               ->name('order.delete');;


//------------- system configuration  --------------------------
    Route::get ('system-configuration',             'systemConfigurationController@index')   ->name('system-conf.index');;
    Route::post ('system-configuration/store',      'systemConfigurationController@store')   ->name('system-conf.store');;



    Route::any('/dashboard', 'DashboardController@dashboard')->name('dashboard');
    Route::get('/logout', function (){
        Auth::logout();
        return redirect(route('home'));
    });

});




//Route::get('/register', 'HomeController@register')->name('register');
