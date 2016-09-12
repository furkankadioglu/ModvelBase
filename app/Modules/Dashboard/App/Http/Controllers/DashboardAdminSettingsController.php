<?php namespace App\Modules\Dashboard\App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Frameworks
use File;
use Auth;
use Validator;
use DB;
use Config;
use Cache;
use Permacon;

// Helpers
use App\BaseHelpers;
use App\Modules\Dashboard\App\DashboardHelpers as ModuleHelpers;

// Models
use App\Modules\Dashboard\App\Models\Dashboard;
use App\Modules\Dashboard\App\Models\DashboardModuleSetting;


use App\Http\Controllers\AdminTemplateController;
class DashboardAdminSettingsController extends AdminTemplateController {

	public $headName = "Dashboard Config Settings";


	public function index()
	{

		$configVariables = ["siteId", "clientId", "serviceEmail", "realTimeCacheLifetimeInSeconds"];
		foreach($configVariables as $cv)
		{
			$datas[$cv] = Permacon::get("laravel-analytics", $cv);
		}
		return view("Dashboard::admin.".$this->theme.".config.index")
		->with('datas', $datas)
		->with('headName', $this->headName);
	}

	public function create()
	{
		return view("Dashboard::admin.".$this->theme.".informations.create")
		->with('headName', $this->headName);
	}

	public function store(Request $request)
	{

	

		$base = $request->get('base');
		$arrays = $request->get('arrays');


		foreach($base as $b => $v)
		{

			Permacon::set("laravel-analytics", $b, $v);
		}


        return redirect("admin/modules/Dashboard/settings");
	}



	public function destroy($id)
	{
		
	}

}
