<?php namespace App\Modules\Logs\App\Http\Controllers;

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

// Helpers
use App\BaseHelpers;
use App\Modules\Logs\App\LogsHelpers as ModuleHelpers;

// Models
use App\Modules\Logs\App\Models\Log;
use App\Modules\Logs\App\Models\LogsModuleSetting;


use App\Http\Controllers\AdminTemplateController;
class LogsAdminSettingsController extends AdminTemplateController {

	public $headName = "Logs Module Settings";


	public function index()
	{
		$datas = LogsModuleSetting::orderBy('id', 'desc')->get();
		return view("Logs::admin.".$this->theme.".settings.index")
		->with('datas', $datas)
		->with('headName', $this->headName);
	}

	public function create()
	{
		return view("Logs::admin.".$this->theme.".settings.create")
		->with('headName', $this->headName);
	}

	public function store(Request $request)
	{
		$postCategory = $request->get('postCategory');

		if($postCategory == "create")
		{
			$rules = array(
				'displayName' => 'required|max:255',
				'name' => 'required|unique:Logs_settings|max:255',
				'attribute' => 'required|max:255'
			);

			$validator = Validator::make($request->all(), $rules);

			if($validator->fails()) 
            {
				return back()->withErrors($validator);
            }

            $settingDisplayName = $request->get('displayName');
            $settingName = str_slug($request->get('name'));
            $settingAttribute = $request->get('attribute');

			$data = LogsModuleSetting::create([
				'displayName' => $settingDisplayName,
				'name' => $settingName,
				'attribute' => $settingAttribute
			]);

			$withCache = BaseHelpers::cacheAddOrUpdate("Logs" ,$settingName, "");

            return redirect("admin/modules/Logs/settings");
		}

		return back();
	}

	public function update(Request $request)
	{
		$settings = LogsModuleSetting::orderBy('id', 'desc')->get();
		foreach($settings as $setting)
		{
			$setting->value = $request->get($setting->name);
			$setting->save();
			$withCache = BaseHelpers::cacheAddOrUpdate("Logs", $setting->name, $setting->value);
		}
           return redirect("admin/modules/Logs/settings");
	}

	public function destroy($id)
	{
		$data = LogsModuleSetting::find($id);
		if($data != null)
		{
			$data->delete();
			Cache::pull("LogsModule-".$data->name);
		}
		return back();

		
	}

}
