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

// Helpers
use App\Modules\Logs\App\LogsHelpers as ModuleHelpers;

// Models
use App\Modules\Logs\App\Models\Log;
use App\Modules\Logs\App\Models\LogsModuleSetting;


use App\Http\Controllers\AdminTemplateController;
class LogsAdminController extends AdminTemplateController {

	public $headName = "Logs";

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$datas = Log::orderBy('id', 'desc')->paginate(100);
		return view("Logs::admin.".$this->theme.".index")
		->with('datas', $datas)
		->with('headName', $this->headName);
	}

	public function store(Request $request)
	{
		$searchParams = $request->get('search');

		$realSearchParams = [];

		foreach($searchParams as  $key => $search)
		{
			if($search != null)
			{
				$realSearchParams[$key] = $search;
			}
		}

		Log::create([
        	'category' 		=>	'Logs',
        	'subCategory' 	=>	'Search',
        	'userId' 		=>	Auth::user()->id,
        	'relDataId' 	=>	0,
        ]);

		$datas = Log::orderBy('id', 'desc')->where($realSearchParams)->paginate(100);
		return view("Logs::admin.".$this->theme.".index")
		->with('datas', $datas)
		->with('headName', $this->headName);
	}


}
