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
	
}):