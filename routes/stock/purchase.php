<?php

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

