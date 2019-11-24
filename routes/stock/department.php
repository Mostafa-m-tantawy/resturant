<?php

// -------------------------department  routes--------------------------------
Route::resource('department','DepartmentController');
Route::any('departments/stock','DepartmentController@stock')->name('department.stock');
