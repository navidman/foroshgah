<?php


Route::get('/' , function() {
	// auth()->loginUsingId(1);
	return view('admin.index');
});

Route::resource('users' , 'User\UserController');
Route::get('/users/{user}/permissions' , 'User\PermissionController@create')->name('users.permissions')->middleware('can:staff-user-permissions');
Route::post('/users/{user}/permissions' , 'User\PermissionController@store')->name('users.permissions.store')->middleware('can:show-users');
Route::resource('permissions' , 'PermissionController');
Route::resource('roles' , 'RoleController');
Route::resource('products' , 'ProductController')->except('show');
