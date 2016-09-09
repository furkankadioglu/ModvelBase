<?php

Route::group(array('module' => 'Dashboard', 'middleware' =>  ['web', 'auth', 'admin'], 'namespace' => 'App\Modules\Dashboard\App\Http\Controllers'), function() {

    // Dashboard - Settings
    Route::put('/admin/modules/Dashboard/settings/', array('uses' => '\App\Modules\Dashboard\App\Http\Controllers\DashboardAdminSettingsController@update', 'as' => 'admin.Dashboard.settings.update'));
    Route::post('/admin/modules/Dashboard/settings/', array('uses' => '\App\Modules\Dashboard\App\Http\Controllers\DashboardAdminSettingsController@store', 'as' => 'admin.Dashboard.settings.store'));

    Route::get('/admin/modules/Dashboard/settings/{id}/delete', array('uses' => '\App\Modules\Dashboard\App\Http\Controllers\DashboardAdminSettingsController@destroy', 'as' => 'admin.Dashboard.settings.destroy'));
    Route::get('/admin/modules/Dashboard/settings/create', array('uses' => '\App\Modules\Dashboard\App\Http\Controllers\DashboardAdminSettingsController@create', 'as' => 'admin.Dashboard.settings.create'));
    Route::get('/admin/modules/Dashboard/settings/', array('uses' => '\App\Modules\Dashboard\App\Http\Controllers\DashboardAdminSettingsController@index', 'as' => 'admin.Dashboard.settings.index'));

    // Dashboard - Admin
    Route::post('/admin/modules/Dashboard/', array('uses' => '\App\Modules\Dashboard\App\Http\Controllers\DashboardAdminController@store', 'as' => 'admin.Dashboard.store'));
    Route::put('/admin/modules/Dashboard/{id}', array('uses' => '\App\Modules\Dashboard\App\Http\Controllers\DashboardAdminController@update', 'as' => 'admin.Dashboard.update'));

    Route::get('/admin/', array('uses' => '\App\Modules\Dashboard\App\Http\Controllers\DashboardAdminController@index', 'as' => 'admin.Dashboard.index'));
    Route::get('/admin/modules/Dashboard', array('uses' => '\App\Modules\Dashboard\App\Http\Controllers\DashboardAdminController@index', 'as' => 'admin.Dashboard.index'));
    Route::get('/admin/modules/Dashboard/{id}/delete', array('uses' => '\App\Modules\Dashboard\App\Http\Controllers\DashboardAdminController@destroy', 'as' => 'admin.Dashboard.destroy'));
    Route::get('/admin/modules/Dashboard/{id}/edit', array('uses' => '\App\Modules\Dashboard\App\Http\Controllers\DashboardAdminController@edit', 'as' => 'admin.Dashboard.edit'));
    Route::get('/admin/modules/Dashboard/create', array('uses' => '\App\Modules\Dashboard\App\Http\Controllers\DashboardAdminController@create', 'as' => 'admin.Dashboard.create'));
    Route::get('/admin/modules/Dashboard/{id}', array('uses' => '\App\Modules\Dashboard\App\Http\Controllers\DashboardAdminController@show', 'as' => 'admin.Dashboard.show'));
});	
