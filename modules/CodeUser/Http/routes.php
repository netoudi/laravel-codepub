<?php

Route::group(['middleware' => 'web', 'prefix' => 'codeuser', 'namespace' => 'Modules\CodeUser\Http\Controllers'],
    function () {
        Route::get('/', 'CodeUserController@index');
    });
