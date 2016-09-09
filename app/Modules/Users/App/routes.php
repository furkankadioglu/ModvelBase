<?php

Route::group(array('module' => 'Users', 'middleware' =>  ['web', 'auth', 'admin'], 'namespace' => 'App\Modules\Users\App\Http\Controllers'), function() {

    // Users - Information Templates
    Route::put('/admin/modules/Users/informations/{id}', array('uses' => '\App\Modules\Users\App\Http\Controllers\UsersInformationAdminController@update', 'as' => 'admin.Users.informations.update'));
    Route::post('/admin/modules/Users/informations/', array('uses' => '\App\Modules\Users\App\Http\Controllers\UsersInformationAdminController@store', 'as' => 'admin.Users.informations.store'));

    Route::get('/admin/modules/Users/informations/{id}/edit', array('uses' => '\App\Modules\Users\App\Http\Controllers\UsersInformationAdminController@edit', 'as' => 'admin.Users.informations.edit'));
    Route::get('/admin/modules/Users/informations/{id}/delete', array('uses' => '\App\Modules\Users\App\Http\Controllers\UsersInformationAdminController@destroy', 'as' => 'admin.Users.informations.destroy'));
    Route::get('/admin/modules/Users/informations/create', array('uses' => '\App\Modules\Users\App\Http\Controllers\UsersInformationAdminController@create', 'as' => 'admin.Users.informations.create'));
    Route::get('/admin/modules/Users/informations/', array('uses' => '\App\Modules\Users\App\Http\Controllers\UsersInformationAdminController@index', 'as' => 'admin.Users.informations.index'));

    // Users - Settings
    Route::put('/admin/modules/Users/settings/', array('uses' => '\App\Modules\Users\App\Http\Controllers\UsersAdminSettingsController@update', 'as' => 'admin.Users.settings.update'));
    Route::post('/admin/modules/Users/settings/', array('uses' => '\App\Modules\Users\App\Http\Controllers\UsersAdminSettingsController@store', 'as' => 'admin.Users.settings.store'));

    Route::get('/admin/modules/Users/settings/{id}/delete', array('uses' => '\App\Modules\Users\App\Http\Controllers\UsersAdminSettingsController@destroy', 'as' => 'admin.Users.settings.destroy'));
    Route::get('/admin/modules/Users/settings/create', array('uses' => '\App\Modules\Users\App\Http\Controllers\UsersAdminSettingsController@create', 'as' => 'admin.Users.settings.create'));
    Route::get('/admin/modules/Users/settings/', array('uses' => '\App\Modules\Users\App\Http\Controllers\UsersAdminSettingsController@index', 'as' => 'admin.Users.settings.index'));

    // Users - Access Levels
    Route::put('/admin/modules/Users/accesslevels/{id}', array('uses' => '\App\Modules\Users\App\Http\Controllers\AccessLevelsAdminController@update', 'as' => 'admin.Users.accesslevels.update'));
    Route::post('/admin/modules/Users/accesslevels/', array('uses' => '\App\Modules\Users\App\Http\Controllers\AccessLevelsAdminController@store', 'as' => 'admin.Users.settings.store'));

    Route::get('/admin/modules/Users/accesslevels/create', array('uses' => '\App\Modules\Users\App\Http\Controllers\AccessLevelsAdminController@create', 'as' => 'admin.Users.accesslevels.create'));
    Route::get('/admin/modules/Users/accesslevels/{id}/delete', array('uses' => '\App\Modules\Users\App\Http\Controllers\AccessLevelsAdminController@destroy', 'as' => 'admin.Users.accesslevels.destroy'));
    Route::get('/admin/modules/Users/accesslevels/{id}/edit', array('uses' => '\App\Modules\Users\App\Http\Controllers\AccessLevelsAdminController@edit', 'as' => 'admin.Users.accesslevels.edit'));
    Route::get('/admin/modules/Users/accesslevels/', array('uses' => '\App\Modules\Users\App\Http\Controllers\AccessLevelsAdminController@index', 'as' => 'admin.Users.accesslevels.index'));
    
    // Users - Admin
    Route::post('/admin/modules/Users/', array('uses' => '\App\Modules\Users\App\Http\Controllers\UsersAdminController@store', 'as' => 'admin.Users.store'));
    Route::put('/admin/modules/Users/{id}', array('uses' => '\App\Modules\Users\App\Http\Controllers\UsersAdminController@update', 'as' => 'admin.Users.update'));

    Route::get('/admin/modules/Users', array('uses' => '\App\Modules\Users\App\Http\Controllers\UsersAdminController@index', 'as' => 'admin.Users.index'));
    Route::get('/admin/modules/Users/{id}/delete', array('uses' => '\App\Modules\Users\App\Http\Controllers\UsersAdminController@destroy', 'as' => 'admin.Users.destroy'));
    Route::get('/admin/modules/Users/{id}/edit', array('uses' => '\App\Modules\Users\App\Http\Controllers\UsersAdminController@edit', 'as' => 'admin.Users.edit'));
    Route::get('/admin/modules/Users/create', array('uses' => '\App\Modules\Users\App\Http\Controllers\UsersAdminController@create', 'as' => 'admin.Users.create'));
    Route::get('/admin/modules/Users/{id}', array('uses' => '\App\Modules\Users\App\Http\Controllers\UsersAdminController@show', 'as' => 'admin.Users.show'));


});	

Route::group(array('module' => 'Users', 'middleware' =>  ['web', 'api'], 'namespace' => 'App\Modules\Users\App\Http\Controllers'), function() {
    Route::resource('UsersAPI', 'UsersApiController');
}); 

Route::group(array('module' => 'Users', 'middleware' =>  ['web'], 'namespace' => 'App\Modules\Users\App\Http\Controllers'), function() {

    Route::get('/Users/resetpassword/{token}', array('uses' => '\App\Modules\Users\App\Http\Controllers\UsersController@resetPassword', 'as' => 'Users.resetpassword'));
    Route::post('/Users/resetpassword/', array('uses' => '\App\Modules\Users\App\Http\Controllers\UsersController@resetPasswordStore', 'as' => 'Users.store.resetpassword'));

    Route::post('/Users/forgotpassword', array('uses' => '\App\Modules\Users\App\Http\Controllers\UsersController@forgotPasswordStore', 'as' => 'Users.store.forgotpassword'));
    Route::get('/Users/forgotpassword', array('uses' => '\App\Modules\Users\App\Http\Controllers\UsersController@forgotPassword', 'as' => 'Users.forgotpassword'));

    Route::post('/Users/register', array('uses' => '\App\Modules\Users\App\Http\Controllers\UsersController@registerStore', 'as' => 'Users.store.register'));
    Route::get('/Users/register', array('uses' => '\App\Modules\Users\App\Http\Controllers\UsersController@register', 'as' => 'Users.register'));

    Route::get('/Users/register/{provider?}',['uses' => '\App\Modules\Users\App\Http\Controllers\UsersAuthController@getSocialAuth', 'as'   => 'auth.getSocialAuth']);
    Route::get('/Users/register/callback/{provider?}',['uses' => '\App\Modules\Users\App\Http\Controllers\UsersAuthController@getSocialAuthCallback', 'as'   => 'auth.getSocialAuthCallback']);

    Route::post('/Users/login', array('uses' => '\App\Modules\Users\App\Http\Controllers\UsersController@loginStore', 'as' => 'Users.store.login'));
    Route::get('/Users/login', array('uses' => '\App\Modules\Users\App\Http\Controllers\UsersController@login', 'as' => 'Users.login'));

   

}); 


Route::group(array('module' => 'Users', 'middleware' =>  ['web', 'auth'], 'namespace' => 'App\Modules\Users\App\Http\Controllers'), function() {
    Route::get('/Users/logout', array('uses' => '\App\Modules\Users\App\Http\Controllers\UsersController@logout', 'as' => 'Users.logout'));
    Route::resource('Users', '\App\Modules\Users\App\Http\Controllers\UsersController');
});	

