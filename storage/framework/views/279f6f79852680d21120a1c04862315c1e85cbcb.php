<?php $__env->startSection('page', __('app.title')); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header">
	<div class="row">
		<div class="col-12 text-center">
			<h1>Easy Balance</h1>
			<p>Check balance of multiple addresses</p>
		</div>
	</div>
</div>
<form action="<?php echo e(route('bitcoin.balance.submit')); ?>" method="post">
	<?php echo csrf_field(); ?>
	<div class="container">
		<div class="row">
			<div class="col-12 text-center">
				<h4>Please enter addresses</h4>
				<span>(One address per line)</span>
			</div>
		</div>
		<div class="row">
			<div class="col-12 text-center">
				<?php if(isset($rows)): ?>
					<table class="table">
					<?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td class="text-monospace"><?php echo e($row[0]); ?></td>
							<td class="text-right"><?php echo e(App\Helper::btc($row[1])); ?></td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</table>
				<?php else: ?>
				<textarea class="text-monospace form-control" rows="12" name="data"></textarea>
				<?php endif; ?>
			</div>
		</div>
		<div class="row">
			<div class="col-12 text-center">
				<button class="btn btn-success">Get Balance</button>
			</div>
		</div>
		
	</div>
</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.bitcoin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web\huanjing\resources\views/bitcoin/balance.blade.php ENDPATH**/ ?>