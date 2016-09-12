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
	 CKEDITOR.replace( 'content');
</script>
@endsection

@section('modals')

@endsection


@section('content')

<div class="block block-bordered">
    <div class="block-header bg-gray-lighter">
   	 	<ul class="block-options">
           @include('Pages::admin.navigation')
        </ul>
        <h3 class="block-title"><i class="fa fa-pencil-square-o"></i> {{ $headName }}</h3>
    </div>
    <div class="block-content">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
        <table class="table table-bordered table-striped js-dataTable-full">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Writer Username</th>
                    <th class="text-center" style="width: 10%;">Functions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($datas as $data)
            <tr>
                <td class="text-center">{{ $data->id }}</td>
                <td>{{ $data->title }}</td>
                <td>{{ $data->slug }}</td>
                <td><a href="{{ url('/Users/'.$data->user->slug) }}" target="_blank">{{ $data->user->username }}</a></td>
                <td class="text-center">
                    <div class="btn-group">
                        <a class="btn btn-xs btn-default" href="{{ url('admin/modules/Pages/'.$data->id.'/edit') }}" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-xs btn-default confirm" href="{{ url('admin/modules/Pages/'.$data->id.'/delete') }}" ><i class="fa fa-times"></i></a>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection



