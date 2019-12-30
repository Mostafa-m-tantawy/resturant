<?php
Route::middleware(['auth'])->group(function () {

    Route::resource('shift', 'HrShiftController');

    Route::resource('shift-hours', 'HrShiftHoursController');
    Route::get('shift-employees', 'HrShiftController@shiftEmployees');
    Route::post('attach-shift', 'HrShiftController@attachShift');
    Route::Delete('detach-shift', 'HrShiftController@detachShift');
});
