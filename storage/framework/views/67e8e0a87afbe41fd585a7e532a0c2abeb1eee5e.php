<?php
	$menus=[
		['label'=>'状态', 'slug'=>'index'],
		['label'=>'主页', 'slug'=>'home'],
		['label'=>'门票', 'slug'=>'ticket'],
		['label'=>'客户', 'slug'=>'guest'],
		['label'=>'钱包', 'slug'=>'wallet'],
		['label'=>'发布', 'slug'=>'post'],
		['label'=>'交易', 'slug'=>'trade'],
		['label'=>'订单', 'slug'=>'order'],
	];
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title><?php echo app('translator')->getFromJson('app.title'); ?></title>
		<link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">
		<link href="<?php echo e(asset('css/metisMenu.min.css')); ?>" rel="stylesheet">
		<link href="<?php echo e(asset('css/timeline.css')); ?>" rel="stylesheet">
		<link href="<?php echo e(asset('css/startmin.css')); ?>" rel="stylesheet">
		
		<link href="<?php echo e(asset('css/font-awesome.min.css')); ?>" rel="stylesheet" type="text/css">
		
		<script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
		<?php echo $__env->yieldContent('style'); ?>
	</head>
	<body>
		<div id="wrapper">
			<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<ul class="nav navbar-right navbar-top-links">
					<li class="dropdown navbar-inverse">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="fa fa-bell fa-fw"></i> <b class="caret"></b>
						</a>
						<ul class="dropdown-menu dropdown-alerts">
							<li>
								<a href="#">
									<div>
										<i class="fa fa-comment fa-fw"></i> New Comment
										<span class="pull-right text-muted small">4 minutes ago</span>
									</div>
								</a>
							</li>
							<li>
								<a href="#">
									<div>
										<i class="fa fa-twitter fa-fw"></i> 3 New Followers
										<span class="pull-right text-muted small">12 minutes ago</span>
									</div>
								</a>
							</li>
							<li>
								<a href="#">
									<div>
										<i class="fa fa-envelope fa-fw"></i> Message Sent
										<span class="pull-right text-muted small">4 minutes ago</span>
									</div>
								</a>
							</li>
							<li>
								<a href="#">
									<div>
										<i class="fa fa-tasks fa-fw"></i> New Task
										<span class="pull-right text-muted small">4 minutes ago</span>
									</div>
								</a>
							</li>
							<li>
								<a href="#">
									<div>
										<i class="fa fa-upload fa-fw"></i> Server Rebooted
										<span class="pull-right text-muted small">4 minutes ago</span>
									</div>
								</a>
							</li>
							<li class="divider"></li>
							<li>
								<a class="text-center" href="#">
									<strong>See All Alerts</strong>
									<i class="fa fa-angle-right"></i>
								</a>
							</li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="<?php echo e(route('logout')); ?>">
							<i class="fa fa-user fa-fw"></i> <?php echo e(\Auth::guard('admin')->user()->name); ?> <i class="fa fa-sign-out"></i>
						</a>
					</li>
				</ul>
				<!-- /.navbar-top-links -->

				<div class="navbar-default sidebar" role="navigation">
					<div class="sidebar-nav navbar-collapse">
						<ul class="nav in" id="side-menu">
							<?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<li <?php if(isset($menu['open'])): ?> class="active"  <?php endif; ?>>
								<a
								<?php if(isset($menu['active'])): ?> 
									class="active"
									href="#"
								<?php else: ?>
									href="<?php echo e(route($menu['slug'])); ?>"
								<?php endif; ?>
								>
									<?php echo e($menu['label']); ?>

								</a>
							</li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</ul>
					</div>
				</div>
			</nav>

			<div id="page-wrapper">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<h1 class="page-header"><?php echo app('translator')->getFromJson($slug.'.title'); ?></h1>
						</div>
					</div>
					<?php echo $__env->yieldContent('content'); ?>
				</div>
			</div>
		</div>
		<script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
		<script src="<?php echo e(asset('js/metisMenu.min.js')); ?>"></script>
		<script src="<?php echo e(asset('js/raphael.min.js')); ?>"></script>
		<script src="<?php echo e(asset('js/startmin.js')); ?>"></script>
		<?php echo $__env->yieldContent('script'); ?>
	</body>
</html>
<?php /**PATH D:\web\html-admin\resources\views/layouts/admin.blade.php ENDPATH**/ ?>