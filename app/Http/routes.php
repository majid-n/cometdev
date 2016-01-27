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
Route::get('/backgrounds/{width}/{height}/{filename}', function($width,$height,$filename){

	$file = Storage::disk('local')->get('backgrounds/'.$filename);

	if(  $width === 'auto' && $height === 'auto'  ) $img = Image::make($file);
	else $img = Image::make($file)->resize($width, $height);
    
	$img->insert(public_path().'\\img\\logo\\comet_fa.png', 'bottom-right', 10, 10);
    $type = $img->mime();

    return $img->response($type);
});

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
});
