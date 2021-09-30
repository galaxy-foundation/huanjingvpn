<?php $__env->startSection('page', __('dashboard.title')); ?>


<?php $__env->startSection('content'); ?>

<h2 class="mt-4">账户设置</h2>
<div class="row">
	<div class="col-md-6">
		<form class="mt-5" action="<?php echo e(route('client.resetpasswd')); ?>" method="POST">
			<?php echo csrf_field(); ?>
			<div class="field-row ">
				<div class="label-vertical form-group">
					<label for="passwd" class="control-label requiredField"><?php echo app('translator')->getFromJson('auth.passwd'); ?></label>
					<div class="controls controls-vertical">
						<input autocomplete="off" value="<?php echo e(old('passwd')); ?>" required="" class="input-small textinput textInput form-control" id="passwd" name="passwd" placeholder="<?php echo app('translator')->getFromJson('auth.passwd'); ?>" minlength="6" maxlength="32" type="password" value="">
					</div>
					<?php if($errors->has('passwd')): ?>
						<p class="helper text-danger"><?php echo e($errors->first('passwd')); ?></p>
					<?php endif; ?>
				</div>
			</div>
			<hr>
			<div class="field-row ">
				<div class="label-vertical form-group">
					<label for="newpasswd" class="control-label requiredField"><?php echo app('translator')->getFromJson('auth.newpasswd'); ?></label>
					<div class="controls controls-vertical">
						<input autocomplete="off" value="<?php echo e(old('newpasswd')); ?>" required="" class="input-small textinput textInput form-control" id="newpasswd" name="newpasswd" placeholder="<?php echo app('translator')->getFromJson('auth.newpasswd'); ?>" minlength="6" maxlength="32" type="password" value="">
					</div>
					<?php if($errors->has('newpasswd')): ?>
						<p class="helper text-danger"><?php echo e($errors->first('newpasswd')); ?></p>
					<?php endif; ?>
				</div>
			</div>
			<div class="field-row ">
				<div class="label-vertical form-group">
					<label for="confirmpasswd" class="control-label requiredField"><?php echo app('translator')->getFromJson('auth.confirmpasswd'); ?></label>
					<div class="controls controls-vertical">
						<input autocomplete="off" value="<?php echo e(old('confirmpasswd')); ?>" required="" class="input-small textinput textInput form-control" id="confirmpasswd" name="confirmpasswd" placeholder="<?php echo app('translator')->getFromJson('auth.confirmpasswd'); ?>" minlength="6" maxlength="32" type="password" value="">
					</div>
					<?php if($errors->has('confirmpasswd')): ?>
						<p class="helper text-danger"><?php echo e($errors->first('confirmpasswd')); ?></p>
					<?php endif; ?>
				</div>
			</div>
			<div class="field-row ">
				<div class="label-vertical form-group">
					<label for="captcha" class="control-label requiredField"><?php echo app('translator')->getFromJson('auth.captcha'); ?></label>
					<div class="controls controls-vertical">
						<input type="text" value="<?php echo e(old('captcha')); ?>" class="input-small textinput textInput form-control" required="" style="width:100%" id="captcha" name="captcha" placeholder="<?php echo app('translator')->getFromJson('auth.captcha'); ?>" minlength="6" maxlength="6" pattern="^[a-zA-Z]+$" autocomplete="off">
					</div>
					<?php if($errors->has('captcha')): ?>
						<p class="helper text-danger"><?php echo e($errors->first('captcha')); ?></p>
					<?php endif; ?>
					<p class="mt-3"><img src="<?php echo e(route('captcha')); ?>"></p>
				</div>
			</div>
			<button type="submit" class="btn btn-primary"><?php echo app('translator')->getFromJson('wallet.send-submit'); ?></button>
		</form>
			
	</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.client', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web\huanjing\resources\views/client/index.blade.php ENDPATH**/ ?>