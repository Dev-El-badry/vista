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
});