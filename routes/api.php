<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('Api\V1')->group(function () {
    Route::group(['prefix' => 'v1/'], function () {
        Route::post('file', 'FileUploadController@fileUpload');
        Route::get('schedule', 'ScheduleController@getAll');
        Route::get('schedule/filter', 'ScheduleController@getByInterval');
    });
});
