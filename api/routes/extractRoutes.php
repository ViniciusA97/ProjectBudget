<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Api\Controllers;

    Route::get('/{user_id}','ExtractController@get');
    Route::post('','ExtractController@post');
    Route::post('/update','ExtractController@update');
    Route::delete('/{id}','ExtractController@delete');
    

?>