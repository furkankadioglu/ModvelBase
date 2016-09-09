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
use App\Modules\Users\App\Models\User;
use App\Modules\Users\App\Models\UserInformationData;
use App\Modules\Users\App\Models\UserInformationTemplate;
use App\Modules\Users\App\Models\AccessLevel;
use App\Modules\Users\App\Models\UsersModuleSetting;

use App\Modules\Logs\App\Models\Log;



use App\Http\Controllers\AdminTemplateController;
class UsersInformationAdminController extends AdminTemplateController {

	public $headName = "Users Informations Templates";

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$datas = UserInformationTemplate::where('status', 1)->get();
		return view("Users::admin.".$this->theme.".informations.index")
		->with('datas', $datas)
		->with('headName', $this->headName);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$types = ModuleHelpers::templateTypes();
		return view("Users::admin.".$this->theme.".informations.create")
		->with('types', $types)
		->with('headName', $this->headName);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$postCategory = $request->get('postCategory');

		if($postCategory == "create")
		{
			$rules = array(
				'templateName' => 'required|unique:users_informations_templates',
				'type' => 'required',
			);

			$validator = Validator::make($request->all(), $rules);

			if($validator->fails()) 
            {
				return back()->withErrors($validator);
            }

            $templateName = $request->get('templateName');
            $slug = str_slug($templateName);
            $type = $request->get('type');

            $template = new UserInformationTemplate;
            $template->templateName = $templateName;
            $template->slug = $slug;
            $template->type = $type;
            $template->save();

            return redirect("admin/modules/Users/informations");
		}

		return back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  string  $id
	 * @return Response
	 */
	public function show($id)
	{

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data = UserInformationTemplate::find($id);
		$types = ModuleHelpers::templateTypes();
		if($data != null)
		{
			return view("Users::admin.".$this->theme.".informations.edit")
			->with('id', $id)
			->with('data', $data)
			->with('types', $types)
			->with('headName', $this->headName);
		}
		return back();
		
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$rules = array(
			'id'	=>	'required',
			'templateName' => 'required',
			'type' => 'required',
		);

		$validator = Validator::make($request->all(), $rules);

		if($validator->fails()) 
        {
			return back()->withErrors($validator);
        }
        $id = $request->get('id');
        $templateName = $request->get('templateName');
        $slug = str_slug($templateName);
        $type = $request->get('type');

        $template = UserInformationTemplate::find($id);
        $template->templateName = $templateName;
        $template->type = $type;
        $template->slug = $slug;
        $template->save();

        return redirect("admin/modules/Users/informations");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$data = UserInformationTemplate::find($id);
		if($data != null)
		{
			$data->status = 0;
			$data->save();

			Log::create([
            	'category' 		=>	'Users Information Template',
            	'subCategory' 	=>	'Delete',
            	'userId' 		=>	Auth::user()->id,
            	'relDataId' 	=>	$data->id,
            ]);

			return back();
		}
		return back();
	}

}
