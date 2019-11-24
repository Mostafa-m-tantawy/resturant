<?php
// -------------------------unit routes--------------------------------

Route::resource('unit','UnitController');
Route::get('unit/delete/{id}','UnitController@destroy');
Route::post ('unit/update',     'UnitController@update');

