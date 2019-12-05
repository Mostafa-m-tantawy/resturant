<?php


Route::middleware(['auth'])->group(function () {
// -------------------------department  routes--------------------------------
    Route::resource('department','DepartmentController');
    Route::any('departments/stock','DepartmentController@stock')->name('department.stock');

});
