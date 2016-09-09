<?php
/*
|--------------------------------------------------------------------------
|
|   Users Module
|
|--------------------------------------------------------------------------
*/

return [

    // General
    
    'name' => 'Users',
    'description' => '',
    'creator' => 'Anonymous',
    'category' => 'General',
    'customer' => 'General',
    'icon' => 'fa fa-user',
    'version' => '1.0.0',
    'optionalModules' => [

    ],
    'requiredModules' => [
        'Logs'
    ],
    'requiredPackages' => [
        'required' => '"anhskohbo/no-captcha": "2.*"',
        'required' => '"laravel/socialite": "^2.0"'
    ],

    // Admin

    'adminDisplayName' => 'User Management',
    'adminVisible' => 1,
    'adminDisplayOrder' => 0,
    'adminNavigationLinks' => [
    	'Yeni' => '/create',
    	'Listele' => '/',
        'Yetkiler' => '/accesslevels/',
        'Ekstra Bilgiler' => '/informations/',
        'Ayarlar' => '/settings/',
    ],
    
    // Visitor

    'displayName' => 'Users',
    'displayVisible' => 1,
    'displayOrder' => 0,
    'displayNavigationLinks' => [

    ],


];