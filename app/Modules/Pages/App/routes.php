<?php

Route::group(array('module' => 'Pages', 'middleware' =>  ['web', 'auth', 'admin'], 'namespace' => 'App\Modules\Pages\App\Http\Controllers'), function() {

    // Pages - Settings
    Route::put('/admin/modules/Pages/settings/', array('uses' => '\App\Modules\Pages\App\Http\Controllers\PagesAdminSettingsController@update', 'as' => 'admin.Pages.settings.update'));
    Route::post('/admin/modules/Pages/settings/', array('uses' => '\App\Modules\Pages\App\Http\Controllers\PagesAdminSettingsController@store', 'as' => 'admin.Pages.settings.store'));

    Route::get('/admin/modules/Pages/settings/{id}/delete', array('uses' => '\App\Modules\Pages\App\Http\Controllers\PagesAdminSettingsController@destroy', 'as' => 'admin.Pages.settings.destroy'));
    Route::get('/admin/modules/Pages/settings/create', array('uses' => '\App\Modules\Pages\App\Http\Controllers\PagesAdminSettingsController@create', 'as' => 'admin.Pages.settings.create'));
    Route::get('/admin/modules/Pages/settings/', array('uses' => '\App\Modules\Pages\App\Http\Controllers\PagesAdminSettingsController@index', 'as' => 'admin.Pages.settings.index'));
    // Pages- Homepage

    // Pages - Admin
    Route::post('/admin/modules/Pages/homepage/', array('uses' => '\App\Modules\Pages\App\Http\Controllers\PagesHomepageAdminController@store', 'as' => 'admin.Pages.homepage.store'));
    Route::put('/admin/modules/Pages/homepage/{id}', array('uses' => '\App\Modules\Pages\App\Http\Controllers\PagesHomepageAdminController@update', 'as' => 'admin.Pages.homepage.update'));

    Route::get('/admin/modules/Pages/homepage/', array('uses' => '\App\Modules\Pages\App\Http\Controllers\PagesHomepageAdminController@index', 'as' => 'admin.Pages.homepage.index'));


    // Pages - Admin
    Route::post('/admin/modules/Pages/', array('uses' => '\App\Modules\Pages\App\Http\Controllers\PagesAdminController@store', 'as' => 'admin.Pages.store'));
    Route::put('/admin/modules/Pages/{id}', array('uses' => '\App\Modules\Pages\App\Http\Controllers\PagesAdminController@update', 'as' => 'admin.Pages.update'));

    Route::get('/admin/modules/Pages', array('uses' => '\App\Modules\Pages\App\Http\Controllers\PagesAdminController@index', 'as' => 'admin.Pages.index'));
    Route::get('/admin/modules/Pages/{id}/delete', array('uses' => '\App\Modules\Pages\App\Http\Controllers\PagesAdminController@destroy', 'as' => 'admin.Pages.destroy'));
    Route::get('/admin/modules/Pages/{id}/edit', array('uses' => '\App\Modules\Pages\App\Http\Controllers\PagesAdminController@edit', 'as' => 'admin.Pages.edit'));
    Route::get('/admin/modules/Pages/create', array('uses' => '\App\Modules\Pages\App\Http\Controllers\PagesAdminController@create', 'as' => 'admin.Pages.create'));
    Route::get('/admin/modules/Pages/{id}', array('uses' => '\App\Modules\Pages\App\Http\Controllers\PagesAdminController@show', 'as' => 'admin.Pages.show'));
});	

Route::group(array('module' => 'Pages', 'middleware' =>  ['web'], 'namespace' => 'App\Modules\Pages\App\Http\Controllers'), function() {

    Route::get('/', array('uses' => '\App\Modules\Pages\App\Http\Controllers\PagesController@homepage', 'as' => 'admin.Pages.homepage'));
    Route::resource('Pages', '\App\Modules\Pages\App\Http\Controllers\PagesController');
});	