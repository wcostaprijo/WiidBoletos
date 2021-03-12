<?php

use Illuminate\Support\Facades\Route;

Route::post('login','Api\\AuthController@login');
Route::post('register','Api\\AuthController@register');

Route::group(['middleware' => ['apiJWT'], 'namespace' => 'Api'], function() {
    Route::post('me','AuthController@me');

    Route::group(['prefix' => 'pagador'], function(){
        Route::get('me', 'PayerController@index');
        Route::post('create', 'PayerController@store');
        Route::post('update/{id}', 'PayerController@update');
        Route::post('delete/{id}', 'PayerController@destroy');
    });

    Route::group(['prefix' => 'boleto'], function(){
        Route::get('me', 'TitleController@index');
        Route::get('pagador/{id}', 'TitleController@listByPayer');
        Route::post('create', 'TitleController@store');
        Route::post('update/{id}', 'TitleController@update');
        Route::post('delete/{id}', 'TitleController@destroy');
    });
});
