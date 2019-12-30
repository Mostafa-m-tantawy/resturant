<?php
Route::middleware(['auth'])->group(function () {

    Route::resource('employee','HrEmployeeController');;
    Route::resource('emergency','HrEmergencyContactsController');;
Route::post('associate-role/{id}','HrEmployeeController@associate')->name('employee.associate-role');
Route::post('dissociate-role/{id}','HrEmployeeController@dissociate')->name('employee.dissociate-role');
});
