<?php namespace App\Modules\Users\App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Frameworks
use File;
use Auth;
use Validator;
use DB;
use Hash;
use Config;

// Helpers
use App\BaseHelpers;
use App\Modules\Users\App\UsersHelpers as ModuleHelpers;

// Models
use App\Modules\Users\App\Models\AccessLevel;

use App\Modules\Logs\App\Models\Log;

use App\Http\Controllers\AdminTemplateController;
class AccessLevelsAdminController extends AdminTemplateController {

	public $headName = "Access Levels";

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$datas = AccessLevel::orderBy('id', 'desc')->get();
		return view("Users::admin.".$this->theme.".accesslevels.index")
		->with('datas', $datas)
		->with('headName', $this->headName);
	}


	public function create()
	{
		return view("Users::admin.".$this->theme.".accesslevels.create")
		->with('headName', $this->headName);
	}

	public function store(Request $request)
	{
		$postCategory = $request->get('postCategory');

		if($postCategory == "create")
		{
			$rules = array(
				'levelName' => 'required',
				'levelPoint' => 'required',
				'levelRedirect' => 'required',
			);

			$validator = Validator::make($request->all(), $rules);

			if($validator->fails()) 
            {
                return back();
            }

            $levelName = $request->get('levelName');
            $levelPoint = $request->get('levelPoint');
            $levelRedirect = $request->get('levelRedirect');

            $newLevel = AccessLevel::create([
            	'levelName' => $levelName,
            	'levelPoint' => $levelPoint,
            	'levelRedirect' => $levelRedirect
            ]);

			Log::create([
            	'category' 		=>	'AccessLevels',
            	'subCategory' 	=>	'Create',
            	'userId' 		=>	Auth::user()->id,
            	'relDataId' 	=>	$newLevel->id,
            ]);


            return redirect("admin/modules/Users/accesslevels");
		}

		return back();
	}

	public function edit($id)
	{

		$accesslevel = AccessLevel::find($id);
		if($accesslevel != null)
		{
			return view("Users::admin.".$this->theme.".accesslevels.edit")
			->with('id', $id)
			->with('accesslevel', $accesslevel)
			->with('headName', $this->headName);

		}
		return back();
		
	}

	public function update($id, Request $request)
	{
		$rules = array(
			'levelName' => 'required',
			'levelPoint' => 'required|numeric',
			'levelRedirect' => 'required',
		);

		$validator = Validator::make($request->all(), $rules);

		if($validator->fails()) 
	    {
	        return back();
	    }

	    $accesslevel = AccessLevel::find($id);
		if($accesslevel != null)
		{
			$accesslevel->levelName = $request->get('levelName');
			$accesslevel->levelPoint = $request->get('levelPoint');
			$accesslevel->levelRedirect = $request->get('levelRedirect');
			$accesslevel->save();

			Log::create([
            	'category' 		=>	'AccessLevels',
            	'subCategory' 	=>	'Edit',
            	'userId' 		=>	Auth::user()->id,
            	'relDataId' 	=>	$accesslevel->id,
            ]);

            return redirect("admin/modules/Users/accesslevels");

		}
		return back();
		
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$data = AccessLevel::find($id);
		if($data != null)
		{
			Log::create([
            	'category' 		=>	'AccessLevels',
            	'subCategory' 	=>	'Delete',
            	'userId' 		=>	Auth::user()->id,
            	'relDataId' 	=>	$data->id,
            ]);


			$data->delete();
			return view("Users::admin.".$this->theme.".accesslevels.destroy")
			->with('id', $id)
			->with('headName', $this->headName);
		}
		return back();
	}




}
