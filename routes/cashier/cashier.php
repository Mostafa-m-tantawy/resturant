<?php

// -------------------------   dish category  routes--------------------------------


Route::get('request', 'MoneyTransferController@request')
    ->name('cashier.request');;

Route::post('request', 'MoneyTransferController@storeRequest')
    ->name('cashier.storeRequest');;



Route::get('receive', 'MoneyTransferController@receive')
    ->name('cashier.receive');;

Route::post('approve/{id}', 'MoneyTransferController@storeApprove')
    ->name('cashier.storeApprove');;


Route::delete('request-delete/{id}', 'MoneyTransferController@cancelRequest')
    ->name('cashier.request.destroy');;

