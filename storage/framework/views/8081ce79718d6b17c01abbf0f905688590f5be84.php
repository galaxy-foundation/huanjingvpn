<?php $__env->startSection('page', __('client.acc-title')); ?>


<?php $__env->startSection('content'); ?>

<h2 class="mt-4"><?php echo app('translator')->getFromJson('client.acc-title'); ?></h2>
<div class="row">
	<div class="col-md-6">
		<form class="mt-5" action="<?php echo e(route('account.passwd')); ?>" method="POST">
			<?php echo csrf_field(); ?>
			<div class="field-row ">
				<div class="label-vertical form-group">
					<label for="passwd" class="control-label requiredField"><?php echo app('translator')->getFromJson('client.acc-oldpasswd'); ?></label>
					<div class="controls controls-vertical">
						<input autocomplete="off" value="<?php echo e(old('passwd')); ?>" required="" class="input-small textinput textInput form-control" id="passwd" name="passwd" placeholder="<?php echo app('translator')->getFromJson('client.acc-oldpasswd'); ?>" minlength="6" maxlength="32" type="password">
					</div>
					<?php if($errors->has('passwd')): ?>
						<p class="helper text-danger"><?php echo e($errors->first('passwd')); ?></p>
					<?php endif; ?>
				</div>
			</div>
			<hr>
			<div class="field-row ">
				<div class="label-vertical form-group">
					<label for="newpasswd" class="control-label requiredField"><?php echo app('translator')->getFromJson('client.acc-newpasswd'); ?></label>
					<div class="controls controls-vertical">
						<input autocomplete="off" value="<?php echo e(old('newpasswd')); ?>" required="" class="input-small textinput textInput form-control" id="newpasswd" name="newpasswd" placeholder="<?php echo app('translator')->getFromJson('client.acc-newpasswd'); ?>" minlength="6" maxlength="32" type="password">
					</div>
					<?php if($errors->has('newpasswd')): ?>
						<p class="helper text-danger"><?php echo e($errors->first('newpasswd')); ?></p>
					<?php endif; ?>
				</div>
			</div>
			<div class="field-row ">
				<div class="label-vertical form-group">
					<label for="confirmpasswd" class="control-label requiredField"><?php echo app('translator')->getFromJson('auth.confirm'); ?></label>
					<div class="controls controls-vertical">
						<input autocomplete="off" value="<?php echo e(old('confirm')); ?>" required="" class="input-small textinput textInput form-control" id="confirmpasswd" name="confirmpasswd" placeholder="<?php echo app('translator')->getFromJson('auth.confirm'); ?>" minlength="6" maxlength="32" type="password" value="">
					</div>
					<?php if($errors->has('confirmpasswd')): ?>
						<p class="helper text-danger"><?php echo e($errors->first('confirmpasswd')); ?></p>
					<?php endif; ?>
				</div>
			</div>
			<button type="submit" class="btn btn-primary"><?php echo app('translator')->getFromJson('app.submit'); ?></button>
		</form>
			
	</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.client', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web\huanjing\resources\views/client/passwd.blade.php ENDPATH**/ ?>