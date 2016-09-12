@extends('masters.main')

@section('title')
Control Panel
@endsection

@section('breadcrumb')
Control Panel
@endsection

@section('content')
<div class="page-header">
    <div class="container">
        <h1 class="page-header__title  display-1">Control Panel</h1>
        <p class="page-header__subtitle">{{ $user->nickname }} </p>
    </div>
</div>

<div class="container">
<div class="row">
	<div class="col-md-8">
		<div style="background: rgb(249, 249, 249) none repeat scroll 0% 0%; padding: 10px;">
			<div class="heading">
			<h3>Navigasyon</h3>
		</div>
		<div class="g-content">
				<ul class="match-list">
				  <a href="{{ url('/Users/'.$user->id.'/edit') }}">Profil Düzenleme</a><br>
				  <a href="{{ url('/Users/'.$user->slug) }}">Profil Görüntüleme</a><br>
				  <a href="{{ url('/Users/logout') }}">Çıkış</a><br>
				</ul>
		</div>
		</div>
	</div>
	<div class="col-md-1"></div>
	<div class="col-md-3" style="background: rgb(249, 249, 249) none repeat scroll 0% 0%; padding: 10px;">
		<div class="g-content">
			<div class="text-center">
				@if(!is_null($user->photo))
				<img src="{{ url('/uploads/photos/125px_'.$user->photo->fileName) }}" class="img-thumbnail" alt="">
				@else
				<img src="http://placehold.it/150x150" class="img-thumbnail" alt="">
				@endif
				<br><br>
				<h4>{{ $user->username }}</h4>
				<strong>{{ $user->firstname }} {{ $user->lastname }}</strong>
				<br><br>
				<button class="btn btn-primary btn-xs">{{ $user->accessLevelDetails->levelName or "Uncategorized User" }}</button>

				<br>
				<br>


				</div>
			</div>
		</div>

</div>

<br><br>
		

</div>
@endsection