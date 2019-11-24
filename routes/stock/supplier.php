<?php

// ------------------------supplier routes--------------------------------
Route::resource('supplier','SupplierController');
Route::any  ('product/create/{supplier_id}',    'ProductController@products');
Route::post ('product/update/{supplier_id}',     'ProductController@updateProduct');
Route::get  ('product/delete/{supplier_id}',     'ProductController@deleteProduct');
Route::get  ('product/index',     'ProductController@index');

