<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/anu', function () {
    return view('anu');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => ['auth']], function () {
	Route::resource('backlog', 'BackLogsController');

	// route untuk membuat team
	route::resource('teams', 'TeamsController');
	route::resource('aplikasi', 'AplicationsController');

});
