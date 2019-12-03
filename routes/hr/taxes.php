<?php
Route::middleware(['auth'])->group(function () {

    Route::resource('taxes','HrTaxesController');;

});
