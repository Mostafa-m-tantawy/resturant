<?php
Route::middleware(['auth'])->group(function () {

    Route::resource('payslip','HrPayslipController');;
Route::post('change-taxes','HrPayslipController@calculateTaxes');
});
