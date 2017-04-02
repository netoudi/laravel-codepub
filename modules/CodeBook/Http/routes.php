<?php

Route::resource('categories', 'CategoriesController');

Route::group(['prefix' => 'books/{book}'], function () {
    Route::get('cover', 'BooksController@coverForm')->name('books.cover.create');
    Route::post('cover', 'BooksController@coverStore')->name('books.cover.store');
    Route::resource('chapters', 'ChaptersController');
});

Route::resource('books', 'BooksController');

Route::group(['prefix' => 'trashed', 'as' => 'trashed.'], function () {
    Route::resource('books', 'BooksTrashedController',
        ['except' => ['store', 'create', 'edit']]
    );
});
