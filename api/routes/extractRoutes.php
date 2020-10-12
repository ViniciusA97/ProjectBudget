<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Api\Controllers;

    //v1.0 ok
    Route::get('/by_user/{user_id}','ExtractController@getByUser');
    Route::post('','ExtractController@post');
    Route::put('','ExtractController@update');
    Route::delete('/{id}','ExtractController@delete');
    Route::get('/{id}','ExtractController@get');
    

?>