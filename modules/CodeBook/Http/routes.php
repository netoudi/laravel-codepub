<?php

Route::group(['middleware' => 'web', 'prefix' => 'codebook', 'namespace' => 'Modules\CodeBook\Http\Controllers'], function()
{
    Route::get('/', 'CodeBookController@index');
});
