<?php



Route::middleware(['auth'])->group(function () {

    Route::Get('life-kitchen', 'lifeKitchenController@lifeKitchen');;
    Route::post('life-kitchen-json', 'lifeKitchenController@lifeKitchenJson');;

});



