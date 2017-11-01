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
Route::group(['prefix'=>'admin', 'middleware'=>['auth', 'role:admin']], function () {
	Route::resource('users', 'UsersController');
	// route untuk membuat team
	route::resource('teams', 'TeamsController');
	route::resource('aplikasi', 'AplicationsController');


	// route konfirmasi user
	Route::get('/users/konfirmasi/{id}', [
		'middleware' => ['auth'], 
		'as' => 'users.konfirmasi', 
		'uses' => 'UsersController@konfirmasi'
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
	// export user ke excel
	Route::get('export/users', [
		'as' => 'export.users',
		'uses' => 'UsersController@export'
	]);
	Route::get('exportAll/users', [
		'as' => 'exportAll.users.post',
		'uses' => 'UsersController@exportAllPost'
	]);
	Route::post('export/users', [
		'as' => 'export.users.post',
		'uses' => 'UsersController@exportPost'
	]);

// import user ke excel
	Route::get('template/users', [
		'as' => 'template.users',
		'uses' => 'UsersController@generateExcelTemplate'
	]);
	Route::post('import/users', [
		'as' => 'import.users',
		'uses' => 'UsersController@importExcel'
	]);

// export team ke excel
	Route::get('export/teams', [
		'as' => 'export.teams',
		'uses' => 'teamsController@export'
	]);

	Route::get('exportAll/teams', [
		'as' => 'exportAll.teams.post',
		'uses' => 'TeamsController@exportAllPost'
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

	Route::get('export/aplikasi', [
		'as' => 'export.aplikasi',
		'uses' => 'AplicationsController@export'
	]);
	Route::post('export/aplikasi', [
		'as' => 'export.aplikasi.post',
		'uses' => 'AplicationsController@exportPost'
	]);

	Route::get('export/semua_aplikasi', [
		'as' => 'export.aplikasi.all',
		'uses' => 'AplicationsController@exportAll'
	]);

	Route::get('template/aplikasi', [
		'as' => 'template.aplikasi',
		'uses' => 'AplicationsController@generateExcelTemplate'
	]);
	Route::post('import/aplikasi', [
		'as' => 'import.aplikasi',
		'uses' => 'AplicationsController@importExcel'
	]);
});



Route::group(['middleware' => ['auth']], function () {
	Route::resource('backlog', 'BackLogsController');
	Route::resource('sprints', 'SprintsController'); 
	Route::resource('sprintbacklogs', 'SprintbacklogsController');
	Route::get('export/backlog', [
		'as' => 'export.backlog',
		'uses' => 'BackLogsController@export'
	]);
	Route::get('/sprintbacklogs/create/{id}', [
		'middleware' => ['auth'], 
		'as' => 'sprintbacklogs.create_sprintbacklog', 
		'uses' => 'SprintbacklogsController@create_sprintbacklog'
	]);
	Route::get('/sprintbacklogs/create/{id}', [
		'middleware' => ['auth'], 
		'as' => 'sprintbacklogs.create_sprintbacklog', 
		'uses' => 'SprintbacklogsController@create_sprintbacklog'
	]);
	Route::post('export/backlog', [
		'as' => 'export.backlog.post',
		'uses' => 'BacklogsController@exportPost'
	]);
	Route::get('export/sprintbacklogs/{id}', [
		'middleware' => ['auth'], 
		'as' => 'export.sprintbacklogs',
		'uses' => 'SprintbacklogsController@export'
	]);
	Route::post('export/sprintbacklogs', [
		'as' => 'export.sprintbacklogs.post',
		'uses' => 'SprintbacklogsController@exportPost'
	]);

});


Route::get('/tema/{tema}', 'TemaController@AturTema');

Route::get('/sprintbacklogs/sb/detail_sb', [
	'as' => 'sprintbacklogs.detail_sb',
	'uses' => 'SprintbacklogsController@detailSb'
]);

Route::get('/', function () {
	return view('welcome');
});
Route::get('/anu', function () {
	return view('anu');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/settings/password', 'SettingsController@editPassword');
Route::post('/settings/password', 'SettingsController@updatePassword');
