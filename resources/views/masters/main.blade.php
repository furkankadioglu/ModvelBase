<html>
<head>
<title>{{ $brandname }} @yield('title')</title>

<!-- Begin: Styles -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
<link rel="stylesheet" href="https://bootswatch.com/cerulean/bootstrap.min.css" />
@yield('styles')
<!--  End: Styles -->
</head>
<body>
<div class="container">
<br>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">{{ $brandname }}</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
            @foreach($menuPages as $page)
              <li>
                    <a href="{{ url('/Pages/'.$page->slug) }}" @if($page->subPages != "[]") class="dropdown-toggle" id="menu1" type="button" data-toggle="dropdown" @endif>
                    {{ $page->title }}
                    @if($page->subPages != "[]")<span class="caret"></span>@endif</a>

                    @if($page->subPages != "[]")
                    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                    <li><a href="{{ url('/Pages/'.$page->slug) }}">{{ $page->title }}</a></li>
                        @foreach($page->subPages as $subPage)
                          <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ url('/Pages/'.$subPage->slug) }}">{{ $subPage->title }}</a></li>
                        @endforeach
                    </ul>
                    @endif
              </li>

            @endforeach
            </ul>

            @if(Auth::check())
            <ul class="nav navbar-nav navbar-right">
              <li><a href="{{ url('/Users/') }}">Control Panel</a></li>
              @if(Auth::user()->isAdmin())
              <li><a href="{{ url('/admin/') }}">Admin Panel</a></li>
           	  @endif
              <li><a href="{{ url('/Users/logout') }}">Logout</a></li>
            </ul>
            @else
            <ul class="nav navbar-nav navbar-right">
              <li><a href="{{ url('Users/login') }}">Login</a></li>
              <li><a href="{{ url('Users/register') }}">Register</a></li>
            </ul>
            @endif
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
</div>


@section('breadcrumb', 'Blade')

<div class="container">
	<!-- Begin: Content -->
	@yield('content')
	<!--  End: Content -->
</div>


<footer>
	<div class="container text-center">
	<hr>
		<small><i>{{ $brandname }} - 2016</i></small>
	</div>
</footer>

<!-- Begin: Scripts -->
<script   src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
@yield('scripts')
<!--  End: Scripts -->
</body>
</html>


