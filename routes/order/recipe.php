<?php


//------------- Recipe  --------------------------
Route::get ('dish-size/recipe/{dish_size_id}',    'RecipeController@index')   ->name('dish.recipe.index');;
Route::post('dish-size/recipe',                  'RecipeController@store')   ->name('dish.recipe.store');
Route::get('dish-size/recipe/delete/{id}',       'RecipeController@delete')  ->name('dish.recipe.delete');

