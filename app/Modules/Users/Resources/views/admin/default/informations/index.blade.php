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
@endsection

@section('modals')

@endsection


@section('content')

<div class="block block-bordered">
    <div class="block-header bg-gray-lighter">
   	 	<ul class="block-options">
           @include('Users::admin.informationsNavigation')
        </ul>
        <h3 class="block-title"><i class="fa fa-user"></i> {{ $headName }}</h3>
    </div>
    <div class="block-content">
        <table class="table table-bordered table-striped js-dataTable-full">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Template Name</th>
                    <th>Template Type</th>
                    <th class="text-center" style="width: 10%;">Functions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($datas as $data)
            <tr>
                <td class="text-center">{{ $data->id }}</td>
                <td>{{ $data->templateName }}</td>
                <td>{{ $data->getType($data->type) }}</td>
                <td class="text-center">
                    <div class="btn-group">
                        <a class="btn btn-xs btn-default" href="{{ url('admin/modules/Users/informations/'.$data->id.'/edit') }}" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-xs btn-default confirm" href="{{ url('admin/modules/Users/informations/'.$data->id.'/delete') }}" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></a>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection



