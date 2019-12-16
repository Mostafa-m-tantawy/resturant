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

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('states', 'SupplierController@states');
Auth::routes();
Route::resource('restaurant', 'RestaurantController')->only([
    'store',
]);


Route::middleware(['auth'])->group(function () {
    Route::resource('order-payment', 'OrderPaymentController');

    Route::get('download', 'DashboardController@download');
    Route::post('chang-lang', 'DashboardController@changLang');

    Route::post('address/update', 'SupplierController@updateAddress');
    Route::post('phone/update', 'SupplierController@updatePhone');
    Route::post('delete/address-phones', 'SupplierController@deleteAddressPhones');


    Route::prefix('stock')->middleware(['auth'])->group(function () {
// -------------------------restaurant  routes--------------------------------
        Route::resource('restaurant', 'RestaurantController')->except(['store']);;
        Route::post('restaurant/{id}/stock', 'RestaurantController@stock')->name('restaurant.stock');
        Route::any('/dashboard', 'DashboardController@stockDashboard')->name('dashboard.stock');
        include('stock/department.php');
        include('stock/product.php');
        include('stock/supplier.php');
        include('stock/unit.php');
        Route::any('stock/index', 'StockController@index')->name('stock.index');
        include('stock/purchase.php');
        include('stock/assign.php');
        include('stock/payment.php');
        include('stock/refund.php');
        include('stock/ruined.php');
        include('stock/expense.php');

    });


    Route::prefix('hr')->middleware(['auth'])->group(function () {

        Route::any('/dashboard', 'DashboardController@hrDashboard')->name('dashboard.hr');

        include('hr/approve.php');
        include('hr/employee.php');
        include('hr/leave.php');
        include('assets/asset.php');
        include('assets/asset_employee.php');
        include('hr/shift.php');
        include('hr/attendance.php');
        include('hr/holiday.php');
        include('hr/payroll.php');
        include('hr/payslip.php');
        include('hr/earningDeduction.php');
        include('hr/taxes.php');

    });


    Route::prefix('cost')->middleware(['auth'])->group(function () {
        Route::any('/dashboard', 'DashboardController@salesDashboard')->name('dashboard.cost');

        include('order/dish.php');
        include('order/dish_extra.php');
        include('order/dish_side.php');
        include('order/dish_size.php');
        include('order/ruined.php');
        include('order/order.php');
        include('order/recipe.php');
    });

    Route::prefix('pos')->middleware(['auth'])->group(function () {
        Route::any('/dashboard', 'DashboardController@posDashboard')->name('dashboard.pos');
        include('pos/order.php');
        include('pos/hall.php');

    });
    Route::prefix('conf')->middleware(['auth'])->group(function () {
        include('conf/conf.php');
        include('conf/hall.php');
        include('conf/table.php');

    });


    Route::any('/dashboard', 'DashboardController@dashboard')->name('dashboard');
    Route::get('/logout', function () {
        Auth::logout();
        return redirect(route('home'));
    });

});




//Route::get('/register', 'HomeController@register')->name('register');
