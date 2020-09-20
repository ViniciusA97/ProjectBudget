<?php
use Illuminate\Support\Facades\Route;

    Route::post('','SubtagController@post');
    Route::post('/update','SubtagController@update');
    Route::delete('/{id}','SubtagController@delete');
    Route::get('/{id}','SubtagController@get');

?>