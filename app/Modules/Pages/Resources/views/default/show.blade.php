@extends('masters.main')


@section('content')
<h2>{{ $data->title }}</h2>

<blockquote>
	{!! $data->content !!}
</blockquote>
@endsection