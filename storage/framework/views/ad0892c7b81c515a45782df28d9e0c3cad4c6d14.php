<?php $__env->startSection('page', __('client.inv-title')); ?>


<?php $__env->startSection('script'); ?>
	<script src="<?php echo e(asset('js/jquery.qrcode.js')); ?>"></script>
	<script src="<?php echo e(asset('js/deposit.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<h3><?php echo app('translator')->getFromJson('client.inv-title'); ?></h3>
<table class="table">
	<thead>
		<tr>
			<th class="text-center"></th>
			<th class="text-center"><?php echo app('translator')->getFromJson('client.inv-header-date'); ?></th>
			<th class="text-center"><?php echo app('translator')->getFromJson('client.inv-header-amount'); ?></th>
			<th class="text-center"><?php echo app('translator')->getFromJson('client.inv-header-desc'); ?></th>
			<th class="text-center"><?php echo app('translator')->getFromJson('client.inv-header-status'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td class="text-center">#<?php echo e($r->id); ?></td>
				<td class="text-center"><?php echo e($r->updated_at); ?></td>
				<td class="text-center"><?php echo e($r->price); ?>$ (<?php echo e(App\Helper::btc($r->btc)); ?>$)</td>
				<td class="text-center"><?php echo e($r->note); ?></td>
				<td class="text-center"><?php echo e(App\Orders::status($r->status)); ?></td>
			</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</tbody>
</table>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.client', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web\huanjing\resources\views/client/invoice.blade.php ENDPATH**/ ?>