<?php namespace App\Modules\Pages\App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model {

	//
	protected $table = "pages";
	public $timestamps = true;
	protected $guarded = [];

	public function user()
	{
		return $this->hasOne("App\Modules\Users\App\Models\User", "id", "userId");
	}

	public function photo()
	{
		return $this->hasOne("App\Models\Photo", "id", "photoId");
	}

	public function subPages()
	{
		return $this->hasMany("App\Modules\Pages\App\Models\Page", "masterPageId", "id");
	}

}
