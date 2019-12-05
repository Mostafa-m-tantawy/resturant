<?php



Route::middleware(['auth'])->group(function () {
//--------------------- ruined-------------------------
    Route::get ('ruined','RuinedController@index')->name('ruined.index');
    Route::get ('ruined/create','RuinedController@newRuined')->name('ruined.create');
    Route::post('/get-assignable-ruined/{id}','RuinedController@getAssignable');
    Route::post('ruined-products','RuinedController@ruinedProducts');
    Route::post('get-product-cost/{id}','RuinedController@getProductQuantity');
    Route::post('/save-ruined','RuinedController@saveRuined')->name('ruined.store');;


});
