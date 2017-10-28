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

Route::get('export/aplikasi', [
'as' => 'export.aplikasi',
'uses' => 'AplicationsController@export'
]);
Route::post('export/aplikasi', [
'as' => 'export.aplikasi.post',
'uses' => 'AplicationsController@exportPost'
]);

// export team ke excel
Route::get('export/teams', [
'as' => 'export.teams',
'uses' => 'teamsController@export'
]);
Route::post('export/teams', [
'as' => 'export.teams.post',
'uses' => 'teamsController@exportPost'
]);

// import team ke excel
Route::get('template/teams', [
'as' => 'template.teams',
'uses' => 'TeamsController@generateExcelTemplate'
]);
Route::post('import/teams', [
'as' => 'import.teams',
'uses' => 'TeamsController@importExcel'
]);




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
	Route::resource('sprints', 'SprintsController'); 
	Route::resource('sprintbacklogs', 'SprintbacklogsController');
	Route::resource('users', 'UsersController');

	// route untuk membuat team
	route::resource('teams', 'TeamsController');
	route::resource('aplikasi', 'AplicationsController');

});
// route konfirmasi user
Route::get('/users/konfirmasi/{id}', [
	'middleware' => ['auth'], 
	'as' => 'users.konfirmasi', 
	'uses' => 'UsersController@konfirmasi'
]);

Route::get('/sprintbacklogs/create/{id}', [
	'middleware' => ['auth'], 
	'as' => 'sprintbacklogs.create_sprintbacklog', 
	'uses' => 'SprintbacklogsController@create_sprintbacklog'
]);

// untuk membuat reset password
Route::get('/users/repass/{id}', [
	'middleware' => ['auth'],
	'as' => 'users.repass',
	'uses' => 'UsersController@repass'
]);
Route::get('/teams/lists/{id}', [
	'middleware' => ['auth'],
	'as' => 'teams.lists',
	'uses' => 'TeamsController@lists'
]);

Route::get('/tema/{tema}', 'TemaController@AturTema');

Route::get('/settings/password', 'SettingsController@editPassword');
Route::post('/settings/password', 'SettingsController@updatePassword');
