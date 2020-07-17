<?php


Route::get('/' , function() {
	return view('admin.master');
});

Route::get('users' , function() {
	return 'users list';
});

