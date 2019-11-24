<?php
Route::middleware(['auth'])->group(function () {

    Route::resource('leave','HrLeaveController');;
    Route::resource('leave-type','HrLeaveTypeController');;

});
