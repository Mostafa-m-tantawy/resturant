<?php



Route::middleware(['auth'])->group(function () {

    Route::resource('earning-deduction', 'HrEarningDeductionController');;
    Route::resource('earning-details', 'HrEarningDeductionDetailsController');;

});



