<?php
Route::middleware(['auth'])->group(function () {

    Route::resource('employee','HrEmployeeController');;
    Route::resource('emergency','HrEmergencyContactsController');;

});
