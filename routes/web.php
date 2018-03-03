<?php



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', function(){
	return view('admin.index');
});

Route::group(['middleware' => 'admin'], function(){
	
	Route::resource('admin/users', 'AdminUsersController');

	Route::resource('admin/posts', 'AdminPostsController');
});



