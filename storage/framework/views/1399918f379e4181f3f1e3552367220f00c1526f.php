<?php $__env->startSection('title',__('auth.register')); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
	<div class="container-login100">
		
		<div class="login">
			<h2 class="text-white text-center"><a class="h2" href="<?php echo e(route('index')); ?>"><?php echo app('translator')->getFromJson('app.title'); ?></a> <?php echo app('translator')->getFromJson('auth.register'); ?></h2><hr>
			<div class="dialog">
				<form class="galaxy" action="<?php echo e(route('register.submit' )); ?>" method="post">
					<?php echo csrf_field(); ?>
					<input type="text" value="<?php echo e(old('name')); ?>" required="" style="width:100%" name="name" placeholder="<?php echo app('translator')->getFromJson('auth.username'); ?>" minlength="3" maxlength="20" pattern="^[a-zA-Z0-9\-_]+$" autocomplete="off">
					<?php if($errors->has('name')): ?>
						<p class="helper text-danger"><?php echo e($errors->first('name')); ?></p>
					<?php endif; ?>
					<p class="helper"><?php echo app('translator')->getFromJson('auth.characters'); ?>: [ a-z, A-Z, 0-9 ] { 3-20 }</p>
					<input type="password" value="<?php echo e(old('passwd')); ?>" required="" style="width:100%" name="passwd" placeholder="<?php echo app('translator')->getFromJson('auth.password'); ?>" minlength="6" maxlength="32" pattern="^[ -~]+$" autocomplete="off">
					<?php if($errors->has('passwd')): ?>
						<p class="helper text-danger"><?php echo e($errors->first('passwd')); ?></p>
					<?php endif; ?>
					<p class="helper">6-32 <?php echo app('translator')->getFromJson('auth.characters'); ?>.</p>
					<input type="password" value="<?php echo e(old('confirmpasswd')); ?>" required="" style="width:100%" name="confirmpasswd" placeholder="<?php echo app('translator')->getFromJson('auth.confirm'); ?>" minlength="6" maxlength="32" pattern="^[ -~]+$" autocomplete="off">
					<?php if($errors->has('confirmpasswd')): ?>
						<p class="helper text-danger"><?php echo e($errors->first('confirmpasswd')); ?></p>
					<?php endif; ?>
					<input type="text" value="<?php echo e(old('captcha')); ?>" required="" style="width:100%" name="captcha" placeholder="<?php echo app('translator')->getFromJson('auth.captcha'); ?>" minlength="6" maxlength="6" pattern="^[0-9]+$" autocomplete="off">
					<?php if($errors->has('captcha')): ?>
						<p class="helper text-danger"><?php echo e($errors->first('captcha')); ?></p>
					<?php endif; ?>
					<div><img src="<?php echo e(route('captcha')); ?>?e=<?php echo e(time()); ?>"></div>
					<button style="margin-top:8px" type="submit" class="w-100 btn--raised ripple"><?php echo app('translator')->getFromJson('auth.register'); ?></button>
				</form>
				<div style="text-align:center;margin-top:12px">
					<p class="helper" style="display:inline-block"><span><?php echo app('translator')->getFromJson('auth.haveaccount'); ?> <a href="<?php echo e(route('login')); ?>"><span><?php echo app('translator')->getFromJson('auth.login'); ?></span></a></span></p>
				</div>
			</div>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web\huanjing\resources\views/auth/register.blade.php ENDPATH**/ ?>