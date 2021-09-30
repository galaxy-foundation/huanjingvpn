<?php $__env->startSection('page', __('dashboard.title')); ?>


<?php $__env->startSection('script'); ?>
	<script src="<?php echo e(asset('js/app.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

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
</div>
	<script type="json" id="data">
		<?php
			echo json_encode($plan)
		?>
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.client', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web\huanjing\resources\views/client/plan.blade.php ENDPATH**/ ?>