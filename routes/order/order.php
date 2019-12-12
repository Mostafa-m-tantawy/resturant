<?php

//------------- order  --------------------------
Route::get ('order',                'OrderController@index')                ->name('order.index');;
Route::get ('order/create',         'OrderController@newOrder')             ->name('order.create');;
Route::get ('order/cost',           'OrderController@costOrder')            ->name('order.cost');;
Route::post('save-order',           'OrderController@saveOrder')            ->name('order.save');;
Route::post('dish-available-units', 'OrderController@dishAvailableUnits')   ->name('order.dish.available');;
Route::post('all-delete-pending',   'OrderController@allDeletePending')     ->name('order.delete.pending');;
Route::post('dish-delete-pending',  'OrderController@DishDeletePending')    ->name('order.delete.pending');;
Route::get ('order/edit/{id}',      'OrderController@edit')                 ->name('order.edit');;
Route::post('order/edit-json/{id}', 'OrderController@editJson')             ->name('order.edit.json');;
Route::post('order/update',         'OrderController@update')               ->name('order.update');;
Route::get ('order/delete/{id}',    'OrderController@delete')               ->name('order.delete');;

