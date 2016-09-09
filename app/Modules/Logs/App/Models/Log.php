<?php namespace App\Modules\Logs\App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model {

	//
	protected $table = "logs";
	public $timestamps = true;
	protected $guarded = [];


	public function user()
	{
		return $this->hasOne("App\Modules\Users\App\Models\User", "id", "userId");
	}


}
