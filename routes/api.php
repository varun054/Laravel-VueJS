<?php

use Illuminate\Http\Request;

Route::group(['prefix' => 'v1'], function() {

    Route::group(['middleware' => 'auth:api'], function() {
        Route::group(['middleware' => ['admin']], function () {
            Route::get('test/{id}', 'Web\AdminController@test');
        });
    });
});
