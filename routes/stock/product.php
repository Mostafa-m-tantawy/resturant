<?php



Route::middleware(['auth'])->group(function () {
// -------------------------product   routes--------------------------------
    Route::resource('product','ProductController')->except(['update']);
    Route::post ('product/update',     'ProductController@update');
    Route::post ('product/quantity/{id}',     'ProductController@getProductQuantity');


// -------------------------product category  routes--------------------------------
    Route::resource('product-category','ProductCategoryController')->except(['update']);
    Route::post ('product-category/update',     'ProductCategoryController@update');

});
