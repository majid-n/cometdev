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

Route::get('images/{disk}/{filename}', 'ImageController@retriveImages');
Route::get('images/{disk}/{width}/{height}/{watemark}/{filename}', 'ImageController@retriveImagesAdvanced');


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


Route::group([ 'middleware' => ['web'] ], function () {

	Route::get('login', 'AuthController@login');
	Route::post('login', 'AuthController@postLogin');
	Route::get('logout', 'AuthController@logout');

	Route::get('register', 'AuthController@register');
	Route::post('register', 'AuthController@postRegister');

	# Home page
	Route::get('/', 'HomeController@index');


	# Ajax
	Route::post('likepost', 'AjaxController@likePost');
	Route::get('paginatepost', 'AjaxController@paginatePost');
	Route::post('modalpost', 'AjaxController@modalPost');
	Route::post('contactform', 'AjaxController@contactForm');

	# Post element Methods
	Route::resource('post', 'PostController');

});


	
