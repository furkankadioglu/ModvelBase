@extends('masters.admin')

@section('breadcrumb')
{{ $headName }}
@endsection

@section('content')
<div class="block block-bordered">
    <div class="block-header bg-gray-lighter">
   	 	<ul class="block-options">
           @include('Users::admin.accesslevelsNavigation')
        </ul>
        <h3 class="block-title"><i class="fa fa-user"></i> {{ $headName }}</h3>
    </div>
    <div class="block-content">
       Succesfully deleted!
       <br><br>
      
    </div>
</div>
@endsection