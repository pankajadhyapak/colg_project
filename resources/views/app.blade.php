<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MSRIT Code Evaluation</title>

	<link href="{{ asset('/css/style.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Lato:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

</head>
<body id="app">
	@include('partials.nav')
	<div class="alertOverlay">
		@include('flash::message')
	</div>
	@yield('content')

	<!-- Scripts -->
	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script>
		$('.alertOverlay').delay(3000).slideUp();
	</script>
	@yield('footerJs')
</body>
</html>
