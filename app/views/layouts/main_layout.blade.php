<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" >

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Serentak</title>

		<!-- If you are using CSS version, only link these 2 files, you may add app.css to use for your overrides if you like. -->
		<!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'> -->
		<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
		{{HTML::style('assets/css/normalize.css')}}
		{{HTML::style('assets/css/foundation.css')}}
		{{HTML::style('assets/css/app.css')}}
		<!-- {{HTML::style('assets/css/font-awesome-4.2.0/css/font-awesome.min.css')}} -->
		{{HTML::style('assets/css/foundation-icons/foundation-icons.css')}}
		
		{{HTML::script('assets/js/vendor/modernizr.js')}}
		{{HTML::script('assets/js/action.js')}}
	</head>

	<body>

		@yield('content')
			

		{{HTML::script('assets/js/vendor/jquery.js')}}
		{{HTML::script('assets/js/foundation.min.js')}}
  		<script>
    		$(document).foundation();
  		</script>
	
	</body>
</html>