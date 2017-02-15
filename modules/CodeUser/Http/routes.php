<?php

Route::resource('users', 'UsersController');

Route::resource('roles', 'RolesController');

Route::get('/roles/{role}/permissions', 'RolesController@editPermissions')->name('roles.permissions.edit');

Route::put('/roles/{role}/permissions', 'RolesController@updatePermissions')->name('roles.permissions.update');
