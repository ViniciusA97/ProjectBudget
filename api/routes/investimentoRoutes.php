<?php
use Illuminate\Support\Facades\Route;

    Route::get('/by_user/{user_id}','InvestimentoController@getByUser');
    Route::post('','InvestimentoController@post');
    Route::post('/update','InvestimentoController@update');
    Route::delete('/{id}','InvestimentoController@delete');
    Route::get('/{id}','InvestimentoController@get');

?>