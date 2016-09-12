<!DOCTYPE html>
<!--[if IE 9]>         <html class="ie9 no-focus"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-focus"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <title>{{ $panelname }} | Control Panel</title>

        <meta name="description" content="Administrator Panel">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">

        <link rel="shortcut icon" href="assets/img/favicons/favicon.png">

        <link rel="icon" type="image/png" href="assets/img/favicons/favicon-16x16.png" sizes="16x16">
        <link rel="icon" type="image/png" href="assets/img/favicons/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="assets/img/favicons/favicon-96x96.png" sizes="96x96">
        <link rel="icon" type="image/png" href="assets/img/favicons/favicon-160x160.png" sizes="160x160">
        <link rel="icon" type="image/png" href="assets/img/favicons/favicon-192x192.png" sizes="192x192">

        <link rel="apple-touch-icon" sizes="57x57" href="assets/img/favicons/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="assets/img/favicons/apple-touch-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="assets/img/favicons/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="assets/img/favicons/apple-touch-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="assets/img/favicons/apple-touch-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="assets/img/favicons/apple-touch-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="assets/img/favicons/apple-touch-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="assets/img/favicons/apple-touch-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon-180x180.png">

        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">

        <link rel="stylesheet" href="{{ url('assets/admin/js/plugins/slick/slick.min.css') }}">
        <link rel="stylesheet" href="{{ url('assets/admin/js/plugins/slick/slick-theme.min.css') }}">
        <link rel="stylesheet" href="{{ url('assets/admin/css/bootstrap.min.css') }}">
        <link rel="stylesheet" id="css-main" href="{{ url('assets/admin/css/oneui.css') }}">
        <link rel="stylesheet" href="{{ url('assets/admin/js/plugins/select2/select2.min.css') }}">
        <link rel="stylesheet" href="{{ url('assets/admin/js/plugins/select2/select2-bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ url('assets/admin/js/plugins/bootstrap-datepicker/bootstrap-datepicker3.min.css') }}">
        <link rel="stylesheet" href="{{ url('assets/admin/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css') }}">
        <link href="{{ url('assets/admin/css/fileinput/fileinput.min.css') }}" media="all" rel="stylesheet" type="text/css" />
        @yield('styles')
    </head>
    <body>
       <!-- Page Container -->
        <div id="page-container" class="sidebar-l sidebar-o side-scroll header-navbar-fixed">
            <!-- Sidebar -->
            <nav id="sidebar">
                <!-- Sidebar Scroll Container -->
                <div id="sidebar-scroll">
                    <!-- Sidebar Content -->
                    <!-- Adding .sidebar-mini-hide to an element will hide it when the sidebar is in mini mode -->
                    <div class="sidebar-content">
                        <!-- Side Header -->
                        <div class="side-header side-content bg-white-op">
                            <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
                            <button class="btn btn-link text-gray pull-right hidden-md hidden-lg" type="button" data-toggle="layout" data-action="sidebar_close">
                                <i class="fa fa-times"></i>
                            </button>
                            <!-- Themes functionality initialized in App() -> uiHandleTheme() -->

                            <a class="h5 text-white" href="{{ url('/admin') }}">
                                <span class="h4 font-w600 text-primary">{{ $panelbold }}</span> <span class="h4 font-w600 sidebar-mini-hide">{{ $panelwhite }}</span>
                            </a>
                        </div>
                        <!-- END Side Header -->

                        <!-- Side Content -->
                        <div class="side-content">
                        <br>
                        <div class="row push-15 hidden-xs">
                            <div class="col-md-3">
                            @if(!is_null($user->photo))
                            <img src="{{ url('/uploads/photos/125px_'.$user->photo->fileName) }}" class="img-avatar img-avatar25 img-avatar-thumb" alt="">
                            @else
                            <img src="http://placehold.it/150x150" class="img-avatar img-avatar25 img-avatar-thumb" alt="">
                            @endif
                            </div>
                            <div class="col-md-9 text-center"><p class="text-white"><h5 class="text-white">Furkan KADIOĞLU</h5><span class="text-white"><a href="{{ url('/Users/'.$user->slug) }}">Kullanıcı Profili</a> ( <a href="{{ url('/') }}"><i class="fa fa-home"></i></a> )</span></p></div>
                        </div>
                        <br>
                        <ul class="nav-main">
                        @foreach($adminModuleCategories as $am)
                        <li class="nav-main-heading"><span class="sidebar-mini-hide">{{ $am->category }}</span></li>
                            @foreach($am->sameCategoryModules as $m)
                                <li>
                                    <a href="{{ url('admin/modules/'.$m->name) }}" class="nav-submenu" data-toggle="nav-submenu"><i class="{{ $m["icon"] }}"></i> {{ $m->adminDisplayName }}</a>
                                    @if($m->adminNavigationLinks() != "[]")
                                    <ul>
                                        @foreach($m->adminNavigationLinks() as $nl)
                                        <li><a href="{{ url('admin/modules/'.$m->name.$nl->value) }}">{{ $nl->key }}</a></li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                            @endforeach
                        @endforeach
                        </ul>
                        </div>
                        <!-- END Side Content -->
                    </div>
                    <!-- Sidebar Content -->
                </div>
                <!-- END Sidebar Scroll Container -->
            </nav>
            <!-- END Sidebar -->

            <!-- Header -->
            <header id="header-navbar" class="content-mini content-mini-full">
                <!-- Header Navigation Right -->
                <ul class="nav-header pull-right">
                    <li>
                        <div class="btn-group">
                            <button class="btn btn-default btn-image dropdown-toggle" data-toggle="dropdown" type="button">
                            @if(!is_null($user->photo))
                            <img src="{{ url('/uploads/photos/25px_'.$user->photo->fileName) }}" alt="">
                            @else
                            <img src="{{ url('/assets/images/gavatar/1.jpg') }}" alt="">
                            @endif
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                 <li>
                                    <a tabindex="-1" href="{{ url('/')}}">
                                        <i class="fa fa-home pull-right"></i>Back To Site
                                    </a>
                                </li>
                                <li>
                                    <a tabindex="-1" href="{{ url('/Users/logout')}}">
                                        <i class="si si-logout pull-right"></i>Log out
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                    </li>
                </ul>
                <!-- END Header Navigation Right -->

                <!-- Header Navigation Left -->
                <ul class="nav-header pull-left">
                    <li class="visible-xs">
                        <!-- Toggle class helper (for .js-header-search below), functionality initialized in App() -> uiToggleClass() -->
                        <button class="btn btn-default" data-toggle="class-toggle" data-target=".js-header-search" data-class="header-search-xs-visible" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </li>
                </ul>
                <!-- END Header Navigation Left -->
            </header>
            <!-- END Header -->

            <!-- Main Container -->
            <main id="main-container">
                <!-- Page Header -->
                <div class="content bg-image overflow-hidden default-bg">
                    <div class="push-50-t push-15">
                        <h1 class="h2 text-white">{{ $panelname }}</h1>
                        <h2 class="h5 text-white-op">Administrator Panel</h2>
                    </div>
                </div>
                <!-- END Page Header -->

                <!-- Stats -->
                <div class="content bg-white border-b">
                    <ol class="breadcrumb push-10-t">
                        <li>{{ $panelname }}</li>
                        <li><a class="link-effect" href="">@yield('breadcrumb', 'Blank')</a></li>
                    </ol>
                    <br><br>
                </div>
                <!-- END Stats -->

                <!-- Page Content -->
                <div class="content">
                    @yield('content')
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->

            <!-- Footer -->
            <footer id="page-footer" class="content-mini content-mini-full font-s12 bg-gray-lighter clearfix">
                <div class="pull-right">
                    Crafted with <i class="fa fa-heart text-city"></i> by <a class="font-w600" href="http://castram.com" target="_blank">Castram</a>
                </div>
                <div class="pull-left">
                    <a class="font-w600" href="{{ url('/') }}" target="_blank">{{ $panelname }}</a> &copy; <span class="js-year-copy"></span>
                </div>
            </footer>
            <!-- END Footer -->
        </div>
        <!-- END Page Container -->

        @yield('modals')


        <!-- OneUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock, Appear, CountTo, Placeholder, Cookie and App.js -->
        <script src="{{ url('assets/admin/js/core/jquery.min.js') }}"></script>
        <script src="{{ url('assets/admin/js/core/bootstrap.min.js') }}"></script>
        <script src="{{ url('assets/admin/js/core/jquery.slimscroll.min.js') }}"></script>
        <script src="{{ url('assets/admin/js/core/jquery.scrollLock.min.js') }}"></script>
        <script src="{{ url('assets/admin/js/core/jquery.appear.min.js') }}"></script>
        <script src="{{ url('assets/admin/js/core/jquery.countTo.min.js') }}"></script>
        <script src="{{ url('assets/admin/js/core/jquery.placeholder.min.js') }}"></script>
        <script src="{{ url('assets/admin/js/core/js.cookie.min.js') }}"></script>
        <script src="{{ url('assets/admin/js/plugins/fileinput/fileinput.js') }}" type="text/javascript"></script>
        <script src="{{ url('assets/admin/js/plugins/fileinput/fileinput_locale_tr.js') }}" type="text/javascript"></script>
        <script src="{{ url('assets/admin/js/plugins/select2/select2.full.min.js') }}"></script>
        <script src="{{ url('assets/admin/js/plugins/confirm/jquery.confirm.min.js') }}"></script>
        <script src="{{ url('assets/admin/js/plugins/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
        <script src="{{ url('assets/admin/js/plugins/ckeditor/ckeditor.js') }}"></script>
        <script src="{{ url('assets/admin/js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ url('assets/admin/js/plugins/bootstrap-datetimepicker/moment.min.js') }}"></script>
        <script src="{{ url('assets/admin/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>

        <!-- Page JS Code -->
        @yield('scripts')

        <script src="{{ url('assets/admin/js/app.js') }}"></script>
        

        <script>
            jQuery(function () {
                // Init page helpers (Slick Slider plugin)
                App.initHelpers('datepicker','datetimepicker', 'slick', 'select2', 'tags-inputs', 'ckeditor');
            });
        </script>
    </body>
</html>