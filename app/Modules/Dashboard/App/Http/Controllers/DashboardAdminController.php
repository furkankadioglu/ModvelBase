<?php namespace App\Modules\Dashboard\App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Frameworks
use File;
use Auth;
use Validator;
use DB;
use Config;
use LaravelAnalytics;
use Permacon;
// Helpers
use App\Modules\Dashboard\App\DashboardHelpers as ModuleHelpers;

// Models
use App\Modules\Users\App\Models\User;
use App\Modules\Dashboard\App\Models\Dashboard;
use App\Modules\Dashboard\App\Models\DashboardModuleSetting;


use App\Http\Controllers\AdminTemplateController;
class DashboardAdminController extends AdminTemplateController {

	public $headName = "Dashboard";

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//$screenshot = ModuleHelpers::getScreenShot();
		$sevenDays = LaravelAnalytics::getVisitorsAndPageViews(7);
		$mostVisitedPages = LaravelAnalytics::getMostVisitedPages(365, 10);
		$topKeywords = LaravelAnalytics::getTopKeywords(365, 10);
	 	$topReferrers = LaravelAnalytics::getTopReferrers(365, 10);
		$topBrowsers = LaravelAnalytics::getTopBrowsers(365, 10);

		$onlineVisitors = LaravelAnalytics::getActiveUsers();
		$usersCount = User::count();

		return view("Dashboard::admin.".$this->theme.".index")
		->with('headName', $this->headName)
		->with('sevenDays', $sevenDays)
		->with('mostVisitedPages', $mostVisitedPages)
		->with('topReferrers', $topReferrers)
		->with('topBrowsers', $topBrowsers)
		->with('onlineVisitors', $onlineVisitors)
		->with('usersCount', $usersCount)
		//->with('screenshot', $screenshot)
		->with('topKeywords', $topKeywords);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$postCategory = $request->get('postCategory');

		if($postCategory == "generateScreenShot")
		{
			$generate = ModuleHelpers::generateScreenShot();
			return redirect('/admin/modules/Dashboard/');
		}

		return back();
	}



}
