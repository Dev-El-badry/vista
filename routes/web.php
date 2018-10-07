<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('manage')->middleware('role:superadministrator|administrator|editor|author|contributor')->group(function() {

    Route::get('/', 'DashboardController@index');
    Route::get('/dashboard', 'DashboardController@dashboard')->name('home.dashboard');

    //Manage Users
    Route::resource('users', 'UserController');

    //Manage Permissions
    Route::resource('permissions', 'PermissionController');

    //Manage Roles
    Route::resource('roles', 'RoleController');

    //Cronic Disease Category
	Route::resource('/cronic_disease_category', 'ChronicDiseaseCategoryController', ['except'=> ['show', 'index']]);
	Route::get('cronic_disease_category/index', 'ChronicDiseaseCategoryController@index')->name('cronic_disease_category.index');
	Route::prefix('cronic_disease_category')->group(function() {
		Route::post('/sort', 'ChronicDiseaseCategoryController@sort');
		Route::get('/del_config/{id}', 'ChronicDiseaseCategoryController@del_config')->name('cdc_del_config');

        Route::get('/get_requests', 'ChronicDiseaseCategoryController@get_requests')->name('cdc.get_requests');
        Route::post('/active_request', 'ChronicDiseaseCategoryController@active_request')->name('cdc.active_request');
        Route::post('/delete_request', 'ChronicDiseaseCategoryController@delete_request')->name('cdc.delete_request');
	});

    //Job Titles
    Route::resource('job_title', 'JobTitleController', ['except'=> ['show', 'index']]);
    Route::get('/job_title/index', 'JobTitleController@index')->name('job_title.index');
    Route::prefix('job_title')->group(function() {
        Route::post('/sort', 'JobTitleController@sort');
        Route::get('/del_config/{id}', 'JobTitleController@del_config')->name('job_title.cdc_del_config');

        Route::get('/get_requests', 'JobTitleController@get_requests')->name('job_title.get_requests');
        Route::post('/active_request', 'JobTitleController@active_request')->name('job_title.active_request');
        Route::post('/delete_request', 'JobTitleController@delete_request')->name('job_title.delete_request');
    });
});