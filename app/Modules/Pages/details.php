<?php
/*
|--------------------------------------------------------------------------
|
|   Pages Module
|
|--------------------------------------------------------------------------
*/

return [

    // General
    
    'name' => 'Pages',
    'description' => '',
    'creator' => 'Anonymous',
    'category' => 'General',
    'customer' => 'General',
    'icon' => 'fa fa-pencil-square-o',
    'version' => '1.0.0',
    'requiredModules' => [
        'Users',
        'Logs',
    ],
    'requiredPackages' => [
        "flynsarmy/db-blade-compiler" => "2.*"
    ],

    // Admin

    'adminDisplayName' => 'Page Management',
    'adminVisible' => 1,
    'adminDisplayOrder' => 0,
    'adminNavigationLinks' => [
    	'Yeni' => '/create',
    	'Listele' => '/',
        'Ayarlar' => '/settings/',
        'Anasayfa Editoru' => '/homepage/'
    ],
    
    // Visitor

    'displayName' => 'Pages',
    'displayVisible' => 1,
    'displayOrder' => 0,
    'displayNavigationLinks' => [

    ],


];