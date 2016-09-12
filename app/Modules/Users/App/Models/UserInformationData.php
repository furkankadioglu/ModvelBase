<?php namespace App\Modules\Users\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserInformationData extends Authenticatable {

	//
	protected $table = "users_informations_datas";
	public $timestamps = true;
	protected $guarded = [];

}
