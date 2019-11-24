<?php



//------------- side  --------------------------
Route::get ('dish-size/side/{dish_size_id}',    'SideDishController@index')   ->name('dish.side.index');;
Route::post('dish-size/side',                  'SideDishController@store')   ->name('dish.side.store');
Route::get('dish-size/side/delete/{id}',       'SideDishController@delete')  ->name('dish.side.delete');


