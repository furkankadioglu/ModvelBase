<?php namespace App\Modules\Users\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AccessLevel extends Model {

	//
	protected $table = "users_accesslevels";
	public $timestamps = false;
	protected $guarded = [];

}
