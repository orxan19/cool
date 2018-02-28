<?php



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', function(){
	return view('admin.index');
});

Route::resource('admin/users', 'AdminUsersController');

