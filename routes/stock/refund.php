<?php

//--------------------- refund-------------------------
Route::get ('refund','RefundController@index')->name('refund.index');
Route::get ('refund/create','RefundController@newRefund')->name('refund.create');
Route::post('/save-refund','RefundController@saveRefund')->name('refund.store');;
Route::get('refund/delete/{id}','RefundController@deleteRefund')->name('refund.delete');;

