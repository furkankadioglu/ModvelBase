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
use View;
use DbView;
// Helpers

use App\Modules\Pages\App\PagesHelpers as ModuleHelpers;

// Models
use App\Modules\Pages\App\Models\StaticData;
use App\Modules\Pages\App\Models\Page;
use App\Modules\Pages\App\Models\PagesModuleSetting;


use App\Modules\Posts\App\Models\Post;
use App\Modules\Posts\App\Models\PostCategory;
use App\Modules\Posts\App\Models\PostCategoryRel;
use App\Modules\Posts\App\Models\PostsModuleSetting;


use App\Http\Controllers\MainTemplateController;
class PagesController extends MainTemplateController {

	public function index()
	{
		$datas = Page::orderBy('id', 'desc')->get();
		return view("Pages::".$this->theme.".index")
		->with('datas', $datas);
	}

	public function show($id)
	{
		$slug = $id;
		$data = Page::where('slug', $slug)->first();
		if($data != null)
		{
			return view("Pages::".$this->theme.".show")
			->with('id', $id)
			->with('data', $data);	
		}
		return back();
	}

	public function homepage()
	{
		$homepage = StaticData::where('type', 'Homepage')->first();

		if($homepage)
		{
			$matchIt = preg_match_all('#\[-(.*?)\-]#', $homepage, $match);

			$datas = [];
			$degistirilecekler = [];
			$degistirilenler = [];
			$i = 0;
			// match[1] => asıl adları

			foreach($match[1] as $m)
			{
				$degistirilecek = $match[0][$i];
				$aranacak = $m;
				$data = StaticData::where('type', 'Contents')->where('slug', $m)->first();
				if($data)
				{
					$homepage->content = str_replace($degistirilecek, $data->content, $homepage->content);
				}

				$i++;
			}
			return DbView::make($homepage)
			->render();

		}
		else
		{
			return "404";
		}


	}

}
