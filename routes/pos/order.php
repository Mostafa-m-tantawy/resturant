<?php



Route::middleware(['auth'])->group(function () {

    Route::resource('order', 'PosOrderController');;

});



