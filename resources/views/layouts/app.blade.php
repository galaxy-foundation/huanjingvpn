<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>@lang('app.title')</title>
		<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('css/fontawesome-all.css') }}" rel="stylesheet" type="text/css">
		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
		<script src="{{  asset('js/jquery.min.js') }}"></script>
		@yield('style')
	</head>
	<body>
		<script src="{{  asset('js/bootstrap.min.js') }}"></script>
		@yield('content')
		@yield('script')
	</body>
</html>
