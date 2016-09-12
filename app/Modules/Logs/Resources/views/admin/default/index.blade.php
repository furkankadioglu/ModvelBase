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
           @include('Logs::admin.navigation')
        </ul>
        <h3 class="block-title"><i class="fa fa-search"></i> {{ $headName }} SEARCH</h3>
    </div>
    <div class="block-content">
    <form action="{{ url('/admin/modules/Logs/') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                        <div class="form-material floating">
                            <input class="form-control" id="material-text2" name="search[category]" type="text">
                            <label for="material-text2">Category</label>
                        </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                        <div class="form-material floating">
                            <input class="form-control" id="material-text2" name="search[subCategory]" type="text">
                            <label for="material-text2">Sub Category</label>
                        </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                        <div class="form-material floating">
                            <input class="form-control" id="material-text2" name="search[userId]" type="text">
                            <label for="material-text2">User Id</label>
                        </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                        <div class="form-material floating">
                            <input class="form-control" id="material-text2" name="search[relDataId]" type="text">
                            <label for="material-text2">Related Data Id</label>
                        </div>
                </div>
            </div>
            <div class="col-md-2 text-center">
                <div class="form-group">
                        <div class="form-material">
                             <button class="btn btn-sm btn-primary" type="submit">Search</button>
                        </div>
                </div>
            </div>
            </div>
    </form>
    </div>
</div>

<div class="block block-bordered">
    <div class="block-header bg-gray-lighter">
   	 	<ul class="block-options">
           @include('Logs::admin.navigation')
        </ul>
        <h3 class="block-title"><i class="fa fa-history"></i> {{ $headName }}</h3>
    </div>
    <div class="block-content">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th>Username & ID</th>
                    <th>Related Data ID</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
            @foreach($datas as $data)
            <tr>
                <td class="text-center">{{ $data->id }}</td>
                <td>{{ $data->category }}</td>
                <td>{{ $data->subCategory }}</td>
                <td>{{ $data->user->username or "" }} {{ $data->user->id or "" }}</td>
                <td>{{ $data->relDataId or "" }}</td>
                <td>{{ $data->created_at }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>

        {!! $datas->render() !!}
    </div>
</div>

@endsection



