<?php
Route::get('hall','PosHallController@index');
Route::post('transfer-table','PosHallController@transfer');
Route::post('merge','PosHallController@merge');
