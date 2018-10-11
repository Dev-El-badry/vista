<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('users')->group(function() {
	
	Route::post('register', 'API\APIRegisterController@register');
	Route::post('verify', 'API\APIRegisterController@verifyUser');
	Route::post('login', 'API\APILoginController@login');
	Route::post('logout', 'API\APILoginController@logout');
	//Route::post('recover', 'API\Auth\RecoverPasswordController@recover')->name('api.user.recover');
});


Route::group(['middleware'=> ['jwt.auth']], function() {

	//Get Chronic Diseases Categories
	Route::prefix('cdc_categories')->group(function() {
		Route::get('/get_list', 'API\CDCController@get_list');
		Route::post('/add_cd_title', 'API\CDCController@add_cd_title');
	});

	//Save Cronic Disease Of User
	Route::prefix('cronic_disease')->group(function() {
		Route::post('/store', 'API\CDController@store');
		Route::post('/update', 'API\CDController@update');
		Route::post('/delete', 'API\CDController@delete');
		
	});

	//Get Job Titles
	Route::prefix('job_title')->group(function() {
		Route::get('/get_list', 'API\JobTitleController@get_list');
		Route::post('/add_job_title', 'API\JobTitleController@add_job_title');
	});

	//Update User Profile
	Route::prefix('users')->group(function() {
		Route::post('/update_profile/{update_id}', 'API\UserController@update_profile');
		Route::get('/view/{update_id}', 'API\UserController@view');
		Route::get('/delete_picture/{update_id}', 'API\UserController@delete_picture');
	});

	//Update Xray Report
	Route::prefix('xray_reports')->group(function() {
		Route::post('/store', 'API\XrayController@store');
		Route::post('/update/{update_id}', 'API\XrayController@update');
		Route::post('/delete_item', 'API\XrayController@delete_item');
	});

	//Get Lab Titles
	Route::prefix('lab_title')->group(function() {
		Route::get('/get_list', 'API\LabController@get_list');
		Route::post('/add_lab_title', 'API\LabController@add_lab_title');
	});

	//Update Labs 
	Route::prefix('labs')->group(function() {
		Route::post('/store', 'API\LabController@store');
		Route::post('/update/{update_id}', 'API\LabController@update');
		Route::post('/delete_item', 'API\LabController@delete_item');
	});

	//Get Drug Allergies Titles
	Route::prefix('drug_allergy_list')->group(function() {
		Route::get('/get_list', 'API\DrugAllergyController@get_list');
		Route::post('/add_lab_title', 'API\DrugAllergyController@add_lab_title');
	});

	//Update Drug Allergies List
	Route::prefix('drug_allergy')->group(function() {
		Route::post('/store', 'API\DrugAllergyController@store');
		Route::post('/update/{update_id}', 'API\DrugAllergyController@update');
		Route::post('/delete_item', 'API\DrugAllergyController@delete_item');
	});


	//Get Drug Allergies Titles
	Route::prefix('chronic_drug_list')->group(function() {
		Route::get('/get_list', 'API\ChronicDrugsController@get_list');
		Route::post('/add_lab_title', 'API\ChronicDrugsController@add_lab_title');
	});

	//Update Drug Allergies List
	Route::prefix('chronic_drug')->group(function() {
		Route::post('/store', 'API\ChronicDrugsController@store');
		Route::post('/update/{update_id}', 'API\ChronicDrugsController@update');
		Route::post('/delete_item', 'API\ChronicDrugsController@delete_item');
	});

	//Update Drug Allergies List
	Route::prefix('recent_drug')->group(function() {
		Route::post('/store', 'API\RecentDrugsController@store');
		Route::post('/update/{update_id}', 'API\RecentDrugsController@update');
		Route::post('/delete_item', 'API\RecentDrugsController@delete_item');
	});

	//Upload Old Reports
	Route::prefix('old_reports')->group(function() {
		Route::post('/store', 'API\OldReportController@store');
		Route::post('/delete_item', 'API\OldReportController@delete_item');
	});

	//Job List
	Route::prefix('job_identity')->group(function() {
		Route::get('/index/{user_id}', 'API\JobIdentityController@index');
		Route::post('/store/{user_id}', 'API\JobIdentityController@store');
	});

	//Business Model Profile
	Route::prefix('business_model')->group(function() {
		Route::post('/update_profile/{user_id}', 'API\BusinessModelController@update_profile');
		Route::get('/show_profile/{user_id}', 'API\BusinessModelController@show_profile');
	});

	//Get Compliant Titles
	Route::prefix('compliant_title')->group(function() {
		Route::get('/get_list', 'API\CompliantTitleController@get_list');
		Route::post('/add_job_title', 'API\CompliantTitleController@add_job_title');
	});



	
});