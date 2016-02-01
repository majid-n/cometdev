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

Route::get('images/{Disk}/{Filename}', 'ImageController@RetriveImages');
Route::get('images/{Disk}/{Width}/{Height}/{Watemark}/{Filename}', 'ImageController@RetriveImagesAdvanced');


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

Route::group(['middleware' => ['web']], function () {
	Route::get('/', 'HomeController@index');
	Route::post('LikePost', 'AjaxController@LikePost');
	Route::get('PaginatePost', 'AjaxController@PaginatePost');
	Route::post('ModalPost', 'AjaxController@ModalPost');
	Route::post('ContactForm', 'AjaxController@ContactForm');
	
	Route::get('/Posts', 'AdminController@Posts');
	Route::post('/Post', 'AdminController@AddPost')->name('AddPost');
	Route::delete('/Post/{Post}', 'AdminController@DeletePost');
});
