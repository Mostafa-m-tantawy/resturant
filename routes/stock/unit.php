<?php


Route::middleware(['auth'])->group(function () {
// -------------------------unit routes--------------------------------

    Route::resource('unit','UnitController');



});
