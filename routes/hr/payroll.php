<?php
Route::middleware(['auth'])->group(function () {

    Route::resource('payroll','HrPayrollController');;
    Route::resource('payroll-type','HrPayrollTypeController');;

});
