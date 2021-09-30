<!DOCTYPE html>
<!-- saved from url=(0022) -->
<html lang="en">
<head>
	<meta charset='utf-8'>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="keywords" content="VPN, Unblock, router">
	<meta name="author" content="Galaxy">
	<meta content='Top rated VPN for 2019. Unblock websites & protect all your devices. 24/7 support.Free VPN for Windows, Linux, Android, routers & more.' name='description'>
	<!-- meta content='UHBIQeW0Yu06tf-0iCWzDRK9yMyLf2EyJS-mOCdAgzg' name='google-site-verification' -->
	<meta content='summary_large_image' name='twitter:card'>
	<meta content='@expressvpn' name='twitter:site'>
	<meta content='<?php echo app('translator')->getFromJson('app.page-title'); ?>' property='og:title'>
	<meta content='Top rated VPN for 2019. Unblock websites & protect all your devices. 24/7 support.Free VPN for Windows, Mac, Android, iOS, routers & more.' property='og:description'>
	<meta content="<?php echo e(asset('img/sitemap.jpg')); ?>" property='og:image'>
	<meta content='<?php echo e($_SERVER['HTTP_HOST']); ?>' property='og:url'>
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	<title><?php echo app('translator')->getFromJson('app.page-title'); ?></title>
	<link rel="icon" type="image/png" href="<?php echo e(asset('img/sync-logo.png')); ?>" >
	<link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/fontawesome-all.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/owl.carousel.min.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/owl.theme.default.min.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/animate.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/hexasync.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
</head>
<body id="page-top">
	<header class="bg-main bg-primary text-white">
		<div id="particles-js">
			<canvas class="particles-js-canvas-el" width="1282" height="944" style="width: 100%; height: 100%;"></canvas>
		</div>
		<nav class="navbar osahan-navbar navbar-expand-lg navbar-dark" id="mainNav">
			<div class="container">
				<a class="navbar-brand js-scroll-trigger" href="#page-top">
					<img src="<?php echo e(asset('img/sync-logo.png')); ?>" lt="">
				</a>
				
				<div class="collapse navbar-collapse" id="navbarResponsive">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item">
							<a class="nav-link js-scroll-trigger" href="#page-top"><?php echo app('translator')->getFromJson('app.menu-home'); ?></a>
						</li>
						<li class="nav-item">
							<a class="nav-link js-scroll-trigger active" href="#service"><?php echo app('translator')->getFromJson('app.menu-service'); ?></a>
						</li>
						<li class="nav-item">
							<a class="nav-link js-scroll-trigger" href="#features"><?php echo app('translator')->getFromJson('app.menu-features'); ?></a>
						</li>
						<li class="nav-item">
							<a class="nav-link js-scroll-trigger" href="#download"><?php echo app('translator')->getFromJson('app.menu-download'); ?></a>
						</li>
						<li class="nav-item">
							<a class="nav-link js-scroll-trigger" href="#support"><?php echo app('translator')->getFromJson('app.menu-support'); ?></a>
						</li>
						<li class="nav-item">
							<a class="nav-link js-scroll-trigger" href="<?php echo e(route('login')); ?>"><?php echo app('translator')->getFromJson('app.menu-login'); ?></a>
						</li>
						<!-- li class="nav-item">
							<a class="nav-link js-scroll-trigger" href="<?php echo e(route('register')); ?>"><?php echo app('translator')->getFromJson('app.menu-register'); ?></a>
						</!-->
					</ul>
				</div>
				
				<a class="btn btn-danger" href="#plan"><?php echo app('translator')->getFromJson('app.menu-getstarted'); ?></a>
				<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
			</div>
		</nav>
		<section class="banner-block pb-0" id="banner">
			<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<h1 class="text-white"><?php echo app('translator')->getFromJson('app.title'); ?></h1>
					
					<p class="lead mb-5 text-white"><?php echo app('translator')->getFromJson('app.banner-1'); ?></p>
					
					<p class="mb-0"><a href="#download" class="btn btn-outline-light"><?php echo app('translator')->getFromJson('app.banner-2'); ?></a></p>
					<h2 class="text-white mt-5"><strong><?php echo app('translator')->getFromJson('app.banner-3'); ?></strong></h2>
					<p class="text-white"><?php echo app('translator')->getFromJson('app.banner-4'); ?></p>
				</div>
			</div>
			</div>
		</section>
		<div class="effectiv">
			<img class="svg" src="<?php echo e(asset('img/bg.svg')); ?>" alt="">
		</div>
	</header>

	<section class="features-block" id="service">
		<div class="container">
			<div class="section-title text-center">
				<h2><?php echo app('translator')->getFromJson('app.service-title'); ?></h2>
				<span class="section-title-line"></span>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="features-item text-center">
						<h5 class="mb-4"><?php echo app('translator')->getFromJson('app.service-part1-1'); ?></h5>
						<p><?php echo app('translator')->getFromJson('app.service-part1-2'); ?></p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="features-item text-center">
						<h5 class="mb-4"><?php echo app('translator')->getFromJson('app.service-part2-1'); ?></h5>
						<p><?php echo app('translator')->getFromJson('app.service-part2-2'); ?></p>
						<p><?php echo app('translator')->getFromJson('app.service-part2-3'); ?></p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="features-item text-center">
						<h5 class="mb-4"><?php echo app('translator')->getFromJson('app.service-part3-1'); ?></h5>
						<p><?php echo app('translator')->getFromJson('app.service-part3-2'); ?></p>
						<p><?php echo app('translator')->getFromJson('app.service-part3-3'); ?></p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="amazing-dashboard-block" id="features">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="amazing-dashboard-left">
						<h2 class="mb-2"><?php echo app('translator')->getFromJson('app.feature-title'); ?></h2>
						<p><span class="section-title-line mb-4"></span></p>

						<h5><?php echo app('translator')->getFromJson('app.feature-1-1'); ?></h5>
						<b><?php echo app('translator')->getFromJson('app.feature-1-2'); ?></b>
						<p><?php echo app('translator')->getFromJson('app.feature-1-3'); ?></p>
						<p class="mb-5"><?php echo app('translator')->getFromJson('app.feature-1-4'); ?></p>

						<h5><?php echo app('translator')->getFromJson('app.feature-2-1'); ?></h5>
						<b><?php echo app('translator')->getFromJson('app.feature-2-2'); ?></b>
						<p><?php echo app('translator')->getFromJson('app.feature-2-3'); ?></p>
						<p class="mb-5"><?php echo app('translator')->getFromJson('app.feature-2-4'); ?></p>

						<h5><?php echo app('translator')->getFromJson('app.feature-3-1'); ?></h5>
						<b><?php echo app('translator')->getFromJson('app.feature-3-2'); ?></b>
						<p><?php echo app('translator')->getFromJson('app.feature-3-3'); ?></p>
						<p class="mb-5"><?php echo app('translator')->getFromJson('app.feature-3-4'); ?></p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="amazing-dashboard-right text-right">
						<img class="amazing-dashboard" src="<?php echo e(asset('img/scr.jpg')); ?>" lt="">
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-6">
					<h4><?php echo app('translator')->getFromJson('app.enc-1'); ?></h4>
					<p><b><?php echo app('translator')->getFromJson('app.enc-2'); ?></b></p>
					<p><?php echo app('translator')->getFromJson('app.enc-3'); ?></p>
				</div>
				<div class="col-md-6">
					<h4><?php echo app('translator')->getFromJson('app.log-1'); ?></h4>
					<p>
						<b><?php echo app('translator')->getFromJson('app.log-2'); ?></b><br>
						<?php echo app('translator')->getFromJson('app.log-3'); ?><br>
						<?php echo app('translator')->getFromJson('app.log-4'); ?><br>
						<?php echo app('translator')->getFromJson('app.log-5'); ?>
					</p>
				</div>
			</div>
		</div>
	</section>
	<section class="bg-primary" id="download">
		<div class="section-title text-center">
			<h2 class="text-white"><?php echo app('translator')->getFromJson('app.download'); ?></h2>
			<span class="section-title-line"></span>
		</div>
		<div class="container">

		

			<div class="row" style="text-align: center">
				<div class="col-md-4" id="win_download">
					<div class="system_logo">
						<a href="http://104.238.116.201:8080/download/ShenyeVPN.zip" ?=""><img src="<?php echo e(asset('img/windows.png')); ?>" alt=""></a>
					</div>
					<div class="mt-3">
						<a class="text-white btn btn-outline-warning" href="http://104.238.116.201:8080/download/ShenyeVPN.zip" ?=""><i class="fa fa-arrow-circle-down"></i> Windows</a>
					</div>
				</div>
				<div class="col-md-4" id="linux_download">
					<div class="system_logo">
						<a href="http://104.238.116.201:8080/download/ShenyeVPN.tar.gz" ?=""><img src="<?php echo e(asset('img/linux.png')); ?>" alt=""></a>
					</div>
					<div class="mt-3">
						<a class="text-white btn btn-outline-warning" href="http://104.238.116.201:8080/download/ShenyeVPN.tar.gz" ?=""><i class="fa fa-arrow-circle-down"></i> Linux</a>
					</div>
				</div>
				<div class="col-md-4" id="android_download">
					<div class="system_logo">
						<a href="http://104.238.116.201:8080/download/ShenyeVPN.apk" ?=""><img src="<?php echo e(asset('img/android.png')); ?>" alt=""></a>
					</div>
					<div class="mt-3">
						<a class="text-white btn btn-outline-warning" href="http://104.238.116.201:8080/download/ShenyeVPN.apk" ?=""><i class="fa fa-arrow-circle-down"></i> Android</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="testimonials-block" id="plan">
		<div class="container">
			<div class="text-center">
				<h2><?php echo app('translator')->getFromJson('app.plan-title'); ?></h2>
				<p><?php echo app('translator')->getFromJson('app.plan-desc'); ?></p>
				<span class="section-title-line"></span>
				<div class="tg-list-item d-flex justify-content-center">
					<div class="d-flex">
						<div id="monthly" class="my-auto text-muted"><?php echo app('translator')->getFromJson('app.plan-monthly'); ?></div>
						<div class="pt-2 pl-3 pr-3">
							<label class="switch">
								<input type="checkbox" checked="" id="plantype" name="plantype">
								<div class="slider"></div>
							</label>
						</div>
						<div id="annually" class="my-auto text-primary"><?php echo app('translator')->getFromJson('app.plan-annually'); ?></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
						<div class="pricing_item" data="0">
							<h4 class="pt-4"><b><?php echo app('translator')->getFromJson('app.plan-basic'); ?></b></h4>
							<div class="plan-amount">
								<div class="price">
									<del id="basic_old">$<?php echo e(number_format($plan[0]['price'],2)); ?></del>
								</div>
								<div class="price">
									<div class="sup">$</div>
									<div class="monthly-amount" id="basic_price"><?php echo e(number_format($plan[1]['price']/12,2)); ?></div>
								</div>
								<div class="per-month"><?php echo app('translator')->getFromJson('app.plan-month'); ?></div>
							</div>
							<div class="divider"></div>
							<div class="thirty-day">
								<p><?php echo app('translator')->getFromJson('app.plan-note-1'); ?></p>
								<p><?php echo app('translator')->getFromJson('app.plan-note-2-1'); ?></p>
								<p><?php echo app('translator')->getFromJson('app.plan-note-3-1'); ?></p>
								<p><?php echo app('translator')->getFromJson('app.plan-note-4'); ?></p>
							</div>
						</div>
				</div>
				<div class="col-sm-4">
					<div class="pricing_item active" data="1">
						<h4 class="pt-4"><b><?php echo app('translator')->getFromJson('app.plan-plus'); ?></b></h4>
						<div class="plan-amount">
							<div class="price">
								<div class="price">
									<del id="plus_old">$<?php echo e(number_format($plan[2]['price'],2)); ?></del>
								</div>
								<div class="price">
									<div class="sup">$</div>
									<div class="monthly-amount" id="plus_price"><?php echo e(number_format($plan[3]['price']/12,2)); ?></div>
								</div>
								<div class="per-month"><?php echo app('translator')->getFromJson('app.plan-month'); ?></div>
							</div>
						</div>
						<div class="divider"></div>
						<div class="thirty-day">
							<p><?php echo app('translator')->getFromJson('app.plan-note-1'); ?></p>
							<p><?php echo app('translator')->getFromJson('app.plan-note-2-3'); ?></p>
							<p><?php echo app('translator')->getFromJson('app.plan-note-3-2'); ?></p>
							<p><?php echo app('translator')->getFromJson('app.plan-note-4'); ?></p>
						</div>
						<div class="savings" id="basic_saving"></div>
					</div>
				</div>
				<div class="col-sm-4">
						<div class="pricing_item" data="2">
							<h4 class="pt-4"><b><?php echo app('translator')->getFromJson('app.plan-pro'); ?></b></h4>
							<div class="plan-amount">
								<div class="price">
									<div class="price">
										<del id="pro_old">$<?php echo e(number_format($plan[4]['price'],2)); ?></del>
									</div>
									<div class="price">
										<div class="sup">$</div>
										<div class="monthly-amount" id="pro_price"><?php echo e(number_format($plan[5]['price']/12,2)); ?></div>
									</div>
								</div>

								<div class="per-month"><?php echo app('translator')->getFromJson('app.plan-month'); ?></div>
							</div>
							<div class="divider"></div>
							<div class="thirty-day">
								<p><?php echo app('translator')->getFromJson('app.plan-note-1'); ?></p>
								<p><?php echo app('translator')->getFromJson('app.plan-note-2-8'); ?></p>
								<p><?php echo app('translator')->getFromJson('app.plan-note-3-2'); ?></p>
								<p><?php echo app('translator')->getFromJson('app.plan-note-4'); ?></p>
							</div>
							<div class="savings" id="basic_saving"></div>
						</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div id="plan_normal" class="accordion">
						<div class="accordion_title"><?php echo app('translator')->getFromJson('app.bitcoin'); ?>
							<div class="paymethod" style="background: none;">
								<img src="<?php echo e(asset('img/bitcoin.png')); ?>" style="width: 45px; height: 55px;">
							</div>
						</div>
						<div class="accordion_panel active">
							<div><?php echo app('translator')->getFromJson('app.bitcoin-desc'); ?></div>
							<h5 class="pay_pricing"><?php echo app('translator')->getFromJson('app.order-total'); ?>: <span class="text-success" id="billing">$<?php echo e(number_format($plan[3]['price'],2)); ?></span> <del id="oldbilling"></del></h5>
							<div><?php echo app('translator')->getFromJson('app.coupon-desc',['num'=>$plan['coupon']]); ?></div>
							<div class="col-md-3">
								<div class="form-group">
									<div class="form-email">
										<input placeholder="<?php echo app('translator')->getFromJson('app.optional'); ?>" minlength="10" maxlength="10" pattern="^[a-zA-Z0-9\-_]+$" autocomplete="off" class="form-control input-lg error" id="coupon" name="coupon">
									</div>
									<div id="coupon-check" class="d-none">
										<div class="spinner-grow text-primary" role="status">
										<span class="sr-only"><?php echo app('translator')->getFromJson('app.loading'); ?></span>
										</div>
										<div class="spinner-grow text-secondary" role="status">
										<span class="sr-only"><?php echo app('translator')->getFromJson('app.loading'); ?></span>
										</div>
										<div class="spinner-grow text-success" role="status">
										<span class="sr-only"><?php echo app('translator')->getFromJson('app.loading'); ?></span>
										</div>
										<div class="spinner-grow text-danger" role="status">
										<span class="sr-only"><?php echo app('translator')->getFromJson('app.loading'); ?></span>
										</div>
									</div>
								</div>
							</div>
							<div class="pay_btn_div" style="margin: 20px 0;">
								<button id="planning" class=" p-3 btn btn-outline-primary"><?php echo app('translator')->getFromJson('app.continue'); ?></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="bg-primary" id="support">
		<div class="section-title text-center">
			<h2 class="text-white"><?php echo app('translator')->getFromJson('app.contact-title'); ?></h2>
		</div>
		<div class="row" style="text-align: center">
			<div class="col-12 text-white">
				<i class="fa fa-envelope"></i> <?php echo app('translator')->getFromJson('app.email'); ?>: <a class="text-warning" href="mailto: support@huanjingvpn.com">support@huanjingvpn.com</a>
			</div>
		</div>
	</section>
	<script type="json" id="data">
		<?php
			echo json_encode($plan)
		?>
	</script>

	<footer class="py-5 text-center ">
		<div class="container">
			<h5 class="text-white mt-0 mb-0"><?php echo app('translator')->getFromJson('app.footer-1'); ?></h5>
		</div>
	</footer>
	<script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
	<script src="<?php echo e(asset('js/bootstrap.bundle.min.js')); ?>"></script>
	<script src="<?php echo e(asset('js/jquery.easing.min.js')); ?>"></script>
	<script src="<?php echo e(asset('js/scrolling-nav.js')); ?>"></script>
	<script src="<?php echo e(asset('js/jqBootstrapValidation.js')); ?>"></script>
	<script src="<?php echo e(asset('js/contact_me.js')); ?>"></script>
	<script src="<?php echo e(asset('js/owl.carousel.js')); ?>"></script>
	<script src="<?php echo e(asset('js/wow.min.js')); ?>"></script>
	<script src="<?php echo e(asset('js/custom.js')); ?>"></script>
	<script src="<?php echo e(asset('js/app.plan.js')); ?>"></script>
</body>
</html><?php /**PATH D:\web\huanjing\resources\views/index.blade.php ENDPATH**/ ?>