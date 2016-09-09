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
use App\Modules\Pages\App\Models\StaticData;
use App\Modules\Pages\App\Models\PagesModuleSetting;


use App\Modules\Logs\App\Models\Log;

use App\Http\Controllers\AdminTemplateController;
class PagesHomepageAdminController extends AdminTemplateController {

	public $headName = "Homepage Content";

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//$homepage = \File::get(app_path().'/modules/Pages/Resources/views/default/homepage.blade.php');
        $homepage = StaticData::where('type', 'Homepage')->first();
        if($homepage)
        	$homepage = $homepage->content;
        else
        	return "";

		$doIt = preg_match_all('#\[-(.*?)\-]#', $homepage, $match);
		$datas = [];
		if($match)
		{
			$i = 0;
			foreach($match[0] as $m)
			{
				$data = StaticData::where('slug', $match[1][$i])->first();
				if(!$data)
				{
					$datas[$i] = "";
				}
				$datas[$i] = $data;
				$i++;
			}
		}

		return view("Pages::admin.".$this->theme.".homepage")
		->with('headName', $this->headName)
		->with('homepage', $homepage)
		->with('match', $match)
		->with('datas', $datas);
	}



	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$postCategory = $request->get('postCategory');

		if($postCategory == "updateHomepage")
		{
			$rules = array(
				'content' => 'required'
			);

			$validator = Validator::make($request->all(), $rules);


			if($validator->fails()) 
            {
                return back()->withErrors($validator);
            }
            $content = $request->get('content');

            $oldHomepage = StaticData::where('type', 'Homepage')->first();
            if($oldHomepage)
            {
            	$oldHomepage->delete();
            }

            $StaticData = new StaticData;
    		$StaticData->type = "Homepage";
    		$StaticData->slug = "homepage";
    		$StaticData->content = $content;
    		$StaticData->save();

    		// File type save
           	// $destinationPath = app_path();
           	// $do = File::put(app_path().'/modules/Pages/Resources/views/default/homepage.blade.php', $content);

            return redirect('/admin/modules/Pages/homepage');
           
		}

		if($postCategory == "updateContents")
		{
			$rules = array(
				'values' => 'required'
			);

			$validator = Validator::make($request->all(), $rules);


			if($validator->fails()) 
            {
                return back()->withErrors($validator);
            }

            /*
            Delete Old Data
            */
            $oldDatas = StaticData::where('type', 'Contents')->get();

            foreach($oldDatas as $olddata)
            {
				if(Cache::has($olddata->slug))
				{
					Cache::pull($olddata->slug);
				}

            	$olddata->delete();
            }
            /***/
            
            $values = $request->get('values');
            if($values != "[]")
            {
            	foreach($values as $k => $v)
            	{
            		$StaticData = new StaticData;
            		$StaticData->type = "Contents";
            		$StaticData->slug = $k;
            		$StaticData->content = $v;
            		$StaticData->save();
					Cache::forever($k, $v);

            	}
            }
            return redirect('/admin/modules/Pages/homepage');

		}
	}




}
