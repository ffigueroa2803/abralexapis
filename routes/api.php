<?php

Route::group(['prefix' => 'v1', 'middleware' => ['jwt']], function () {
    Route::resource('documento', 'DocumentoController');
});

Route::post('sign', 'JWTController@sign');
Route::post('signup', 'JWTController@signup');
