<?php

Route::resource('role', 'RoleController');;
Route::post('role-association', 'RoleController@association')
->name('role.association');;
Route::delete('role-dissociation/{id}', 'RoleController@dissociation')
->name('role.dissociation');;

Route::resource('permission', 'PermissionController');;
Route::post('permission-association', 'PermissionController@association')
    ->name('permission.association');;
Route::delete('permission-association/{id}', 'PermissionController@dissociation')
    ->name('permission.dissociation');;
