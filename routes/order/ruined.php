<?php

//------------- dish ruined  --------------------------

Route::get ('dish-ruined',                  'DishRuinedController@index')                ->name('dish-ruined.index');;
Route::get ('dish-ruined/create',           'DishRuinedController@newOrder')             ->name('dish-ruined.create');;
Route::post('save-dish-ruined',             'DishRuinedController@saveOrder')            ->name('dish-ruined.save');;
Route::get ('dish-ruined/edit/{id}',        'DishRuinedController@edit')                 ->name('dish-ruined.edit');;
Route::post('dish-ruined/edit-json/{id}',   'DishRuinedController@editJson')             ->name('dish-ruined.edit.json');;
Route::post('dish-ruined/update',           'DishRuinedController@update')               ->name('dish-ruined.update');;
Route::get ('dish-ruined/delete/{id}',      'DishRuinedController@delete')               ->name('dish-ruined.delete');;
