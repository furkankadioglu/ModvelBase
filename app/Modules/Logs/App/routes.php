<?php

Route::group(array('module' => 'Logs', 'middleware' =>  ['web', 'auth', 'admin'], 'namespace' => 'App\Modules\Logs\App\Http\Controllers'), function() {

    // Logs - Settings
    Route::put('/admin/modules/Logs/settings/', array('uses' => '\App\Modules\Logs\App\Http\Controllers\LogsAdminSettingsController@update', 'as' => 'admin.Logs.settings.update'));
    Route::post('/admin/modules/Logs/settings/', array('uses' => '\App\Modules\Logs\App\Http\Controllers\LogsAdminSettingsController@store', 'as' => 'admin.Logs.settings.store'));

    Route::get('/admin/modules/Logs/settings/{id}/delete', array('uses' => '\App\Modules\Logs\App\Http\Controllers\LogsAdminSettingsController@destroy', 'as' => 'admin.Logs.settings.destroy'));
    Route::get('/admin/modules/Logs/settings/create', array('uses' => '\App\Modules\Logs\App\Http\Controllers\LogsAdminSettingsController@create', 'as' => 'admin.Logs.settings.create'));
    Route::get('/admin/modules/Logs/settings/', array('uses' => '\App\Modules\Logs\App\Http\Controllers\LogsAdminSettingsController@index', 'as' => 'admin.Logs.settings.index'));

    // Logs - Admin
    Route::post('/admin/modules/Logs/', array('uses' => '\App\Modules\Logs\App\Http\Controllers\LogsAdminController@store', 'as' => 'admin.Logs.store'));
    Route::get('/admin/modules/Logs', array('uses' => '\App\Modules\Logs\App\Http\Controllers\LogsAdminController@index', 'as' => 'admin.Logs.index'));

});	
