@extends('masters.admin')

@section('breadcrumb')
{{ $headName }}
@endsection

@section('styles')
@endsection

@section('scripts')
<script>
	$("#fileuploader").fileinput({
	     'language': 'tr',
	     'showUpload': false,
	    'allowedFileExtensions' : ['jpg', 'png','gif'],
	});

	function replaceNew(SHOW, HIDE)
	{
	    $("#" + SHOW).show(1000);
	    $("#" + HIDE).hide(1000);
	}
</script>
@endsection


@section('content')
<form action="{{ url('/admin/modules/Users/'.$data->id) }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
<input type="hidden" name="postCategory" value="edit">
<input name="_method" type="hidden" value="PUT" />
<div class="block block-bordered">
    <div class="block-header bg-gray-lighter">
   	 	<ul class="block-options">
           @include('Users::admin.navigation')
        </ul>
        <h3 class="block-title"><i class="fa fa-pencil"></i> {{ $headName }} EDIT</h3>
    </div>
    <div class="block-content push-10-t form-horizontal">
 
            <div class="row push-10-t">
            <div class="col-md-8 col-md-offset-2">
	            <div class="form-group">
	                    <div class="form-material floating">
	                        <input class="form-control" id="material-text2" name="username" value="{{ $data->username }}" type="text">
	                        <label for="material-text2">Username</label>
	                    </div>
	            </div>
	            
	            <div class="form-group">
	                    <div class="form-material floating">
	                        <input class="form-control" id="material-text2" name="firstname" value="{{ $data->firstname }}" type="text">
	                        <label for="material-text2">First Name</label>
	                    </div>
	            </div>
	            <div class="form-group">
	                    <div class="form-material floating">
	                        <input class="form-control" id="material-text2" name="lastname" value="{{ $data->lastname }}" type="text">
	                        <label for="material-text2">Last Name</label>
	                    </div>
	            </div>
	            <div class="form-group">
	                    <div class="form-material floating">
	                        <input class="form-control" id="material-text2" name="email" value="{{ $data->email }}" type="text">
	                        <label for="material-text2">Email</label>
	                    </div>
	            </div>
	            <div class="form-group">
	                    <div class="form-material">
	                        <label for="material-text2">Profile Photo</label>
	                        @if(!is_null($data->photo))
	                        <div id="currentPhoto">
	                        	<div class="col-md-3">
		                        	<img src="{{ url('/uploads/photos/75px_'.$data->photo->fileName) }}" class="img-thumbnail" alt="" />
		                        	 <span class="btn btn-primary" onclick="return replaceNew('uploadPhoto', 'currentPhoto');">Replace</span>
		                        </div>
		                        <br>
	                        </div>
	                        @endif
	                        <div @if(!is_null($data->photo)) style="display: none;" id="uploadPhoto" @endif>
	                        	<input id="fileuploader" type="file" name="photo" class="file">
	                        </div>
	                        
	                    </div>
	            </div>
	             <div class="form-group">
                        <div class="form-material floating">
                            <select class="js-select2 form-control" id="example2-select2-multiple" name="accesslevel">
                                <option></option>
                                @foreach($accesslevels as $level)
                               	<option value="{{ $level->levelPoint }}" @if($data->accessLevel == $level->levelPoint) selected="" @endif>{{ $level->levelName }}</option>
                               	@endforeach
                            </select>
                            <label for="example2-select2">Access Level</label>
                        </div>
                </div>

                <div class="form-group">
	                    <div class="form-material floating">
	                        <input class="form-control" id="material-password2" name="password" type="password">
	                        <label for="material-password2"><strong>New</strong> Password</label>
	                    </div>
	            </div>
	         </div>
            </div>
            <br>
        
    </div>
</div>

@if($templates != "[]")
<div class="block block-bordered">
    <div class="block-header bg-gray-lighter">
   	 	<ul class="block-options">
           @include('Users::admin.navigation')
        </ul>
        <h3 class="block-title"><i class="fa fa-pencil"></i> Extra Informations</h3>
    </div>
    <div class="block-content push-10-t form-horizontal">
 
            <div class="row push-10-t">
            <div class="col-md-8 col-md-offset-2">
            	@foreach($templates as $t)
	          	<div class="form-group">
	                    <div class="form-material floating">
	                        <input class="form-control" id="material-text2" name="templates[{{ $t->id }}]" value="{{ $t->getData($data->id)->data or "" }}" type="text">
	                        <label for="material-text2">{{ $t->templateName }}</label>
	                    </div>
	            </div>
            	@endforeach
            </div>
        
    		</div>
	</div>
</div>
@endif

<div class="block block-bordered">
	<div class="block-content">
		<div class="form-group">
	    <div class="col-sm-12 text-center">
	        <button class="btn btn-sm btn-primary" type="submit">Submit</button>
	    </div>
	    <br><br>
		</div>
	</div>
</div>



</form>
@endsection