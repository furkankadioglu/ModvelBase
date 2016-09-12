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
           @include('Modvel::admin.modulesNavigation')
        </ul>
        <h3 class="block-title"><i class="fa fa-pencil-square-o"></i> {{ $headName }}</h3>
    </div>
    
    <div class="col-md-4">
        <a class="block block-link-hover2 text-center" href="{{ url('/admin/modules/Modvel/modules/functions/migrate')}}">
              <div class="block-content block-content-full bg-primary">
                  <i class=" fa-4x fa fa-database fa-align-justify text-white"></i>
                  <div class="font-w600 text-white-op push-15-t">Migrate</div>
              </div>
          </a>
    </div>
    <div class="col-md-4">
        <a class="block block-link-hover2 text-center" href="{{ url('/admin/modules/Modvel/modules/functions/migrate')}}">
              <div class="block-content block-content-full bg-primary">
                  <i class=" fa-4x fa fa-map fa-align-justify text-white"></i>
                  <div class="font-w600 text-white-op push-15-t">Scan</div>
              </div>
          </a>
    </div>
    <div class="col-md-4">
        <a class="block block-link-hover2 text-center" href="{{ url('/admin/modules/Modvel/modules/functions/migrate')}}">
              <div class="block-content block-content-full bg-primary">
                  <i class=" fa-4x fa fa-wrench fa-align-justify text-white"></i>
                  <div class="font-w600 text-white-op push-15-t">Update</div>
              </div>
          </a>
    </div>

    <div class="block-content">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
        <table class="table table-bordered table-striped js-dataTable-full">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Module Name</th>
                    <th>Category</th>
                    <th>Customer</th>
                    <th>Version</th>
                    <th class="text-center" style="width: 10%;">Updated At</th>
                    <th class="text-center" style="width: 10%;">Created At</th>
                    <th class="text-center" style="width: 10%;">*</th>
                </tr>
            </thead>
            <tbody>
            @foreach($datas as $data)
                <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->category }}</td>
                    <td>{{ $data->customer }}</td>
                    <td>{{ $data->version }}</td>
                    <td>{{ $data->created_at }}</td>
                    <td>{{ $data->updated_at }}</td>
                    <td class="text-center">
                       *
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection



