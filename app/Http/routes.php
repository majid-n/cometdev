<?php
/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

# Home page Routes
Route::get('/', 'HomeController@index')->name('home');

# Images Routes
Route::get('images/{disk}/{filename}', 'ImageController@retriveImages');
Route::get('images/{disk}/{width}/{height}/{watemark}/{filename}', 'ImageController@retriveImagesAdvanced');

# Posts Routes for all
Route::get('post', 'PostController@index')->name('post.index');
Route::get('post/{post}', 'PostController@show')->name('post.show');

# Supports Routes for all
Route::post('support', 'SupportController@store')->name('support.store');

# Posts Routes for all
Route::get('profile/{user}', 'UserController@show')->name('profile.show');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

# auth Folder Routes
Route::group([ 'middleware' => ['guest'] , 'namespace' => 'auth' ], function () {

	# Login and Register Routes
	Route::get('login'		, 'AuthController@login')->name('login');
	Route::post('login'		, 'AuthController@authenticate')->name('login.post');
	Route::get('register'	, 'AuthController@register')->name('register');
	Route::post('register'	, 'AuthController@store')->name('register.post');

	# Activation Progress Routes
	Route::get('activate'				, 'ActivationController@reactivate')->name('reactivate');
	Route::post('activate'				, 'ActivationController@generateActivate')->name('reactivate.post');
	Route::get('activate/{user}/{code}'	, 'ActivationController@activate')->name('activate');

	# Reset Password Progress Routes
	Route::get('forgot'					, 'PasswordController@forgot')->name('forgot');
	Route::post('forgot'				, 'PasswordController@prepareReset')->name('forgot.post');
	Route::get('reset/{user}/{code}'	, 'PasswordController@reset')->name('reset');
	Route::post('reset'					, 'PasswordController@resetPassword')->name('reset.post');
});

# Check User is Login
Route::group([ 'middleware' => ['auth'] ], function () {

	# Log Out Routes
	Route::group([ 'namespace' => 'auth' ], function () {
		# Logout Routes
		Route::get('logout'				, 'AuthController@logout')->name('logout');
		Route::get('logout/everywhere'	, 'AuthController@logoutEverywhere')->name('logout.all');
	});

	# RESTful resource for Users
	Route::resource('user', 'UserController', ['except' => ['create','store','edit','destroy']]);

	# Like Posts
	Route::get('post/{post}/like', 'PostController@like')->name('post.like');

	# RESTful resource Other Models
	Route::resource('rate'		, 'RateController'		, ['only' => ['store']]);
	Route::resource('comment'	, 'CommentController'	, ['only' => ['store','destroy']]);
	Route::resource('skill'		, 'SkillController'		, ['only' => ['store','destroy']]);
	Route::resource('xp'		, 'XpController'		, ['only' => ['store','destroy']]);
	Route::resource('lang'		, 'LangController'		, ['only' => ['store','destroy']]);
	Route::resource('edu'		, 'EduController'		, ['only' => ['store','destroy']]);
	Route::resource('resume'	, 'ResumeController'	, ['only' => ['store','destroy']]);

	Route::group([ 'middleware' => ['owner'] ], function () {
		# RESTful resource for Users
		Route::resource('user', 'UserController', ['only' => ['edit','destroy']]);
	});
});

# Check User is Login And Admin
Route::group([ 'middleware' => ['role:admins'], 'prefix' => 'admin'], function () {

	# RESTful resource Models for Admins
	Route::resource('cat'		, 'CatController'		, ['except' => ['show']]);
	Route::resource('post'		, 'PostController'		, ['except' => ['index','show']]);
	Route::resource('support'	, 'SupportController'	, ['except' => ['create', 'store', 'show']]);
});