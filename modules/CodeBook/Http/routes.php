<?php

Route::resource('categories', 'CategoriesController');

Route::resource('books', 'BooksController');

Route::group(['prefix' => 'trashed', 'as' => 'trashed.'], function () {
    Route::resource('books', 'BooksTrashedController',
        ['except' => ['store', 'create', 'edit']]
    );
});
