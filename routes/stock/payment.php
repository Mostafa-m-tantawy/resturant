<?php

// -------------------------  payment  --------------------------------

Route::post('payment/store','PaymentController@savePayment')->name('payment.create');
Route::get('purchase/delete/{id}','PaymentController@deletePayment')->name('payment.delete');


