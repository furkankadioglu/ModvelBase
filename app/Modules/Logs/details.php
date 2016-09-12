<?php
/*
|--------------------------------------------------------------------------
|
|   Logs Module
|
|--------------------------------------------------------------------------
*/

return [

    // General
    
    'name' => 'Logs',
    'description' => '',
    'creator' => 'Anonymous',
    'category' => 'General',
    'customer' => 'General',
    'icon' => 'fa fa-history',
    'version' => '1.0.0',
    'optionalModules' => [
        'Users'
    ],
    'requiredModules' => [

    ],
    'requiredPackages' => [
    
    ],

    // Admin

    'adminDisplayName' => 'Log Management',
    'adminVisible' => 1,
    'adminDisplayOrder' => 0,
    'adminNavigationLinks' => [
    	'Listele' => '/',
        'Ayarlar' => '/settings/'
    ],
    
    // Visitor

    'displayName' => 'Logs',
    'displayVisible' => 0,
    'displayOrder' => 0,
    'displayNavigationLinks' => [

    ],


];