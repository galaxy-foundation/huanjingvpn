@php
	$menus=[
		['label'=>__('client.menu-account'), 'slug'=>'account'],
		['label'=>__('client.menu-plan'), 'slug'=>'plan'],
		['label'=>__('client.menu-invoice'), 'slug'=>'invoice'],
		['label'=>__('client.menu-deposit'), 'slug'=>'deposit'],
	];
	$lang='zh';
	if(session()->has('lang')) {
		$lang=session()->get('lang');
	}
	$currentLang=App\Helper::LANG[$lang];
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>@lang('app.title') - @yield('page')</title>
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/fontawesome-all.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('css/simple-sidebar.css') }}" rel="stylesheet">
	<link href="{{ asset('css/hexasync.css') }}" rel="stylesheet">
	@yield('style')

</head>

<body>

<div class="d-flex" id="wrapper">
	<div class="bg-light border-right" id="sidebar-wrapper">
		<div class="sidebar-heading">@lang('app.title')</div>
		<div class="list-group list-group-flush">
			@foreach($menus as $row)
				<a href="{{ route($row['slug']) }}" class="list-group-item list-group-item-action{{ $slug==$row['slug']?'':' bg-light' }}">{{ $row['label'] }}</a>
			@endforeach
		</div>
	</div>
	<div id="page-content-wrapper">
		<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
			<button class="btn btn-primary" id="menu-toggle">@lang('client.menu-toggle')</button>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
				<li class="nav-item active">
					<a class="nav-link" href="{{ route('deposit') }}">{{ App\Helper::btc(auth()->user()->btc) }}฿</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $currentLang }}</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="{{ route('en') }}">{{ App\Helper::LANG['en'] }}</a>
						<a class="dropdown-item" href="{{ route('zh') }}">{{ App\Helper::LANG['zh'] }}</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ auth()->user()->name }}</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="{{ route('account') }}" href="#">@lang('client.menu-passwd')</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="{{ route('logout') }}">@lang('client.menu-logout')</a>
					</div>
				</li>
			</ul>
			</div>
		</nav>

		<div class="container pt-5">
			@yield('content')
		</div>
	</div>
</div>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
@yield('script')
<script>
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
</script>
</body>

</html>
