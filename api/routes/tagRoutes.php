<?php
use Illuminate\Support\Facades\Route;

    Route::post('','TagController@post');
    Route::post('/update','TagController@update');
    Route::delete('/{id}','TagController@delete');
    Route::get('/{id}','TagController@get');

?>