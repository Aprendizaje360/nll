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

//Enterprise Login

Route::group(['prefix' => 'enterprise/login'], function(){
	Route::post('/', 'EnterpriseAuth\LoginController@apiLogin')->name('api.enterprise.login');
});

//User Login

Route::group(['prefix' => 'user'], function(){
	Route::post('/login', 'Auth\LoginController@apiLogin')->name('api.user.login');
	Route::put('/update', 'Api\UserController@updateUser')->name('api.user.update')->middleware('auth:api');
});

//Intervención

Route::group(['prefix' => 'user/intervention'], function(){
	Route::get('/', 'Api\InterventionController@getIntervention')->name('api.intervention.get');
	//Intervention Retrieval
	Route::post('/', 'Api\InterventionController@postResults')->name('api.intervention.post');
	Route::post('/percentile', 'Api\InterventionController@updateAndRetrievePercentile')->name('api.intervention.percentile');
});



// Route::group(['middleware' => 'auth:api', 'prefix' => 'user/intervention'], function(){
// });
