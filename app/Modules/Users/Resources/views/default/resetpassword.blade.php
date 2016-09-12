@extends('masters.main')


@section('scripts')
<script src='https://www.google.com/recaptcha/api.js'></script>
@endsection

@section('content')
<div class="text-center">
	<h2>Forgot Password</h2>
</div>
@if(Session::has('flash_message') && Session::has('flash_message_category'))
	<div class="alert alert-{{ Session::get('flash_message') }}">
	{{ Session::get('flash_message') }}
	</div>
@endif
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="post" action="{{ url('/Users/resetpassword') }}" class="space20">
{{ csrf_field() }}
<input type="hidden" name="resetToken" value="{{ $token }}">
<input type="hidden" name="postCategory" value="resetpassword">
<input type="hidden" name="userId" value="{{ $user->id }}">
<div class="col-md-6 col-md-offset-3">
	<input name="mail" value="{{ $user->email or 'Yok' }}" class="form-control" type="text" disabled><br>
	<input name="password1" value="" class="form-control" placeholder="Password" type="password"><br>
	<input name="password2" value="" class="form-control" placeholder="Password (Again)" type="password"><br>
	<br>
	

	<div class="row">
		<div class="col-md-6 text-right">
			<button type="submit" class="btn btn-primary">Save</button>
		</div>
	</div>

	
</div>
</form>
@endsection