<?php
Route::middleware(['auth'])->group(function () {

    Route::resource('holiday','HolidayController');;

});
