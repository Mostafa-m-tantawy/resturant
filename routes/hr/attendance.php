<?php
Route::get('attendance/history','AttendanceController@history')->name('attendance.history');
Route::post('attendance/checkout/{id}','AttendanceController@checkout')->name('attendance.checkout');

Route::resource('attendance','AttendanceController');
