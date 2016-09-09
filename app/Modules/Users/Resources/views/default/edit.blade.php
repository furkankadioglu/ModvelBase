@extends('masters.main')

@section('styles')
<link href="{{ url('assets/admin/css/fileinput/fileinput.min.css') }}" media="all" rel="stylesheet" type="text/css" />
@endsection

@section('scripts')

<script src="{{ url('assets/admin/js/plugins/fileinput/fileinput.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/admin/js/plugins/fileinput/fileinput_locale_tr.js') }}" type="text/javascript"></script>
<script>
	$("#fileuploader").fileinput({
	     'language': 'tr',
	     'showUpload': false,
	    'allowedFileExtensions' : ['jpg', 'jpeg', 'png','gif'],
	});

	function replaceNew(SHOW, HIDE)
	{
	    $("#" + SHOW).show(1000);
	    $("#" + HIDE).hide(1000);
	}
</script>
@endsection

@section('content')


@if(Session::has('flash_message') && Session::has('flash_message_category'))
	<div class="alert alert-{{ Session::get('flash_message') }}">
	{{ Session::get('flash_message') }}
	</div>
@endif
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="page-header">
    <div class="container">
        <h1 class="page-header__title  display-1">Profile Edit</h1>
    </div>
</div>


<form method="post" action="{{ url('/Users/'.$user->id) }}" class="space20" enctype="multipart/form-data" novalidate>
{{ csrf_field() }}
<input name="_method" type="hidden" value="PUT" />

<div class="col-md-8 col-md-offset-2">
<h3>Base Informations</h3>
	<input type="text" name="username" class="form-control" value="{{ $user->username }}" placeholder="Username"><br>
	<input type="text" name="firstname" class="form-control" value="{{ $user->firstname }}" placeholder="First Name"><br>
	<input type="text" name="lastname" class="form-control" value="{{ $user->lastname }}" placeholder="Last Name"><br>
	<input type="text" name="email" class="form-control" value="{{ $user->email }}" placeholder="email@domain.com"><br>
	<input type="password" name="newpassword" class="form-control" placeholder="New Password"><br>

	 @if(!is_null($user->photo))
    <div id="currentPhoto">
    	<div class="col-md-12">
        	<img src="{{ url('/uploads/photos/75px_'.$user->photo->fileName) }}" class="img-thumbnail" alt="" />
        	 <span class="btn btn-primary" onclick="return replaceNew('uploadPhoto', 'currentPhoto');">Replace</span>
        </div>
        <br>
    </div>
    @endif
    <div @if(!is_null($user->photo)) style="display: none;" id="uploadPhoto" @endif>
    	<input id="fileuploader" type="file" name="photo" class="file">
    </div>

	@if($templates != "[]")
	<br><br><br>
	<h3>Additional Informations</h3>

		@foreach($templates as $t)
    	<label for="material-text2">{{ $t->templateName }}</label>
        <input class="form-control" id="material-text2" name="templates[{{ $t->id }}]" value="{{ $t->getData($user->id)->data or "" }}" type="text">
		@endforeach
	@endif

	<br><br>
	<div class="row">
		<div class="col-md-2 col-md-offset-5 text-center">
		<button type="submit" class="btn btn-primary">Save</button>
		</div>
	</div>
	<br>
	
</div>
</form>


@endsection