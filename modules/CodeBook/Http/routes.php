<?php

Route::resource('categories', 'CategoriesController');

Route::group(['prefix' => 'books/{book}'], function () {
    Route::resource('chapters', 'ChaptersController');
});

Route::resource('books', 'BooksController');

Route::group(['prefix' => 'trashed', 'as' => 'trashed.'], function () {
    Route::resource('books', 'BooksTrashedController',
        ['except' => ['store', 'create', 'edit']]
    );
});
