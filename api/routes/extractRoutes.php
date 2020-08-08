<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Api\Controllers;

    Route::get('/by_user/{user_id}','ExtractController@getByUser');
    Route::post('','ExtractController@post');
    Route::post('/update','ExtractController@update');
    Route::delete('/{id}','ExtractController@delete');
    Route::get('/{id}','ExtractController@get');
    

?>