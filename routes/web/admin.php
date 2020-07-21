<?php


Route::get('/' , function() {
	return view('admin.index');
});

Route::resource('users' , 'UserController');
Route::resource('permissions' , 'PermissionController');
Route::resource('roles' , 'RoleController');
