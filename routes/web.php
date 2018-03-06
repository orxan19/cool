<?php



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/post/{id}', ['as'=> 'home.post' ,'uses' => 'AdminPostsController@post']);



Route::group(['middleware' => 'admin'], function(){
	
	Route::get('/admin', function(){
	return view('admin.index');
});
	Route::resource('admin/users', 'AdminUsersController');

	Route::resource('admin/posts', 'AdminPostsController');

	Route::resource('admin/categories', 'AdminCategoriesController');

	// Route::get('admin/media', ['as' => 'admin.media.index', 'uses' => 'AdminMediaController@index']);

	// Route::get('admin/media/upload', ['as' => 'admin.media.upload', 'uses' => 'AdminMediaController@create']);

	// Route::post('admin/media/upload', 'AdminMediaController@store');

	// Route::post('admin/media/{$id}', 'AdminMediaController@destroy');

	Route::resource('admin/media', 'AdminMediaController');

	Route::resource('admin/comments', 'PostCommentsController');

	Route::resource('admin/comment/replies', 'CommentRepliesController');
});


Route::get('setlocale/{locale}', function ($locale) {
  if (in_array($locale, \Config::get('app.locales'))) {
    Session::put('locale', $locale);    
  }
  return redirect()->back();
});



Route::group(['middleware' => 'auth'], function(){

	Route::post('comment/reply', 'CommentRepliesController@createReply');

});