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
		<link href="<?php echo e(asset('css/font-awesome.min.css')); ?>" rel="stylesheet" type="text/css">
		<script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
		<?php echo $__env->yieldContent('style'); ?>
	</head>
	<body>
		<script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
		<?php echo $__env->yieldContent('content'); ?>
		<?php echo $__env->yieldContent('script'); ?>
	</body>
</html>
<?php /**PATH D:\web\huanjing\resources\views/layouts/bitcoin.blade.php ENDPATH**/ ?>