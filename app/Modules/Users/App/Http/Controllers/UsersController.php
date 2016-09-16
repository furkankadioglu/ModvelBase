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
use Hash;
use Cache;
use Session;
use Mail;

// Helpers
use App\BaseHelpers;
use App\Modules\Users\App\UsersHelpers as ModuleHelpers;
use App\Modules\Modvel\App\ModvelHelpers;

// Models
use App\Modules\Users\App\Models\User;
use App\Modules\Users\App\Models\UsersModuleSetting;
use App\Modules\Users\App\Models\UserInformationData;
use App\Modules\Users\App\Models\UserInformationTemplate;

use App\Modules\Logs\App\Models\Log;


use App\Http\Controllers\MainTemplateController;
class UsersController extends MainTemplateController {

	public function index()
	{
		$user = Auth::user();
		$datas = User::orderBy('id', 'desc')->get();
		return view("Users::".$this->theme.".index")
		->with('user', $user)
		->with('datas', $datas);
	}

	public function show($id)
	{
		$user = Auth::user();
		$data = User::where('slug', $id)->first();
		if($data != null)
		{
			return view("Users::".$this->theme.".show")
			->with('id', $id)
		    ->with('user', $user)
			->with('data', $data);	
		}
		return back();
	}

	public function logout()
	{
		$user = Auth::user();
		Log::create([
        	'category' 		=>	'Users',
        	'subCategory' 	=>	'Logout',
        	'userId' 		=>	$user->id,
        	'relDataId' 	=>	0,
    	]);

    	Auth::logout();
		return redirect("/");
	}

	public function edit($id)
	{
		$user = Auth::user();
		$templates = UserInformationTemplate::where('status', 1)->get();

		if($id == $user->id)
		{
			return view("Users::".$this->theme.".edit")
			->with('templates', $templates)
			->with('user', $user);
		}
		return back();
	}

	public function store(Request $request)
	{
		$user = Auth::user();
		$postCategory = $request->get('postCategory');
	}

	public function destroy($id)
	{
	}

	public function create()
	{
		return back();
	}

	public function update($id, Request $request)
	{
		if($id == Auth::user()->id)
		{
			$rules = array(
				'username' => 'required',
				'firstname' => 'required',
				'lastname' => 'required',
				'email' => 'required',
				'photo' => 'image|mimes:jpg,jpeg,bmp,png'
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
	        $password = $request->get('password');

	        $data = User::find($id);
		    if($data != null)
		    {
		    	$data->username = $username;
		    	$data->slug = $slug;
		    	$data->firstname = $firstname;
		    	$data->lastname = $lastname;
		    	$data->email = $email;
		    	

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

                $templates = $request->get('templates');

                // Delete datas
		        foreach((array)$templates as $k => $v)
		        {
		        	$d = UserInformationData::where('templateId', $k)->where('userId', $data->id)->first();
		        	if($d)
		        	{
		        		$d->delete();
		        	}
		        }

		        foreach((array)$templates as $k => $v)
		        {
		        	$d = new UserInformationData;
		        	$d->templateId = $k;
		        	$d->data = $v;
		        	$d->userId = $data->id;
		        	$d->save();
		        }

		        $data->save();

		        Log::create([
	            	'category' 		=>	'Users',
	            	'subCategory' 	=>	'Self Update',
	            	'userId' 		=>	Auth::user()->id,
	            	'relDataId' 	=>	$data->id,
            	]);

	            return redirect("/Users");
		    }
		}
	    return back();
	}

	/* 
	- - - - - - - - - - - - -
	-	Forgot Password
	- - - - - - - - - - - - -
	*/

	public function forgotPassword()
	{
		return view("Users::".$this->theme.".forgotpassword");
	}

	public function forgotPasswordStore(Request $request)
	{
		$postCategory = $request->get('postCategory');
		if($postCategory == "forgotpassword")
		{
			$rules = array(
				'g-recaptcha-response' => 'required|captcha',
				'email' => 'required',
			);

			$validator = Validator::make($request->all(), $rules);

			if($validator->fails()) 
            {
                return back()->withErrors($validator);
            }

            $passwordToken = ModuleHelpers::generateRandomString(30);

            $findUser = User::where('email', $request->get('email'))->first();
            if($findUser != null)
            {
            	$findUser->password_token = $passwordToken;
            	$findUser->save();
            	$request->session()->flash('flash_message', 'We have sent you an e-mail! Check your email!');

            	$mailData = [
            	'title'		=> 'Forgot Password',
            	'content'	=> '<p> Please click the following link to reset your password: </p> <br/> <a href="'.url('/').'/Users/resetpassword/'.$passwordToken.'">Click here and reset your password.</a>',
	            'brandname' => ModvelHelpers::getInformation('brand-name')
	            ];
	 
	            Mail::send("masters.mail", $mailData, function($message) use ($findUser)
	            {
	                $amail = $findUser->email;
	                $message->to($amail, ModvelHelpers::getInformation('brand-name'))->subject('Forgot Password');
	            });

	            Log::create([
	            	'category' 		=>	'Users',
	            	'subCategory' 	=>	'Forgot Password',
	            	'userId' 		=>	0,
	            	'relDataId' 	=>	$findUser->id,
            	]);

            }
            else
            {
            	$request->session()->flash('flash_message', 'Incorrect email.');
            }
            
            return redirect("/");

		}
	}

	/* 
	- - - - - - - - - - - - -
	-	Reset Password
	- - - - - - - - - - - - -
	*/

	public function resetPassword($token)
	{
		$findUser = User::where('password_token', $token)->first();

		if($findUser != null)
		{
			return view("Users::".$this->theme.".resetpassword")
			->with('token', $token)
			->with('user', $findUser);
		}
		return redirect('/');
	}

	public function resetPasswordStore(Request $request)
	{
		$postCategory = $request->get('postCategory');
		if($postCategory == "resetpassword")
		{
			$rules = array(
				'password1' => 'required',
				'password2' => 'required',
				'userId' => 'required',
				'resetToken' => 'required'
			);

			$validator = Validator::make($request->all(), $rules);

			if($validator->fails()) 
		    {
		        return back()->withErrors($validator);
		    }

		    $password1 = $request->get('password1');
		    $password2 = $request->get('password2');
		    $userId = $request->get('userId');
		    $token = $request->get('resetToken');
		    $user = User::find($request->get('userId'));

		    if($password1 == $password2)
		    {
		    	$user->password = Hash::make($password1);
		    	$user->password_token = ModuleHelpers::generateRandomString(15);
		    	$user->save();

		    	$request->session()->flash('flash_message', 'Your password successfully changed!');

		    	return view("Users::".$this->theme.".login");

		    	Log::create([
	            	'category' 		=>	'Users',
	            	'subCategory' 	=>	'Reset Password',
	            	'userId' 		=>	0,
	            	'relDataId' 	=>	$user->id,
            	]);
		    }
		    else
		    {
	    		$request->session()->flash('flash_message', 'Please check your passwords.');

		    	return view("Users::".$this->theme.".resetpassword")
				->with('token', $token)
				->with('user', $user);
		    }
		}

		return redirect('/');
	}

	/* 
	- - - - - - - - - - - - - 
	-		Register
	- - - - - - - - - - - - -
	*/

	public function register()
	{
		return view("Users::".$this->theme.".register");
	}

	public function registerStore(Request $request)
	{
		$postCategory = $request->get('postCategory');
		if($postCategory == "register")
		{
			$rules = array(
				'g-recaptcha-response' => 'required|captcha',
				'username' => 'required|unique:users',
				'password' => 'required',
				'firstname' => 'required',
				'lastname' => 'required',
				'email' => 'required|unique:users',
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
			
			$newUser = User::create([
            	'username' => $username,
            	'slug'	=>	$slug,
            	'firstname' => $firstname,
            	'lastname' => $lastname,
            	'password' => Hash::make($password),
            	'email' => $email,
            	'accesslevel' => 1
            ]);

            Log::create([
            	'category' 		=>	'Users',
            	'subCategory' 	=>	'Register',
            	'userId' 		=>	$newUser->id,
            	'relDataId' 	=>	$newUser->id,
        	]);

            return redirect("/Users/login");
		}
	}

	/* 
	- - - - - - - - - - - - -
	-	Login
	- - - - - - - - - - - - -
	*/

	public function login()
	{
		return view("Users::".$this->theme.".login");
	}

	public function loginStore(Request $request)
	{
		$postCategory = $request->get('postCategory');
		if($postCategory == "login")
		{
			$rules = array(
				'email' => 'required',
				'password' => 'required',
			);

			$validator = Validator::make($request->all(), $rules);

			if($validator->fails()) 
            {
                return back()->withErrors($validator);
            }

            $email = $request->get('email');
            $password = $request->get('password');

            if (Auth::attempt(['email' => $email, 'password' => $password]))
            {
            	Log::create([
	            	'category' 		=>	'Users',
	            	'subCategory' 	=>	'Login',
	            	'userId' 		=>	Auth::user()->id,
	            	'relDataId' 	=>	Auth::user()->id,
	        	]);
	        	if(isset(Auth::user()->accessLevelDetails->levelRedirect))
	        	{
            		return redirect(Auth::user()->accessLevelDetails->levelRedirect);
	        	}
	        	else
	        	{
	        		return redirect('/');
	        	}
            }
            else
            {
            	Log::create([
	            	'category' 		=>	'Users',
	            	'subCategory' 	=>	'Login Failed',
	            	'userId' 		=>	0,
	            	'relDataId' 	=>	0,
	        	]);

		    	$request->session()->flash('flash_message_category', 'danger');
		    	$request->session()->flash('flash_message', 'Your password or email is incorrect.');
            	return back();
            }
		}
	}


}
