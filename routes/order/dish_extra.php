<?php

//------------- extra  --------------------------
Route::get ('dish-size/extra/{dish_size_id}',   'ExtraDishController@index')   ->name('dish.extra.index');;
Route::post('dish-size/extra',                  'ExtraDishController@store')   ->name('dish.extra.store');
Route::get('dish-size/extra/delete/{id}',       'ExtraDishController@delete')  ->name('dish.extra.delete');
