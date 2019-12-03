<?php
Route::get('attendance/history','HrAttendanceController@history')->name('attendance.history');
Route::post('attendance/checkout/{id}','HrAttendanceController@checkout')->name('attendance.checkout');

Route::resource('attendance','HrAttendanceController');
