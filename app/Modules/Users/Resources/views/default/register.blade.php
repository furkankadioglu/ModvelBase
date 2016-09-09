@extends('masters.main')


@section('scripts')
<script src='https://www.google.com/recaptcha/api.js'></script>
@endsection

@section('content')
<div class="text-center">
	<h2>Register</h2>
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
<form method="post" action="{{ url('/Users/register') }}" class="space20">
{{ csrf_field() }}
<input type="hidden" name="postCategory" value="register">
<div class="col-md-6 col-md-offset-3">
	<input type="text" name="username" class="form-control" placeholder="Username"><br>
	<input type="text" name="firstname" class="form-control" placeholder="First Name"><br>
	<input type="text" name="lastname" class="form-control" placeholder="Last Name"><br>
	<input type="text" name="email" class="form-control" placeholder="email@domain.com"><br>
	<input type="password" name="password" class="form-control" placeholder="Password"><br>
	<div class="text-center">{!! app('captcha')->display(); !!}</div> <br>


	<div class="row">
		<div class="col-md-2 col-md-offset-5 text-center">
		<button type="submit" class="btn btn-primary">Register</button>
		</div>
	</div>
	<br>
	<div class="row text-center">
		<a href="{{ url('/Users/login') }}">Log In</a> | <a href="{{ url('/Users/forgotpassword') }}">Forgot Password</a>
	</div>
	
</div>
</form>
@endsection