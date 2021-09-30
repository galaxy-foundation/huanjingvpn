<?php
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title><?php echo app('translator')->getFromJson('app.title'); ?> - <?php echo $__env->yieldContent('page'); ?></title>
	<link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/fontawesome-all.css')); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo e(asset('css/simple-sidebar.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('css/hexasync.css')); ?>" rel="stylesheet">
	<?php echo $__env->yieldContent('style'); ?>

</head>

<body>

<div class="d-flex" id="wrapper">
	<div class="bg-light border-right" id="sidebar-wrapper">
		<div class="sidebar-heading"><?php echo app('translator')->getFromJson('app.title'); ?></div>
		<div class="list-group list-group-flush">
			<?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<a href="<?php echo e(route($row['slug'])); ?>" class="list-group-item list-group-item-action<?php echo e($slug==$row['slug']?'':' bg-light'); ?>"><?php echo e($row['label']); ?></a>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	</div>
	<div id="page-content-wrapper">
		<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
			<button class="btn btn-primary" id="menu-toggle"><?php echo app('translator')->getFromJson('client.menu-toggle'); ?></button>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
				<li class="nav-item active">
					<a class="nav-link" href="<?php echo e(route('deposit')); ?>"><?php echo e(App\Helper::btc(auth()->user()->btc)); ?>฿</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e($currentLang); ?></a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="<?php echo e(route('en')); ?>"><?php echo e(App\Helper::LANG['en']); ?></a>
						<a class="dropdown-item" href="<?php echo e(route('zh')); ?>"><?php echo e(App\Helper::LANG['zh']); ?></a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e(auth()->user()->name); ?></a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="<?php echo e(route('account')); ?>" href="#"><?php echo app('translator')->getFromJson('client.menu-passwd'); ?></a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="<?php echo e(route('logout')); ?>"><?php echo app('translator')->getFromJson('client.menu-logout'); ?></a>
					</div>
				</li>
			</ul>
			</div>
		</nav>

		<div class="container pt-5">
			<?php echo $__env->yieldContent('content'); ?>
		</div>
	</div>
</div>

<script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/popper.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
<?php echo $__env->yieldContent('script'); ?>
<script>
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
</script>
</body>

</html>
<?php /**PATH D:\web\huanjing\resources\views/layouts/client.blade.php ENDPATH**/ ?>