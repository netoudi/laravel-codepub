<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('categories', 'CategoriesController');
    Route::resource('books', 'BooksController');

    Route::group(['prefix' => 'trashed', 'as' => 'trashed.'], function () {
        Route::resource('books', 'BooksTrashedController',
            ['except' => ['store', 'create', 'edit']]
        );
    });
});
