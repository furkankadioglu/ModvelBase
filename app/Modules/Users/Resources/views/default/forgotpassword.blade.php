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
<form method="post" action="{{ url('/Users/forgotpassword') }}" class="space20">
{{ csrf_field() }}
<input type="hidden" name="postCategory" value="forgotpassword">
<div class="col-md-6 col-md-offset-3">
	<input type="text" name="email" class="form-control" placeholder="email@domain.com"><br>
	<div class="row">
			<div class="col-md-6">
			{!! app('captcha')->display(); !!}
		</div>

		<div class="col-md-6 text-right">
			<button type="submit" class="btn btn-primary">Send Auth Code</button>
		</div>
	</div>

<br>
	<div class="row text-center">
		<a href="{{ url('/Users/register') }}">Register</a> | <a href="{{ url('/Users/login') }}">Log In</a>
	</div>
	
</div>
</form>
@endsection