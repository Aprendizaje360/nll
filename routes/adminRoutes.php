<?php

/**
 * Auth routes
 */

Route::group(['middleware'=>'admin_guest'], function(){
	// Route::get('admin_register', 'AdminAuth\RegisterController@showRegistrationForm');
	// Route::post('admin_register', 'AdminAuth\RegisterController@register');
	Route::get('admin_login', 'AdminAuth\LoginController@showLoginForm');
	Route::post('admin_login', 'AdminAuth\LoginController@login');
	Route::get('admin_password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm');
	Route::post('admin_password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail');
	Route::get('admin_password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');
	Route::post('admin_password/reset', 'AdminAuth\ResetPasswordController@reset');	
});


Route::group(['middleware'=>'admin_auth'], function(){
	Route::get('admin_logout', 'AdminAuth\LoginController@logout')->name('admin.logout');
	Route::get('/admin_home', function(){
	  return view('admin.home');
	})->name('admin.home');
});

//////////////////////////
//      Admin User      //
//////////////////////////

Route::group(['middleware' => 'superadmin_only', 'prefix'=>'admin/administrator'], function(){
	Route::get('/', 'AdminPanel\AdminUserController@index')->name('admin.dashboard');
	Route::post('/', 'AdminPanel\AdminUserController@store')->name('admin.store');
	Route::get('edit/{admin}', 'AdminPanel\AdminUserController@edit')->name('admin.edit');
	Route::put('edit/{admin}', 'AdminPanel\AdminUserController@update')->name('admin.update');
	Route::delete('delete/{admin}', 'AdminPanel\AdminUserController@delete')->name('admin.delete');
});


//////////////////////////
//      Admin Profile   //
//////////////////////////

Route::group(['middleware' => 'admin_auth', 'prefix'=>'admin/userpanel'], function(){
	Route::get('/{admin}', 'AdminPanel\AdminUserController@showPanel')->name('admin.profile');
	Route::put('/{admin}', 'AdminPanel\AdminUserController@profileUpdate')->name('admin.profile.update');;
});

//////////////////////////
//      Enterprises     //
//////////////////////////

Route::group(['middleware' => 'superadmin_only', 'prefix'=>'admin/clients/enterprises'], function(){
	Route::get('/', 'AdminPanel\EnterpriseController@index')->name('admin.enterprise.dashboard');
	Route::get('/{enterprise}', 'AdminPanel\EnterpriseController@show')->name('admin.enterprise.show');
	Route::post('/', 'AdminPanel\EnterpriseController@store')->name('admin.enterprise.store');
	Route::get('edit/{enterprise}', 'AdminPanel\EnterpriseController@edit')->name('admin.enterprise.edit');
	Route::put('edit/{enterprise}', 'AdminPanel\EnterpriseController@update')->name('admin.enterprise.update');
	Route::delete('delete/{enterprise}', 'AdminPanel\EnterpriseController@delete')->name('admin.enterprise.delete');
});

//////////////////////////
//      Licenses     //
//////////////////////////

Route::group(['middleware' => 'admin_auth', 'prefix'=>'admin/clients/licenses'], function(){
	Route::get('/', 'AdminPanel\LicenseController@index')->name('admin.license.dashboard');
	Route::get('/', 'AdminPanel\LicenseController@show')->name('admin.license.show');
	Route::post('/', 'AdminPanel\LicenseController@store')->name('admin.license.store');
	Route::get('edit/{license}', 'AdminPanel\LicenseController@edit')->name('admin.license.edit');
	Route::put('edit/{license}', 'AdminPanel\LicenseController@update')->name('admin.license.update');
	Route::delete('delete/{license}', 'AdminPanel\LicenseController@delete')->name('admin.license.delete');
});

//////////////////////////
//      Users           //
//////////////////////////

// Route::group(['middleware' => 'admin_auth', 'prefix'=>'admin/clients/persons'], function(){
// 	Route::get('/', 'AdminPanel\UserController@index')->name('admin.user.dashboard');
// 	Route::post('/', 'AdminPanel\UserController@store')->name('admin.user.store');
// 	Route::get('edit/{user}', 'AdminPanel\UserController@edit')->name('admin.user.edit');
// 	Route::put('edit/{user}', 'AdminPanel\UserController@update')->name('admin.user.update');
// 	Route::delete('delete/{user}', 'AdminPanel\UserController@delete')->name('admin.user.delete');
// });


/////////////////////////////////
//    Modelo de Competencias   //
/////////////////////////////////

Route::group(['middleware' => 'admin_auth', 'prefix'=>'admin/modelcompetences'], function(){
	Route::get('/', 'AdminPanel\ModelCompetencesController@index')->name('admin.modelCompetences.dashboard');
	Route::get('/{modelCompetences}', 'AdminPanel\ModelCompetencesController@show')->name('admin.modelCompetences.show');
	Route::post('/', 'AdminPanel\ModelCompetencesController@store')->name('admin.modelCompetences.store');
	Route::get('edit/{modelCompetences}', 'AdminPanel\ModelCompetencesController@edit')->name('admin.modelCompetences.edit');
	Route::put('edit/{modelCompetences}', 'AdminPanel\ModelCompetencesController@update')->name('admin.modelCompetences.update');
	Route::delete('delete/{modelCompetences}', 'AdminPanel\ModelCompetencesController@delete')->name('admin.modelCompetences.delete');
});


//////////////////////
//    Competencias  //
//////////////////////

Route::group(['middleware' => 'admin_auth', 'prefix'=>'admin/competences'], function(){
	Route::get('/{competence}/levels', 'AdminPanel\CompetenceController@retrieveLevels')->name('admin.competence.levels');
	Route::post('/', 'AdminPanel\CompetenceController@store')->name('admin.competence.store');
	Route::get('edit/{competence}', 'AdminPanel\CompetenceController@edit')->name('admin.competence.edit');
	Route::put('edit/{competence}', 'AdminPanel\CompetenceController@update')->name('admin.competence.update');
	Route::delete('delete/{competence}', 'AdminPanel\CompetenceController@delete')->name('admin.competence.delete');
});


/////////////////////////////////
//    Intervenciones           //
/////////////////////////////////

Route::group(['middleware' => 'admin_auth', 'prefix'=>'admin/interventions'], function(){
	Route::get('/', 'AdminPanel\InterventionController@index')->name('admin.intervention.dashboard');
	Route::get('/{intervention}', 'AdminPanel\InterventionController@show')->name('admin.intervention.show');
	Route::post('/', 'AdminPanel\InterventionController@store')->name('admin.intervention.store');
	Route::get('edit/{intervention}', 'AdminPanel\InterventionController@edit')->name('admin.intervention.edit');
	Route::put('edit/{intervention}', 'AdminPanel\InterventionController@update')->name('admin.intervention.update');
	Route::delete('delete/{intervention}', 'AdminPanel\InterventionController@delete')->name('admin.intervention.delete');
});

//////////////////////
//    Secuencias    //
//////////////////////

Route::group(['middleware' => 'admin_auth', 'prefix'=>'admin/sequences'], function(){
	Route::get('/{intervention}', 'AdminPanel\SequenceController@create')->name('admin.sequence.create');
	Route::post('/{intervention}', 'AdminPanel\SequenceController@store')->name('admin.sequence.store');
	Route::get('edit/{sequence}', 'AdminPanel\SequenceController@edit')->name('admin.sequence.edit');
	Route::put('edit/{sequence}', 'AdminPanel\SequenceController@update')->name('admin.sequence.update');
	Route::delete('delete/{sequence}', 'AdminPanel\SequenceController@delete')->name('admin.sequence.delete');
});

//////////////////////
//    Niveles De Competencia   //
//////////////////////
