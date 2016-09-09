<?php namespace App\Modules\Pages\App\Http\Controllers;

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
use App\Modules\Pages\App\PagesHelpers as ModuleHelpers;

// Models
use App\Modules\Pages\App\Models\Page;
use App\Modules\Pages\App\Models\PagesModuleSetting;

use App\Modules\Logs\App\Models\Log;

use App\Http\Controllers\AdminTemplateController;
class PagesAdminSettingsController extends AdminTemplateController {

	public $headName = "Pages Module Settings";


	public function index()
	{
		$datas = PagesModuleSetting::orderBy('id', 'desc')->get();
		return view("Pages::admin.".$this->theme.".settings.index")
		->with('datas', $datas)
		->with('headName', $this->headName);
	}

	public function create()
	{
		return view("Pages::admin.".$this->theme.".settings.create")
		->with('headName', $this->headName);
	}

	public function store(Request $request)
	{
		$postCategory = $request->get('postCategory');

		if($postCategory == "create")
		{
			$rules = array(
				'displayName' => 'required|max:255',
				'name' => 'required|unique:pages_settings|max:255',
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

			$data = PagesModuleSetting::create([
				'displayName' => $settingDisplayName,
				'name' => $settingName,
				'attribute' => $settingAttribute
			]);

			Log::create([
            	'category' 		=>	'Pages',
            	'subCategory' 	=>	'Settings - Create',
            	'userId' 		=>	Auth::user()->id,
            	'relDataId' 	=>	$data->id,
            ]);

			$withCache = BaseHelpers::cacheAddOrUpdate("Pages" ,$settingName, "");

            return redirect("admin/modules/Pages/settings");
		}

		return back();
	}

	public function update(Request $request)
	{
		$settings = PagesModuleSetting::orderBy('id', 'desc')->get();
		foreach($settings as $setting)
		{
			$setting->value = $request->get($setting->name);
			$setting->save();
			$withCache = BaseHelpers::cacheAddOrUpdate("Pages", $setting->name, $setting->value);
		}

		Log::create([
            	'category' 		=>	'Pages',
            	'subCategory' 	=>	'Settings - Update',
            	'userId' 		=>	Auth::user()->id,
            	'relDataId' 	=>	0,
            ]);

           return redirect("admin/modules/Pages/settings");
	}

	public function destroy($id)
	{
		$data = PagesModuleSetting::find($id);
		if($data != null)
		{
			Log::create([
            	'category' 		=>	'Pages',
            	'subCategory' 	=>	'Settings - Delete',
            	'userId' 		=>	Auth::user()->id,
            	'relDataId' 	=>	$data->id,
            ]);

			$data->delete();
			Cache::pull("PagesModule-".$data->name);
		}
		return back();

		
	}

}
