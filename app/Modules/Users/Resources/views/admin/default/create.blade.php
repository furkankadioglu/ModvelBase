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
<form action="{{ url('/admin/modules/Users/') }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
<input type="hidden" name="postCategory" value="create">
<div class="block block-bordered">
    <div class="block-header bg-gray-lighter">
   	 	<ul class="block-options">
           @include('Users::admin.navigation')
        </ul>
        <h3 class="block-title"><i class="fa fa-plus"></i> {{ $headName }} CREATE</h3>
    </div>
    <div class="block-content push-10-t form-horizontal">
 			@if (count($errors) > 0)
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif
            <div class="row push-10-t">
            <div class="col-md-8 col-md-offset-2">
	            <div class="form-group">
	                    <div class="form-material floating">
	                        <input class="form-control" id="material-text2" name="username" type="text">
	                        <label for="material-text2">Username</label>
	                    </div>
	            </div>
	            <div class="form-group">
	                    <div class="form-material floating">
	                        <input class="form-control" id="material-password2" name="password" type="password">
	                        <label for="material-password2">Password</label>
	                    </div>
	            </div>
	            <div class="form-group">
	                    <div class="form-material floating">
	                        <input class="form-control" id="material-text2" name="firstname" type="text">
	                        <label for="material-text2">First Name</label>
	                    </div>
	            </div>
	            <div class="form-group">
	                    <div class="form-material floating">
	                        <input class="form-control" id="material-text2" name="lastname" type="text">
	                        <label for="material-text2">Last Name</label>
	                    </div>
	            </div>
	            <div class="form-group">
	                    <div class="form-material floating">
	                        <input class="form-control" id="material-text2" name="email" type="text">
	                        <label for="material-text2">Email</label>
	                    </div>
	            </div>
	            <div class="form-group">
	                    <div class="form-material">
	                        <label for="material-text2">Profile Photo</label>
	                        <input id="fileuploader" type="file" name="photo" class="file" >
	                    </div>
	            </div>
	             <div class="form-group">
                        <div class="form-material floating">
                            <select class="js-select2 form-control" id="example2-select2-multiple" name="accesslevel">
                                <option></option>
                                @foreach($accesslevels as $level)
                               	<option value="{{ $level->levelPoint }}">{{ $level->levelName }}</option>
                               	@endforeach
                            </select>
                            <label for="example2-select2">Access Level</label>
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
	                        <input class="form-control" id="material-text2" name="templates[{{ $t->id }}]" value="" type="text">
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