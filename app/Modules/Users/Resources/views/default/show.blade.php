@extends('masters.main')

@section('title')
Control Panel
@endsection


@section('content')

<div class="text-center">
<h3>{{ $data->username }} Profile</h3>
<hr>
		@if(!is_null($data->photo))
		<img src="{{ url('/uploads/photos/125px_'.$data->photo->fileName) }}" class="img-thumbnail" alt="">
		@else
		<img src="{{ url('/assets/images/gavatar/1.jpg') }}" class="img-thumbnail" alt="">
		@endif

		<h4>{{ $data->username }}</h4>
		<strong>{{ $data->firstname }} {{ $data->lastname }}</strong>
		<br><br>
		<button class="btn btn-primary btn-xs">{{ $data->accessLevelDetails->levelName or "Uncategorized User" }}</button>
</div>
@endsection