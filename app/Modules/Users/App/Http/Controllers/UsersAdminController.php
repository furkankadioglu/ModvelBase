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
use App\Modules\Users\App\Models\AccessLevel;
use App\Modules\Users\App\Models\UsersModuleSetting;
use App\Modules\Users\App\Models\UserInformationData;
use App\Modules\Users\App\Models\UserInformationTemplate;
use App\Modules\Logs\App\Models\Log;



use App\Http\Controllers\AdminTemplateController;
class UsersAdminController extends AdminTemplateController {

	public $headName = "Users";

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$datas = User::where('status', 1)->orderBy('id', 'desc')->get(["id", "firstname", "lastname", "username", "email", "status"]);
		return view("Users::admin.".$this->theme.".index")
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
		$accesslevels = AccessLevel::orderBy('levelPoint', 'desc')->get();
		$templates = UserInformationTemplate::where('status', 1)->get();
		return view("Users::admin.".$this->theme.".create")
		->with('accesslevels', $accesslevels)
		->with('headName', $this->headName)
		->with('templates', $templates);
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
				'username' => 'required|unique:users',
				'password' => 'required',
				'firstname' => 'required',
				'lastname' => 'required',
				'accesslevel' => 'required',
				'email' => 'required|unique:users',
				'photo' => 'mimes:jpeg,jpg,bmp,png'
			);

			$validator = Validator::make($request->all(), $rules);

			if($validator->fails()) 
            {
				return back()->withErrors($validator);
            }

            $username = $request->get('username');
            $slug = str_slug($username);
            $firstname = $request->get('firstname');
            $lastname = $request->get('lastname');
            $password = $request->get('password');
            $email = $request->get('email');
            $accesslevel = $request->get('accesslevel');

            $newUser = User::create([
            	'username' => $username,
            	'slug'	=>	$slug,
            	'firstname' => $firstname,
            	'lastname' => $lastname,
            	'password' => Hash::make($password),
            	'email' => $email,
            	'accesslevel' => $accesslevel
            ]);

            if ($request->hasFile('photo')) 
            {
            	$photo = $request->file('photo');
            	$uploadedPhoto = BaseHelpers::addPhoto($photo, $newUser->id, "User");
	            $photoId = $uploadedPhoto->id;
	            $newUser->photoId = $photoId;
            }
            $newUser->save();

            $templates = $request->get('templates');
  			// Add datas
	        foreach($templates as $k => $v)
	        {
	        	$d = new UserInformationData;
	        	$d->templateId = $k;
	        	$d->data = $v;
	        	$d->userId = $newUser->id;
	        	$d->save();
	        }


            Log::create([
            	'category' 		=>	'Users',
            	'subCategory' 	=>	'Create',
            	'userId' 	=>	Auth::user()->id,
            	'relDataId' 	=>	$newUser->id,
            ]);

            return redirect("admin/modules/Users");
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
		$data = User::find($id);
		if($data != null)
		{
			return view("Users::admin.".$this->theme.".show")
			->with('id', $id)
			->with('data', $data)
			->with('headName', $this->headName);
		}
		return back();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data = User::find($id);
		$accesslevels = AccessLevel::orderBy('levelPoint', 'desc')->get();
		$templates = UserInformationTemplate::where('status', 1)->get();
		if($data != null)
		{
			return view("Users::admin.".$this->theme.".edit")
			->with('id', $id)
			->with('data', $data)
			->with('templates', $templates)
			->with('accesslevels', $accesslevels)
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
			'username' => 'required',
			'firstname' => 'required',
			'lastname' => 'required',
			'accesslevel' => 'required',
			'email' => 'required',
			'photo' => 'mimes:jpeg,jpg,bmp,png'
		);

		$validator = Validator::make($request->all(), $rules);

		if($validator->fails()) 
	    {
			return back()->withErrors($validator);
	    }

     	$username = $request->get('username');
        $slug = str_slug($username);
        $firstname = $request->get('firstname');
        $lastname = $request->get('lastname');
        $email = $request->get('email');
        $accesslevel = $request->get('accesslevel');
        $password = $request->get('password');

        


        $data = User::find($id);
	    if($data != null)
	    {
	    	$data->username = $username;
	    	$data->slug = $slug;
	    	$data->firstname = $firstname;
	    	$data->lastname = $lastname;
	    	$data->email = $email;
	    	$data->accessLevel = $accesslevel;
	    	

	        if($request->has('password'))
	        {
	        	$data->password = Hash::make($password);
	        }

			if($request->hasFile('photo')) 
	        {
	        	$photo = $request->file('photo');
	        	$uploadedPhoto = BaseHelpers::addPhoto($photo, $data->id, "User");
	            $photoId = $uploadedPhoto->id;
	            $data->photoId = $photoId;
	        }

	        $data->save();


	        $templates = $request->get('templates');

	         // Delete datas
	        foreach($templates as $k => $v)
	        {
	        	$d = UserInformationData::where('templateId', $k)->where('userId', $data->id)->first();
	        	if($d)
	        	{
	        		$d->delete();
	        	}
	        }

	        // Add datas
	        foreach($templates as $k => $v)
	        {
	        	$d = new UserInformationData;
	        	$d->templateId = $k;
	        	$d->data = $v;
	        	$d->userId = $id;
	        	$d->save();
	        }

	        Log::create([
            	'category' 		=>	'Users',
            	'subCategory' 	=>	'Edit',
            	'userId' 	=>	Auth::user()->id,
            	'relDataId' 	=>	$data->id,
            ]);

            return redirect("admin/modules/Users");
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
		$data = User::find($id);
		if($data != null)
		{
			$data->status = 0;
			$data->save();

			Log::create([
            	'category' 		=>	'Users',
            	'subCategory' 	=>	'Delete',
            	'userId' 		=>	Auth::user()->id,
            	'relDataId' 	=>	$data->id,
            ]);

			return view("Users::admin.".$this->theme.".destroy")
			->with('id', $id)
			->with('headName', $this->headName);
		}
		return back();
	}

}
