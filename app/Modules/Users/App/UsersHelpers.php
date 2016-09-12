<?php
namespace App\Modules\Users\App;
 /**
 *	Users Helper  
 */
use App\Modules\Users\App\Models\User;
use App\Modules\Users\App\Models\UserInformationData;
use App\Modules\Users\App\Models\UserInformationTemplate;

 class UsersHelpers
 {
 	public static function generateRandomString($length = 10) 
 	{
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

	public static function templateTypes()
	{
		$types = [
			1	=>	"Text",
			2	=>	"Gender",
			3	=>	"Date"
 		];

 		return $types;
	}

	public static function getTemplateDatas($slug)
	{
		$template = UserInformationTemplate::where('slug', $slug)->first();
		if($template)
		{
			$data = UserInformationData::where('templateId', $template->id)->get();
			return $data;
		}
		return "[]";

	}
 }