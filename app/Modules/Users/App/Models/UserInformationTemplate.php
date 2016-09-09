<?php namespace App\Modules\Users\App\Models;

use App\Modules\Users\App\UsersHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserInformationTemplate extends Authenticatable {

	//
	protected $table = "users_informations_templates";
	public $timestamps = true;
	protected $guarded = [];


	public function getType($id)
	{
		$types = UsersHelpers::templateTypes();
		return $types[$id];
	}

	public function getData($userId)
	{
		return $this->hasOne("App\Modules\Users\App\Models\UserInformationData", "templateId", "id")->where('userId', $userId)->first();
	}


}
