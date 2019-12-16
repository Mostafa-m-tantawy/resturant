<?php



Route::middleware(['auth'])->group(function () {

    Route::resource('order', 'PosOrderController');;
    Route::post('all-dishes' ,'PosOrderController@allDishes');
    Route::post('get_order' ,'PosOrderController@getOrder');
    Route::post('close-order/{id}' ,'PosOrderController@closeOrder');

});



