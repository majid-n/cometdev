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
Route::group([ 'namespace' => 'auth' ], function () {

	# Login and Register Routes
	Route::get('login', 'AuthController@login')->name('login');
	Route::post('login', 'AuthController@authenticate')->name('login.post');
	Route::get('register', 'AuthController@register')->name('register');
	Route::post('register', 'AuthController@store')->name('register.post');

	# Activation Progress Routes
	Route::get('activate', 'ActivationController@reactivate')->name('reactivate');
	Route::post('activate', 'ActivationController@generateActivate')->name('reactivate.post');
	Route::get('activate/{user}/{code}', 'ActivationController@activate')->name('activate');

	# Reset Password Progress Routes
	Route::get('forgot', 'PasswordController@forgot')->name('forgot');
	Route::post('forgot', 'PasswordController@prepareReset')->name('forgot.post');
	Route::get('reset/{user}/{code}', 'PasswordController@reset')->name('reset');
	Route::post('reset', 'PasswordController@resetPassword')->name('reset.post');
});

# Login Group Routes
Route::group([ 'middleware' => ['auth'] ], function () {

	# auth Folder Routes
	Route::group([ 'namespace' => 'auth' ], function () {
		# Logout Routes
		Route::get('logout', 'AuthController@logout')->name('logout');
		Route::get('logout/everywhere', 'AuthController@logoutEverywhere')->name('logout.all');
	});

	# user Folder Routes
	Route::group([ 'namespace' => 'user' ], function () {

		# RESTful Models for Users
		Route::resource('user', 'UserController');

		# Like Post for Login Users
		Route::get('post/{post}/like', 'PostController@like')->name('post.like');

		# Store models for Users
		Route::post('rate', 'RateController@store')->name('rate.store');
		Route::post('comment', 'CommentController@store')->name('comment.store');
		Route::post('skill', 'SkillController@store')->name('skill.store');
		Route::post('xp', 'XpController@store')->name('xp.store');
		Route::post('lang', 'LangController@store')->name('lang.store');
		Route::post('edu', 'EduController@store')->name('edu.store');
		Route::post('resume', 'ResumeController@store')->name('resume.store');

		# Destroy Models for Users
		Route::delete('comment/{comment}', 'CommentController@destroy')->name('comment.destroy');
		Route::delete('edu/{edu}','EduController@destroy')->name('edu.destroy');
		Route::delete('lang/{lang}','LangController@destroy')->name('lang.destroy');
		Route::delete('skill/{skill}','SkillController@destroy')->name('skill.destroy');
		Route::delete('xp/{xp}','XpController@destroy')->name('xp.destroy');
		Route::delete('resume/{resume}','ResumeController@destroy')->name('resume.destroy');
	});

	# Admins Folder Routes
	Route::group([ 'middleware' => ['role:admins'], 'prefix' => 'admin' , 'namespace' => 'admin'], function () {

		# RESTful Models for Admins
		Route::resource('post', 'PostController');
		Route::resource('cat', 'CatController');
		Route::resource('support', 'SupportController');

		# Destroy Models for Admins
		Route::delete('user/{user}','UserController@destroy')->name('admin.user.destroy');
		Route::delete('comment/{comment}','CommentController@destroy')->name('admin.comment.destroy');
		Route::delete('edu/{edu}','EduController@destroy')->name('admin.edu.destroy');
		Route::delete('lang/{lang}','LangController@destroy')->name('admin.lang.destroy');
		Route::delete('skill/{skill}','SkillController@destroy')->name('admin.skill.destroy');
		Route::delete('xp/{xp}','XpController@destroy')->name('admin.xp.destroy');
	});
});