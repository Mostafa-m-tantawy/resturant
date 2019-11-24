<?php


//--------------dish size-----------------
Route::get('/dish-size/{id}',       'DishSizeController@index')     ->name('dish.size.index');
Route::post('/dish-size/store',     'DishSizeController@store')     ->name('dish.size.store');
Route::post('/dish-size/update',    'DishSizeController@update')    ->name('dish.size.update');
Route::get('/dish-size/delete/{id}','DishSizeController@delete')    ->name('dish.size.delete');


