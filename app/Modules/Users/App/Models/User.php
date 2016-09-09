<?php namespace App\Modules\Users\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

	//
	protected $table = "users";
	public $timestamps = true;
	protected $guarded = [];

	public function isAdmin()
	{
		$accessLevel = $this->attributes["accessLevel"];

		if($accessLevel == 5)
		{
			return true;
		}
		return false;
	}

	public function accessLevelDetails()
	{
		return $this->hasOne("App\Modules\Users\App\Models\AccessLevel", "levelPoint", "accessLevel");
	}

	public function photo()
	{
		return $this->hasOne("App\Models\Photo", "id", "photoId");
	}

}
