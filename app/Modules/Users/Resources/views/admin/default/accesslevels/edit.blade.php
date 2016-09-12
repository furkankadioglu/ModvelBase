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
<form action="{{ url('/admin/modules/Users/accesslevels/'.$accesslevel->id) }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
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
	                        <input class="form-control" id="material-text2" name="levelName" value="{{ $accesslevel->levelName }}" type="text">
	                        <label for="material-text2">Level Name</label>
	                    </div>
	            </div>
	            <div class="form-group">
	                    <div class="form-material floating">
	                        <input class="form-control" id="material-password2" name="levelPoint" value="{{ $accesslevel->levelPoint }}" type="text">
	                        <label for="material-password2">Level Point</label>
	                    </div>
	            </div>
	            <div class="form-group">
	                    <div class="form-material floating">
	                        <input class="form-control" id="material-password2" name="levelRedirect" value="{{ $accesslevel->levelRedirect }}" type="text">
	                        <label for="material-password2">Level Redirect</label>
	                    </div>
	            </div
	         </div>
            </div>
            <br>
    </div>
</div>

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