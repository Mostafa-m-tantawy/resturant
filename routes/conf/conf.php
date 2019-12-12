<?php


//------------- system configuration  --------------------------
Route::get ('system-configuration',             'systemConfigurationController@index')   ->name('system-conf.index');;
Route::post ('system-configuration/store',      'systemConfigurationController@store')   ->name('system-conf.store');;

