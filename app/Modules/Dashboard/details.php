<?php
/*
|--------------------------------------------------------------------------
|
|   Dashboard Moduleaa
|
|--------------------------------------------------------------------------
*/

return [

    // General
    
    'name' => 'Dashboard',
    'description' => '',
    'creator' => 'Anonymous',
    'category' => 'Dashboard',
    'customer' => 'General',
    'icon' => 'fa fa-tachometer',
    'version' => '1.0.0',
    'optionalModules' => [

    ],
    'requiredModules' => [
        'Users'
    ],
    'requiredPackages' => [
        "spatie/laravel-analytics" => "^1.4",
        "spatie/browsershot" => "^1.5"
    ],

    // Admin

    'adminDisplayName' => 'Dashboard',
    'adminVisible' => 1,
    'adminDisplayOrder' => 0,
    'adminNavigationLinks' => [
    	'Genel Durum' => '/',
        'Ayarlar' => '/settings/'
    ],
    
    // Visitor

    'displayName' => 'Dashboard',
    'displayVisible' => 1,
    'displayOrder' => 0,
    'displayNavigationLinks' => [

    ],


];