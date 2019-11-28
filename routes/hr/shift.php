<?php

Route::resource('shift','HrShiftController');

Route::resource ('shift-hours','HrShiftHoursController');
Route::get      ('shift-employees','HrShiftController@shifEmployees');
Route::post     ('attach-shift','HrShiftController@attachShift');
Route::Delete   ('detach-shift','HrShiftController@detachShift');
