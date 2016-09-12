<?php
namespace App\Modules\Dashboard\App;
 /**
 *	Dashboard Helper  
 */
 use Cache;
 use Config;

use Screenshot;
 class DashboardHelpers
 {
 		public static function getScreenShot()
 		{
 			if(Cache::has("screenshot"))
 			{
				return 'websitescreenshot.jpg';
 			}
 			else
 			{
				return self::generateScreenShot();
 			} 			
 		}

 		public static function generateScreenShot()
 		{
 	
 				$path       = public_path('/');
				$screenshot = Screenshot::capture(url('/'));
				$localPath  = $screenshot->store($path, 'websitescreenshot.jpg');
				$cacheModules = Cache::put('screenshot', '1', Config::get('modulemanagement.checkTime'));

				return 'websitescreenshot.jpg';		
 		}
 }