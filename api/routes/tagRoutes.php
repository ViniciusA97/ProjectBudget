<?php
use Illuminate\Support\Facades\Route;

    Route::post('','TagController@post');
    Route::put('','TagController@update');
    Route::delete('/{id}','TagController@delete');
    Route::get('/{id}','TagController@get');

?>