<?php
Route::middleware(['auth'])->group(function () {

    Route::resource('employee','EmployeeController');;

});
