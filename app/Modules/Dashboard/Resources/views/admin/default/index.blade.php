@extends('masters.admin')

@section('title')
{{ $headName }}
@endsection

@section('breadcrumb')
{{ $headName }}
@endsection

@section('styles')
@endsection

@section('scripts')
  <!-- Page Plugins -->
        <script src="{{ url('assets/admin/js/plugins/slick/slick.min.js') }}"></script>
        <script src="{{ url('assets/admin/js/plugins/chartjs/Chart.min.js') }}"></script>

        <!-- Page JS Code -->
      	<script>
      		var BasePagesDashboard = function() {
		    // Chart.js Chart, for more examples you can check out http://www.chartjs.org/docs
		    var initDashChartJS = function(){
		        // Get Chart Container
		        var $dashChartLinesCon  = jQuery('.js-dash-chartjs-lines')[0].getContext('2d');

		        // Set Chart and Chart Data variables
		        var $dashChartLines, $dashChartLinesData;

		        // Lines Chart Data
		        var $dashChartLinesData = {
		            labels: [
		            	@foreach($sevenDays as $day)
		            	'{{ date('Y-m-d', strtotime($day["date"])) }}',
		            	@endforeach
		            ],
		            datasets: [
		                {
		                    label: 'Visitors',
		                    fillColor: 'rgba(44, 52, 63, .07)',
		                    strokeColor: 'rgba(44, 52, 63, .25)',
		                    pointColor: 'rgba(44, 52, 63, .25)',
		                    pointStrokeColor: '#fff',
		                    pointHighlightFill: '#fff',
		                    pointHighlightStroke: 'rgba(44, 52, 63, 1)',
		                    data: [
		                    	@foreach($sevenDays as $day)
				            	'{{ $day["visitors"] }}',
				            	@endforeach
		                    ]
		                },
		                {
		                    label: 'Page Views',
		                    fillColor: 'rgba(44, 52, 63, .1)',
		                    strokeColor: 'rgba(44, 52, 63, .55)',
		                    pointColor: 'rgba(44, 52, 63, .55)',
		                    pointStrokeColor: '#fff',
		                    pointHighlightFill: '#fff',
		                    pointHighlightStroke: 'rgba(44, 52, 63, 1)',
		                    data: [
		                    	@foreach($sevenDays as $day)
				            	'{{ $day["pageViews"] }}',
				            	@endforeach
		                    ]
		                }
		            ]
		        };

		        // Init Lines Chart
		        $dashChartLines = new Chart($dashChartLinesCon).Line($dashChartLinesData, {
		            scaleFontFamily: "'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif",
		            scaleFontColor: '#999',
		            scaleFontStyle: '600',
		            tooltipTitleFontFamily: "'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif",
		            tooltipCornerRadius: 3,
		            maintainAspectRatio: false,
		            responsive: true
		        });
		    };

		    return {
		        init: function () {
		            // Init ChartJS chart
		            initDashChartJS();
		        }
		    };
		}();

		// Initialize when page loads
		jQuery(function(){ BasePagesDashboard.init(); });
      	</script>
@endsection

@section('modals')
@endsection

@section('content')


<div class="block">
    <div class="block-header">
        <ul class="block-options">
            <li>
                <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
            </li>
        </ul>
        <h3 class="block-title">Overview</h3>
    </div>
    <div class="block-content block-content-full bg-gray-lighter text-center">
        <!-- Chart.js Charts (initialized in js/pages/base_pages_dashboard.js), for more examples you can check out http://www.chartjs.org/docs/ -->
        <div style="height: 374px;"><canvas class="js-dash-chartjs-lines" width="938" height="374" style="width: 938px; height: 374px;"></canvas></div>
    </div>
    <div class="block-content text-center">
        <div class="row items-push text-center">
            <div class="col-lg-6">
                <div class="push-10"><i class="si si-users fa-2x text-primary"></i></div>
                <div class="h5 font-w300 text-muted">+ {{ $usersCount }} Registered User</div>
            </div>
            <div class="col-lg-6 visible-lg">
                <div class="push-10"><i class="si si-star fa-2x text-primary"></i></div>
                <div class="h5 font-w300 text-muted">+ {{ $onlineVisitors }} Online User</div>
            </div>
        </div>
    </div>
</div>

<div class="row">
	<div class="col-lg-6">
    <!-- Latest Sales Widget -->
    <div class="block">
        <div class="block-header">
           
            <h3 class="block-title text-center">Top Pages</h3>
        </div>
        <div class="block-content">
            <div class="pull-t pull-r-l">
                <!-- Slick slider (.js-slider class is initialized in App() -> uiHelperSlick()) -->
                <!-- For more info and examples you can check out http://kenwheeler.github.io/slick/ -->
                <div class="js-slider remove-margin-b slick-initialized slick-slider">
                        <table class="table remove-margin-b font-s13">
                            <tbody>
                            @foreach($mostVisitedPages as $page)
                                <tr>
                                    <td class="font-w600">
                                        {{ $page["url"] }}
                                    </td>
                                    <td class="font-w600 text-primary text-right" style="width: 70px;">{{ $page["pageViews"] }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                 </div>
                    
            </div>
                <!-- END Slick slider -->
            </div>
        </div>

        <div class="col-lg-6">
    <!-- Latest Sales Widget -->
    <div class="block">
        <div class="block-header">
           
            <h3 class="block-title text-center">Top Keywords</h3>
        </div>
        <div class="block-content">
            <div class="pull-t pull-r-l">
                <!-- Slick slider (.js-slider class is initialized in App() -> uiHelperSlick()) -->
                <!-- For more info and examples you can check out http://kenwheeler.github.io/slick/ -->
                <div class="js-slider remove-margin-b slick-initialized slick-slider">
                        <table class="table remove-margin-b font-s13">
                            <tbody>
                            @foreach($topKeywords as $keyword)
                                <tr>
                                    <td class="font-w600">
                                        {{ $keyword["keyword"] }}
                                    </td>
                                    <td class="font-w600 text-primary text-right" style="width: 70px;">{{ $keyword["sessions"] }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                 </div>
                    
            </div>
                <!-- END Slick slider -->
            </div>
        </div>
    </div>
    <!-- END Latest Sales Widget -->
             


<div class="row">
	<div class="col-lg-6">
    <!-- Latest Sales Widget -->
    <div class="block">
        <div class="block-header">
           
            <h3 class="block-title text-center">Top Referrers</h3>
        </div>
        <div class="block-content">
            <div class="pull-t pull-r-l">
                <!-- Slick slider (.js-slider class is initialized in App() -> uiHelperSlick()) -->
                <!-- For more info and examples you can check out http://kenwheeler.github.io/slick/ -->
                <div class="js-slider remove-margin-b slick-initialized slick-slider">
                        <table class="table remove-margin-b font-s13">
                            <tbody>
                            @foreach($topReferrers as $page)
                                <tr>
                                    <td class="font-w600">
                                        {{ $page["url"] }}
                                    </td>
                                    <td class="font-w600 text-primary text-right" style="width: 70px;">{{ $page["pageViews"] }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                 </div>
                    
            </div>
                <!-- END Slick slider -->
            </div>
        </div>

        <div class="col-lg-6">
    <!-- Latest Sales Widget -->
    <div class="block">
        <div class="block-header">
           
            <h3 class="block-title text-center">Top Browsers</h3>
        </div>
        <div class="block-content">
            <div class="pull-t pull-r-l">
                <!-- Slick slider (.js-slider class is initialized in App() -> uiHelperSlick()) -->
                <!-- For more info and examples you can check out http://kenwheeler.github.io/slick/ -->
                <div class="js-slider remove-margin-b slick-initialized slick-slider">
                        <table class="table remove-margin-b font-s13">
                            <tbody>
                            @foreach($topBrowsers as $browser)
                                <tr>
                                    <td class="font-w600">
                                        {{ $browser["browser"] }}
                                    </td>
                                    <td class="font-w600 text-primary text-right" style="width: 70px;">{{ $browser["sessions"] }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                 </div>
                    
            </div>
                <!-- END Slick slider -->
            </div>
        </div>
    </div>



@endsection