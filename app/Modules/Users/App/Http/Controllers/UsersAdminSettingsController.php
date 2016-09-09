<?php namespace App\Modules\Users\App\Http\Controllers;

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
use App\Modules\Users\App\UsersHelpers as ModuleHelpers;

// Models
use App\Modules\Users\App\Models\User;
use App\Modules\Users\App\Models\UsersModuleSetting;

use App\Modules\Logs\App\Models\Log;

use App\Http\Controllers\AdminTemplateController;
class UsersAdminSettingsController extends AdminTemplateController {

	public $headName = "Users Module Settings";


	public function index()
	{
		$datas = UsersModuleSetting::orderBy('id', 'desc')->get();
		return view("Users::admin.".$this->theme.".settings.index")
		->with('datas', $datas)
		->with('headName', $this->headName);
	}

	public function create()
	{
		return view("Users::admin.".$this->theme.".settings.create")
		->with('headName', $this->headName);
	}

	public function store(Request $request)
	{
		$postCategory = $request->get('postCategory');

		if($postCategory == "create")
		{
			$rules = array(
				'displayName' => 'required|max:255',
				'name' => 'required|unique:users_settings|max:255',
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

			$data = UsersModuleSetting::create([
				'displayName' => $settingDisplayName,
				'name' => $settingName,
				'attribute' => $settingAttribute
			]);

			$withCache = BaseHelpers::cacheAddOrUpdate("Users" ,$settingName, "");

            Log::create([
            	'category' 		=>	'Users',
            	'subCategory' 	=>	'Settings - Create',
            	'userId' 		=>	Auth::user()->id,
            	'relDataId' 	=>	$data->id,
            ]);

            return redirect("admin/modules/Users/settings");
		}

		return back();
	}

	public function update(Request $request)
	{
		$settings = UsersModuleSetting::orderBy('id', 'desc')->get();
		foreach($settings as $setting)
		{
			$setting->value = $request->get($setting->name);
			$setting->save();
			$withCache = BaseHelpers::cacheAddOrUpdate("Users", $setting->name, $setting->value);
		}

		Log::create([
	    	'category' 		=>	'Users',
	    	'subCategory' 	=>	'Settings - Update',
	    	'userId' 		=>	Auth::user()->id,
	    	'relDataId' 	=>	0,
	    ]);

        return redirect("admin/modules/Users/settings");
	}

	public function destroy($id)
	{
		$data = UsersModuleSetting::find($id);
		if($data != null)
		{
			Log::create([
            	'category' 		=>	'Users',
            	'subCategory' 	=>	'Settings - Delete',
            	'userId' 		=>	Auth::user()->id,
            	'relDataId' 	=>	$data->id,
            ]);

			$data->delete();
			Cache::pull("UsersModule-".$data->name);
		}
		return back();

		
	}

}
