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

// Helpers
use App\BaseHelpers;
use App\Modules\Pages\App\PagesHelpers as ModuleHelpers;

// Models
use App\Modules\Pages\App\Models\Page;
use App\Modules\Pages\App\Models\PagesModuleSetting;


use App\Modules\Logs\App\Models\Log;

use App\Http\Controllers\AdminTemplateController;
class PagesAdminController extends AdminTemplateController {

	public $headName = "Pages";

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$datas = Page::orderBy('id', 'desc')->where('status', 1)->get();
		return view("Pages::admin.".$this->theme.".index")
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
		$datas = Page::orderBy('id', 'desc')->get();
		return view("Pages::admin.".$this->theme.".create")
		->with('headName', $this->headName)
		->with('pages', $datas);
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
				'title' => 'required|unique:pages',
				'content' => 'required'
			);

			$validator = Validator::make($request->all(), $rules);

			if($validator->fails()) 
            {
                return back()->withErrors($validator);
            }

            $title = $request->get('title');
            $slug = str_slug($title);
            $content = $request->get('content');
            $description = $request->get('description');
            $masterPageId = ($request->get('masterPageId') != 0) ? $request->get('masterPageId') : 0;
            $showMenu = ($request->get('showMenu') == "on") ? 1 : 0;
            $userId = Auth::user()->id;

            $data = Page::create([
            	'title' => $title,
            	'slug' => $slug,
            	'content' => $content,
            	'description' => $description,
            	'masterPageId' => $masterPageId,
            	'showMenu' => $showMenu,
            	'userId' => $userId
            ]);

			if($request->hasFile('photo')) 
	        {
	        	$photo = $request->file('photo');
	        	$uploadedPhoto = BaseHelpers::addPhoto($photo, $data->id, "Page");
	            $photoId = $uploadedPhoto->id;
	            $data->photoId = $photoId;
	            $data->save();
	        }

	        Log::create([
            	'category' 		=>	'Pages',
            	'subCategory' 	=>	'Create',
            	'userId' 		=>	Auth::user()->id,
            	'relDataId' 	=>	$data->id,
            ]);

            return redirect("admin/modules/Pages");
		}
		elseif($postCategory == "inlinePhotoUpload")
		{
			  $validator = Validator::make($request->all(), 
            [
                'upload' => 'image|required',
            ]);

            if($validator->fails()) 
            {
                return back();
            }

            $photo = $request->file('upload');
            $uploadedPhoto = BaseHelpers::addPhoto($photo, 0, "PageInlinePhoto");

            Log::create([
            	'category' 		=>	'Pages',
            	'subCategory' 	=>	'Inline Photo',
            	'userId' 		=>	Auth::user()->id,
            	'relDataId' 	=>	$uploadedPhoto->id,
            ]);

            return '<script type="text/javascript">
           var CKEditorFuncNum = 1;
           window.parent.CKEDITOR.tools.callFunction( CKEditorFuncNum, \''.url('/').'/uploads/photos/'.$uploadedPhoto->fileName.'\' );
            </script>';
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
		$slug = $id;
		$data = Page::where('slug', $slug)->first();
		if($data != null)
		{
			return view("Pages::admin.".$this->theme.".show")
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
		$data = Page::find($id);
		if($data != null)
		{
			$datas = Page::orderBy('id', 'desc')->get();

			return view("Pages::admin.".$this->theme.".edit")
			->with('id', $id)
			->with('data', $data)
			->with('pages', $datas)
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
				'title' => 'required',
				'content' => 'required'
			);

		$validator = Validator::make($request->all(), $rules);

		if($validator->fails()) 
	    {
	        return back()->withErrors($validator);
	    }

    	$title = $request->get('title');
        $slug = str_slug($title);
        $content = $request->get('content');
        $description = $request->get('description');
        $masterPageId = ($request->get('masterPageId') != 0) ? $request->get('masterPageId') : 0;
        $showMenu = ($request->get('showMenu') == "on") ? 1 : 0;
        $userId = Auth::user()->id;

	    $data = Page::find($id);
        $titleUnique = Page::where('title', $title)->first();

	    if($titleUnique != null && $titleUnique->id != $data->id)
        {
        	return back();
        }

	    if($data != null)
	    {
	    	$data->title = $title;
	    	$data->slug = $slug;
	    	$data->content = $content;
	    	$data->description = $description;
	    	$data->masterPageId = $masterPageId;
	    	$data->userId = $userId;
	    	$data->showMenu = $showMenu;

	    	if($request->hasFile('photo')) 
	        {
	        	$photo = $request->file('photo');
	        	$uploadedPhoto = BaseHelpers::addPhoto($photo, $data->id, "Page");
	            $photoId = $uploadedPhoto->id;
	            $data->photoId = $photoId;
	        }

	        Log::create([
            	'category' 		=>	'Pages',
            	'subCategory' 	=>	'Edit',
            	'userId' 		=>	Auth::user()->id,
            	'relDataId' 	=>	$data->id,
            ]);

	    	$data->save();
            return redirect("admin/modules/Pages");
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
		$data = Page::find($id);
		if($data != null)
		{
			$data->status = 0;
			$data->save();

			Log::create([
            	'category' 		=>	'Pages',
            	'subCategory' 	=>	'Delete',
            	'userId' 		=>	Auth::user()->id,
            	'relDataId' 	=>	$data->id,
            ]);

			return view("Pages::admin.".$this->theme.".destroy")
			->with('id', $id)
			->with('headName', $this->headName);
		}
		return back();

		
	}

}
