<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo e(__('app.title')); ?> - <?php echo e(__('auth.login')); ?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/bootstrap-min.css')); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/app.css')); ?>">
	</head>
	<body>
		<div class="center login">
			<div class="dialog">
				<form class="galaxy" action="<?php echo e(route('login.submit',['entry'=>$entry])); ?>" method="post">
					<?php echo csrf_field(); ?>
					<input type="text" value="<?php echo e(old('name')); ?>" required="" style="width:100%" name="name" placeholder="<?php echo app('translator')->getFromJson('auth.username'); ?>" minlength="3" maxlength="20" pattern="^[a-zA-Z0-9\-_]+$" autocomplete="off">
					<?php if($errors->has('name')): ?>
						<p class="helper text-danger"><?php echo e($errors->first('name')); ?></p>
					<?php endif; ?>
					<p class="helper"><?php echo app('translator')->getFromJson('auth.characters'); ?>: [ a-z, A-Z, 0-9 ] { 3-20 }</p>
					<input type="password" value="<?php echo e(old('passwd')); ?>" required="" style="width:100%" name="passwd" placeholder="<?php echo app('translator')->getFromJson('auth.password'); ?>" minlength="8" maxlength="32" pattern="^[ -~]+$" autocomplete="off">
					<?php if($errors->has('passwd')): ?>
						<p class="helper text-danger"><?php echo e($errors->first('passwd')); ?></p>
					<?php endif; ?>
					<p class="helper">8-32 <?php echo app('translator')->getFromJson('auth.characters'); ?>.</p>
					<input type="text" value="<?php echo e(old('captcha')); ?>" required="" style="width:100%" name="captcha" placeholder="<?php echo app('translator')->getFromJson('auth.captcha'); ?>" minlength="6" maxlength="6" pattern="^[a-zA-Z]+$" autocomplete="off">
					<?php if($errors->has('captcha')): ?>
						<p class="helper text-danger"><?php echo e($errors->first('captcha')); ?></p>
					<?php endif; ?>
					<div><img src="<?php echo e(route('captcha')); ?>"></div>
					<button type="submit" class="w-100 btn--raised ripple"><?php echo app('translator')->getFromJson('auth.login'); ?></button>
				</form>
			</div>
		</div>
	</body>
</html>
<?php /**PATH D:\web\html-admin\resources\views/auth/login.blade.php ENDPATH**/ ?>