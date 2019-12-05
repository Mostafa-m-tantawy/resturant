<?php



Route::middleware(['auth'])->group(function () {
// -------------------------Assign to department or branch --------------------------------
    Route::get('assign/index','AssignController@index');
    Route::get('assign/create','AssignController@CreateAssign');
    Route::post('/get-sourceable/{id}','AssignController@getSource');
    Route::post('/get-sourceable-products','AssignController@getSourceProducts');
    Route::post('/save-assign','AssignController@saveAssign');


});
