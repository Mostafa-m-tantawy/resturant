<?php

// -------------------------   dish category  routes--------------------------------
Route::resource('dish-category','DishCategoryController')->except(['update']);;
Route::post ('dish-category/update',     'DishCategoryController@update');


//-------------dish--------------------------
Route::resource ('dish',            'DishController');
Route::post('category-dishes/{id}', 'DishController@getDishes');

