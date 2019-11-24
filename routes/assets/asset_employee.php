<?php

Route::delete('asset/detach-employee/{id}','AssetController@detachEmployee')->name('asset.detachEmployee');
Route::post('asset/attach-employee/{id}','AssetController@attachEmployee')->name('asset.attachEmployee');;

