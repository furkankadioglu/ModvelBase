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
use Socialite;

// Helpers
use App\Modules\Users\App\UsersHelpers as ModuleHelpers;

// Models
use App\Modules\Users\App\Models\User;
use App\Modules\Users\App\Models\UsersModuleSetting;


use App\Http\Controllers\MainTemplateController;
class UsersAuthController extends MainTemplateController {


       public function getSocialAuth($provider=null)
       {
           if(!config("services.$provider")) abort('404'); 
           return Socialite::driver($provider)->redirect();
       }


       public function getSocialAuthCallback($provider=null)
       {
          $user = Socialite::driver($provider)->user();
          return view("Users::".$this->theme.".register")
          ->with('user', $user);

       }

}
