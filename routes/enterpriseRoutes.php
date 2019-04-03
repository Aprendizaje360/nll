<?php

Route::group(['middleware' => 'enterprise_guest'], function() {
	//Route::get('enterprise_register', 'EnterpriseAuth\RegisterController@showRegistrationForm');
	//Route::post('enterprise_register', 'EnterpriseAuth\RegisterController@register');
	Route::get('enterprise_login', 'EnterpriseAuth\LoginController@showLoginForm');
	Route::post('enterprise_login', 'EnterpriseAuth\LoginController@login');
	Route::get('enterprise_password/reset', 'EnterpriseAuth\ForgotPasswordController@showLinkRequestForm');
	Route::post('enterprise_password/email', 'EnterpriseAuth\ForgotPasswordController@sendResetLinkEmail');
	Route::get('enterprise_password/reset/{token}', 'EnterpriseAuth\ResetPasswordController@showResetForm');
	Route::post('enterprise_password/reset', 'EnterpriseAuth\ResetPasswordController@reset');
});

Route::group(['middleware' => 'enterprise_auth'], function(){
	Route::get('enterprise/logout', 'EnterpriseAuth\LoginController@logout')->name('enterprise.logout');
	Route::get('/enterprise_home', 'EnterprisePanel\HomeController@home')->name('enterprise.home');
});


//////////////////////////
//      Empresas        //
//////////////////////////

Route::group(['middleware' => 'enterprise_auth', 'prefix'=>'enterprises'], function(){
	Route::get('/{enterprise}/clerk', 'EnterprisePanel\EnterpriseUserController@createClerk')->name('enterprise.create.clerk');
	Route::post('/{enterprise}/clerk', 'EnterprisePanel\EnterpriseUserController@storeClerk')->name('enterprise.store.clerk');
	Route::get('edit/clerk/{enterprise}', 'EnterprisePanel\EnterpriseUserController@editClerk')->name('enterprise.clerk.edit');
	Route::put('/edit/clerk/{enterprise}', 'EnterprisePanel\EnterpriseUserController@updateClerk')->name('enterprise.update.clerk');
	Route::delete('delete/clerk/{enterprise}', 'EnterprisePanel\EnterpriseUserController@deleteClerk')->name('enterprise.clerk.delete');
});

//////////////////////////
//      Usuarios        //
//////////////////////////

Route::group(['middleware' => ['enterprise_auth'], 'prefix'=>'enteprise'], function(){
	Route::post('/{enterprise}/{intervention}/users/upload', 'EnterprisePanel\UserController@upload')->name('enterprise.users.upload');
	Route::get('/{enterprise}/{intervention}/users/download', 'EnterprisePanel\UserController@download')->name('enterprise.users.download');
	Route::get('/{user}/{intervention}/sendToken', 'EnterprisePanel\UserController@sendToken')->name('enterprise.users.sendToken');
	Route::get('/users/edit/{enterprise}/{intervention}/{user}', 'EnterprisePanel\UserController@edit')->name('enterprise.users.edit');
	Route::put('/users/update/{user}/', 'EnterprisePanel\UserController@update')->name('enterprise.users.update');
	Route::delete('/{intervention}/users/delete/{user}', 'EnterprisePanel\UserController@delete')->name('enterprise.users.delete');
	
	Route::post('/{user}/{intervention}/sendResults', 'EnterprisePanel\UserController@sendResults')->name('enterprise.users.sendResults');
});
Route::get('/enteprise/{user}/{intervention}/getResults', 'EnterprisePanel\UserController@getResults')->name('enterprise.users.getResults');


//////////////////////////
//      Interventions   //
//////////////////////////

Route::group(['middleware' => ['enterprise_auth', 'int_perm'], 'prefix'=>'enterprise'], function(){
	Route::get('/{enterprise}/{intervention}', 'EnterprisePanel\InterventionController@show')->name('enterprise.intervention.show');
	Route::get('/{enterprise}/{intervention}/downloadPDF', 'EnterprisePanel\InterventionController@downloadPDF')->name('enterprise.intervention.pdf');
});

//////////////////////////
//      Reportes        //
//////////////////////////

Route::group(['middleware' => ['enterprise_auth', 'int_perm'], 'prefix'=>'enterprise'], function(){
	Route::get('/{enterprise}/{intervention}/reports', 'EnterprisePanel\InterventionController@showReports')->name('enterprise.intervention.report');
});