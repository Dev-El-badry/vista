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

    //Lab Titles
    Route::resource('lab_title', 'LabController', ['except'=> ['show', 'index']]);
    Route::get('/lab_title/index', 'LabController@index')->name('lab_title.index');
    Route::prefix('lab_title')->group(function() {
        Route::post('/sort', 'LabController@sort');
        Route::get('/del_config/{id}', 'LabController@del_config')->name('lab_title.cdc_del_config');

        Route::get('/get_requests', 'LabController@get_requests')->name('lab_title.get_requests');
        Route::post('/active_request', 'LabController@active_request')->name('lab_title.active_request');
        Route::post('/delete_request', 'LabController@delete_request')->name('lab_title.delete_request');
    });

    //Drug Allergy Titles
    Route::resource('drug_allergy_list', 'DrugAllergyListController', ['except'=> ['show', 'index']]);
    Route::get('/drug_allergy_list/index', 'DrugAllergyListController@index')->name('drug_allergy_list.index');
    Route::prefix('drug_allergy_list')->group(function() {
        Route::post('/sort', 'DrugAllergyListController@sort');
        Route::get('/del_config/{id}', 'DrugAllergyListController@del_config')->name('drug_allergy_list.cdc_del_config');

        Route::get('/get_requests', 'DrugAllergyListController@get_requests')->name('drug_allergy_list.get_requests');
        Route::post('/active_request', 'DrugAllergyListController@active_request')->name('drug_allergy_list.active_request');
        Route::post('/delete_request', 'DrugAllergyListController@delete_request')->name('drug_allergy_list.delete_request');
    });


    //Drug Allergy Titles
    Route::resource('chronic_drug_list', 'ChronicDrugListController', ['except'=> ['show', 'index']]);
    Route::get('/chronic_drug_list/index', 'ChronicDrugListController@index')->name('chronic_drug_list.index');
    Route::prefix('chronic_drug_list')->group(function() {
        Route::post('/sort', 'ChronicDrugListController@sort');
        Route::get('/del_config/{id}', 'ChronicDrugListController@del_config')->name('chronic_drug_list.cdc_del_config');

        Route::get('/get_requests', 'ChronicDrugListController@get_requests')->name('chronic_drug_list.get_requests');
        Route::post('/active_request', 'ChronicDrugListController@active_request')->name('chronic_drug_list.active_request');
        Route::post('/delete_request', 'ChronicDrugListController@delete_request')->name('chronic_drug_list.delete_request');
    });

    //Request Optionss
    Route::resource('request_options', 'RequestOptionsController');
    Route::get('request_options/delete_config/{update_id}', 'RequestOptionsController@delete_config')->name('request_options.delete_config');

    //Manage Requests
    Route::prefix('requests')->group(function() {
        Route::get('/index', 'RequestsController@index')->name('requests.index');
        Route::get('/view/{update_id}', 'RequestsController@view')->name('requests.view');
        Route::get('/delete_config/{update_id}', 'RequestsController@delete_config')->name('requests.delete_config');
        Route::post('/update_option/{update_id}', 'RequestsController@update_option')->name('requests.update_option');
        Route::post('/update_status/{update_id}', 'RequestsController@update_status')->name('requests.update_status');
        Route::delete('/destroy/{update_id}', 'RequestsController@destroy')->name('requests.destroy');
    }); 

    //Public Users
     //Manage Requests
    Route::prefix('public_users')->group(function() {
        Route::get('/index', 'PublicUserController@index')->name('public_users.index');
        Route::get('/view/{update_id}', 'PublicUserController@view')->name('public_users.view');
        Route::get('/delete_config/{update_id}', 'PublicUserController@delete_config')->name('public_users.delete_config');
      
        Route::post('/update_status/{update_id}', 'PublicUserController@update_status')->name('public_users.update_status');
        Route::delete('/destroy/{update_id}', 'PublicUserController@destroy')->name('public_users.destroy');
    }); 

    //Compliant Titles
    Route::resource('compliant_title', 'CompliantTitleController', ['except'=> ['show', 'index']]);
    Route::get('/compliant_title/index', 'CompliantTitleController@index')->name('compliant_title.index');
    Route::prefix('compliant_title')->group(function() {
        Route::post('/sort', 'CompliantTitleController@sort');
        Route::get('/del_config/{id}', 'CompliantTitleController@del_config')->name('compliant_title.cdc_del_config');

        Route::get('/get_requests', 'CompliantTitleController@get_requests')->name('compliant_title.get_requests');
        Route::post('/active_request', 'CompliantTitleController@active_request')->name('compliant_title.active_request');
        Route::post('/delete_request', 'CompliantTitleController@delete_request')->name('compliant_title.delete_request');
    });

});