<?php
namespace App\Modules\Pages\App;
 /**
 *	Pages Helper  
 */
use Cache;
use App\Modules\Pages\App\Models\HomepageData;


 class PagesHelpers
 {
 		public static function valueGet($val)
 		{
 			$data = HomepageData::where('slug', $val)->first();
 			if($data)
 			{
 				return $data;
 			}
 			else
 			{
 				return "";
 			}
 			return $data;
 		}

 		public static function valueCacheGet($val)
 		{
 			$data = Cache::get($val);
 			if($data)
 			{
 				return $data;
 			}
 			else
 			{
 				return $val;
 			}
 			return $data;
 		}
 }