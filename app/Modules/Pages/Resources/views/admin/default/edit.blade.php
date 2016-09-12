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

    var csrf = '{{ csrf_token() }}';
	CKEDITOR.replace( 'content', {
	 	toolbarGroups: [
				{"name":"basicstyles","groups":["basicstyles"]},
				{"name":"links","groups":["links"]},
				{"name":"paragraph","groups":["list","blocks"]},
				{"name":"insert","groups":["insert"]},
				{"name":"styles","groups":["styles"]},
			],
		removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar',
        filebrowserUploadUrl: '{{ url('/admin/modules/Pages/') }}?postCategory=inlinePhotoUpload&_token=' + csrf
	 });

	 CKEDITOR.on( 'fileUploadResponse', function( evt ) {
        var fileLoader = evt.data.fileLoader,
            xhr = fileLoader.xhr,
            data = evt.data;

        try {
            var response = JSON.parse( xhr.responseText );
            if ( response.error && response.error.message ) {
                data.message = response.error.message;
            }
            if ( !response.uploaded ) {
                evt.cancel();
            } else {
                data.fileName = response.fileName;
                data.url = response.url;
                data.width = response.width;
                data.height = response.height;
                evt.stop();
            }
        } catch ( err ) {
            data.message = fileLoader.lang.filetools.responseError;
            window.console && window.console.log( xhr.responseText );

            evt.cancel();
        }
	});
</script>
@endsection


@section('content')
<form action="{{ url('/admin/modules/Pages/'.$data->id) }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
<input name="_method" type="hidden" value="PUT" />
<input type="hidden" name="postCategory" value="edit">
<div class="block block-bordered">
    <div class="block-header bg-gray-lighter">
   	 	<ul class="block-options">
           @include('Pages::admin.navigation')
        </ul>
        <h3 class="block-title"><i class="fa fa-plus"></i> {{ $headName }} EDIT</h3>
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
	                        <input class="form-control" id="material-text2" name="title" value="{{ $data->title }}" type="text">
	                        <label for="material-text2">Title</label>
	                    </div>
	            </div>

	            <div class="form-group">
	                    <div class="form-material floating">
                            <textarea name="description" class="form-control" cols="30" rows="3">{{ $data->description }}</textarea>
	                        <label for="material-text2">Description</label>
	                    </div>
	            </div>

	            <div class="form-group">
	                    <div class="form-material">
	                        <label for="material-text2">Content</label>
                            <textarea name="content" class="form-control" id="editor" cols="30" rows="10">{{ $data->content }}</textarea>
	                    </div>
	            </div>

	            <div class="form-group">
	                    <div class="form-material">
	                        <label for="material-text2">Thumbnail Photo</label>
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
	                        <input class="form-control" id="material-text2" value="{{ Auth::user()->username }}" type="text" disabled>
	                        <label for="material-text2">Writer</label>
	                    </div>
	            </div>
	             <div class="form-group">
                        <div class="form-material floating">
                            <select class="js-select2 form-control" id="example2-select2-multiple" name="masterPageId">
                                <option></option>
                                @foreach($pages as $page)
	                                @if($page->id != $data->id)
	                               	<option value="{{ $page->id }}" @if($page->id == $data->masterPageId) selected @endif>{{ $page->title }}</option>
	                               	@endif
                               	@endforeach
                            </select>
                            <label for="example2-select2">Master Page</label>
                        </div>
                </div>

                <div class="form-group">
	            		<div class="form-material">
	            			<label class="css-input switch switch-warning">
                                <input type="checkbox" name="showMenu" {{ ($data->showMenu == 1) ? 'checked=""' : '' }}><span></span> Show Menu
                            </label>
	            		</div>
	            </div>
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