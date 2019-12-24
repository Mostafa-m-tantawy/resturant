<?php


Route::middleware(['auth'])->group(function () {

    Route::get('print/client/{id}', 'PrintController@client');;
    Route::get('print/department/{id}', 'PrintController@department');;

});



