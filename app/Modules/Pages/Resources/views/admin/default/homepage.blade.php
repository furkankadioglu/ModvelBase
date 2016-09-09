@extends('masters.admin')

@section('breadcrumb')
{{ $headName }}
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ url('assets/admin/js/plugins/datatables/jquery.dataTables.min.css') }}">
@endsection

@section('scripts')
<script src="{{ url('assets/admin/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('assets/admin/js/pages/base_tables_datatables.js') }}"></script>
<script>
</script>
@endsection

@section('modals')

@endsection


@section('content')
<div class="row">
	<div class="col-md-8">
		<form action="{{ url('/admin/modules/Pages/homepage') }}" method="post" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="block block-bordered">
		    <div class="block-header bg-gray-lighter">
		   	 	<ul class="block-options">
		           @include('Pages::admin.navigation')
		        </ul>
		        <h3 class="block-title"><i class="fa fa-plus"></i> {{ $headName }} BLADE</h3>
		    </div>
		    <div class="block-content push-10-t form-horizontal">
		    <input type="hidden" name="postCategory" value="updateHomepage">
					  <div class="form-group">
	                    <div class="form-material">
	                        <label for="material-text2">Content</label>
                            <textarea name="content" class="form-control" id="editor" cols="30" rows="20">{!! $homepage !!}</textarea>
	                    </div>
	            </div>

		      <br>
		    </div>
		</div>

		<div class="block block-bordered">
				<div class="block-content">
					<div class="form-group">
				    <div class="col-sm-12 text-center">
				        <button class="btn btn-sm btn-primary" type="submit">Update</button>
				    </div>
				    <br><br>
					</div>
				</div>
			</div>
		</form>

	</div>
	<div class="col-md-4">
		<form action="{{ url('/admin/modules/Pages/homepage') }}" method="post" enctype="multipart/form-data">
		{{ csrf_field() }}
	    <input type="hidden" name="postCategory" value="updateContents">
		<div class="block block-bordered">
		    <div class="block-header bg-gray-lighter">
		   	 	<ul class="block-options">
		           @include('Pages::admin.navigation')
		        </ul>
		        <h3 class="block-title"><i class="fa fa-plus"></i> {{ $headName }} OPTIONS</h3>
		    </div>
		    <div class="block-content push-10-t form-horizontal">
			  @foreach($match[0] as $k => $v)
			  <div class="form-group">
                    <div class="form-material">
                        <label for="material-text2">{{ $v }}</label>
                        <input class="form-control" id="material-text2" value="{{ $datas[$k]['content'] }}" name="values[{{ $match[1][$k] }}]" type="text">
                    </div>
        		</div>
			  @endforeach

		      <br>
		    </div>
		</div>

		<div class="block block-bordered">
				<div class="block-content">
					<div class="form-group">
				    <div class="col-sm-12 text-center">
				        <button class="btn btn-sm btn-primary" type="submit">Update</button>
				    </div>
				    <br><br>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<br>
<br>
<br>

@endsection



