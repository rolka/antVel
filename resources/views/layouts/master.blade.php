<!DOCTYPE html>
<html lang="{{ App::getLocale() }}" ng-app="AntVel">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<base href="/">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="favicon.ico">

	<title>@section('title'){{ $main_company['website_name']}} @show</title>
	<script type="text/javascript">
	FileAPI = {
		debug: true,
		//forceLoad: true, html5: false //to debug flash in HTML5 browsers
		//wrapInsideDiv: true, //experimental for fixing css issues
		//only one of jsPath or jsUrl.
	    //jsPath: '/js/FileAPI.min.js/folder/',
	    //jsUrl: 'yourcdn.com/js/FileAPI.min.js',

	    //only one of staticPath or flashUrl.
	    //staticPath: '/flash/FileAPI.flash.swf/folder/'
	    //flashUrl: 'yourcdn.com/js/FileAPI.flash.swf'
	};
	</script>
	{{-- Bootstrap Core --}}
	{!! Html::style('/css/vendor/bootstrap.css') !!}
	@section('css')
		{!! Html::style('/css/app.css') !!}
		<!-- Custom styles for this template -->
		{!! Html::style('/css/carousel.css') !!}
		{!! Html::style('/css/vendor/angucomplete-alt.css') !!}
		{!! Html::style('/css/vendor/angular-notify.css') !!}
	@show
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<style>
		
	</style>
</head>
<body>
	<section class="@yield('page_class', 'home')">
{{-- NAVBAR --}}
@section('navigation')
	@include('partial.navigation')
@show
		{{-- CONTENT PAGE --}}
		@section('content')
			@section('panels')
			<div class="container">
				<div class="row">&nbsp;</div>
				<div class="row global-panels">

					{{-- Panel Izquierdo --}}
					@if (isset($panel['left']))
					{{-- Pantallas Grandes --}}
					<div class="col-sm-{{ $panel['left']['width'] or '2' }} col-md-{{ $panel['left']['width'] or '2' }} {{ $panel['left']['class'] or '' }}">
						@section('panel_left_content')
						Panel left
						@show
					</div>
					@endif
					{{-- FIN Panel Izquierdo --}}

					{{-- content --}}
					<div class="col-xs-12 col-sm-{{ $panel['center']['width'] or '10' }} col-md-{{ $panel['center']['width'] or '10' }}">
						@section('center_content')
						Main Content
						@show
					</div>
					{{-- end content --}}

					@if (isset($panel['right']))
					<div class="hidden-xs col-sm-{{ $panel['right']['width'] or '2' }} col-md-{{ $panel['right']['width'] or '2' }} {{ $panel['right']['class'] or '' }}">
						@section('panel_right_content')
						Panel Right
						@show
					</div>
					@endif
				</div>
			</div>
			@show
		@show
	</section><!-- /section -->
@section('footer')
	<footer>
		@include('partial.footer')
	</footer>
@show

<!-- Bootstrap core JavaScript
================================================== -->
{!! Html::script('/js/vendor/jquery.min.js') !!}
{!! Html::script('/js/vendor/angular.min.js') !!}
{!! Html::script('/js/vendor/angular-sanitize.js') !!}
{!! Html::script('/js/vendor/ui-bootstrap-tpls.min.js') !!}
{!! Html::script('/js/vendor/angular-animate.min.js') !!}
{!! Html::script('/js/vendor/loading-bar.js') !!}
{!! Html::script('/js/vendor/angular-mocks.js') !!}
{!! Html::script('/js/vendor/angular-touch.min.js') !!}
{{-- Forms --}}
{!! Html::script('/js/vendor/xtForms/xtForm.js') !!}
{!! Html::script('/js/vendor/xtForms/xtForm.tpl.min.js') !!}

{!! Html::script('/js/vendor/bootstrap.min.js') !!}
{{-- inicializacion de modulo angular --}}
<script>
	var ngModules = ['ngSanitize','LocalStorageModule', 'ui.bootstrap','chieffancypants.loadingBar',
					 'ngAnimate','xtForm','cgNotify','ngTouch','filters','angucomplete-alt'];
	@section('before.angular') @show
	(function(){
		angular.module('AntVel',ngModules,
		function($interpolateProvider){
			$interpolateProvider.startSymbol('[[');
			$interpolateProvider.endSymbol(']]');
		}).config(function(localStorageServiceProvider, cfpLoadingBarProvider,$locationProvider){
			cfpLoadingBarProvider.includeSpinner = false;
			localStorageServiceProvider.setPrefix('tb');
			$locationProvider.html5Mode({enabled:true,rewriteLinks:false});
			// notify.config({duration:2000});
		});
	})();
</script>
{!! Html::script('/js/app.js') !!}
@section('scripts')
{{-- Optional directives angular --}}
{!! Html::script('/js/filters.js') !!}
{!! Html::script('/js/vendor/angucomplete-alt.js') !!}
{!! Html::script('/js/vendor/angular-notify.js') !!}
{!! Html::script('/js/vendor/angular-local-storage.min.js') !!}
{{-- All Jquery plugins in one file, optional by section --}}
{!! Html::script('/js/plugins.js') !!}
@show
</body>
</html>
