<?php
Route::middleware(['auth'])->group(function () {

    Route::resource('approve-type','HrApproveTypeController');;
    Route::resource('approver','HrApproversController');;
    Route::get('approve-request/my-requests','HrApproveRequestController@myRequests');;
    Route::get('approve-request/my-approves','HrApproveRequestController@myApproves');;
    Route::post('approve-request/response/{id}','HrApproveRequestController@response');;


});
