<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Api\Controllers;

    Route::get('','ExtractController@get');
    Route::post('','ExtractController@post');
    Route::put('','ExtractController@put');
    Route::delete('','ExtractController@delete');
    

?>