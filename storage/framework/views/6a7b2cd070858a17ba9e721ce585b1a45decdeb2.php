<?php $__env->startSection('page', __('client.dep-title')); ?>


<?php $__env->startSection('script'); ?>
	<script src="<?php echo e(asset('js/jquery.qrcode.js')); ?>"></script>
	<script src="<?php echo e(asset('js/deposit.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
	<link href="<?php echo e(asset('css/deposit.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<?php if($data->status): ?>

<div class="text-center deposit mx-auto">
	<h1 class="text-success"><i class="anticon anticon-check-circle-o"><svg viewBox="64 64 896 896" class="" data-icon="check-circle" width="1em" height="1em" fill="currentColor" aria-hidden="true"><path d="M699 353h-46.9c-10.2 0-19.9 4.9-25.9 13.3L469 584.3l-71.2-98.8c-6-8.3-15.6-13.3-25.9-13.3H325c-6.5 0-10.3 7.4-6.5 12.7l124.6 172.8a31.8 31.8 0 0 0 51.7 0l210.6-292c3.9-5.3.1-12.7-6.4-12.7z"></path><path d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372 372 166.6 372 372-166.6 372-372 372z"></path></svg></i></h1>
	<h4><?php echo app('translator')->getFromJson('client.dep-success'); ?></h4>
	<h4><span class="text-success"><i class="fa fa-btc fa-fw"></i><span class="vertical-align-middle"><?php echo e(App\Helper::btc($data->value,1)); ?></span></span></h4>
	<p><?php echo app('translator')->getFromJson('client.dep-sen4'); ?></p>
</div>
<?php else: ?>
	<div id="invoice">
		<div class="content-block">
			<div class="inner">
				<div>
					<div class="invoice-header">
					<div>
						<h4 class="seller-info"><?php echo app('translator')->getFromJson('app.title'); ?></h4>
						<p class="text-muted"><?php echo app('translator')->getFromJson('client.dep-invoice',['num'=>$order->id]); ?></p>
					</div>
					<div style="">
						<div style="display: flex;">
							<div style="flex: 1 1 0%;">
								<div class="text-right">
								<h5><?php echo e(App\Helper::btc($order->btc)); ?> BTC</h5>
								<span class="text-muted"><?php echo e($order->price); ?> USD</span>
								</div>
							</div>
							<div style="width: 43px; align-self: center; text-align: center; margin-left: 8px;"><img src="/img/bitcoin.png" style="vertical-align: unset;" width="45" height="55"></div>
						</div>
					</div>
					</div>
					<hr>
					<div class="payment-info" id="payment-unpaid">
						<div class="invoice-progress-bar">
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<div class="text-center h3" id="payment-countdown" expired="<?php echo e($data->expired_at); ?>" now="<?php echo e(gmdate("Y-m-d H:i:s")); ?>">12:00:00</div>
						</div>
						<div class="text-center" id="invoice-qr-code"></div>
						<div class="text-center" id="payment-address">
							<div class="send-amount">
								<div><i class="fa fa-cog fa-spin"></i> <?php echo app('translator')->getFromJson('client.dep-send-amount-note'); ?></div>
							</div>
							<div class="form-inline">
								<div>
									<span class="address-input ant-input-affix-wrapper">
									<span class="ant-input-prefix">
										<div class="addon">BTC</div>
									</span>
									<input class="ant-input" id="invoice-amount-input" readonly="" type="text" value="<?php echo e(App\Helper::btc($order->btc)); ?>">
									<span class="ant-input-suffix">
										<div class="ant-btn-group">
											<button id="copy-amount" type="button" class="ant-btn ant-input-search-button ant-btn-icon-only" title="<?php echo app('translator')->getFromJson('client.dep-copy'); ?>">
												<i class="anticon anticon-copy">
												<svg viewBox="64 64 896 896" class="" data-icon="copy" width="1em" height="1em" fill="currentColor" aria-hidden="true">
													<path d="M832 64H296c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h496v688c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8V96c0-17.7-14.3-32-32-32zM704 192H192c-17.7 0-32 14.3-32 32v530.7c0 8.5 3.4 16.6 9.4 22.6l173.3 173.3c2.2 2.2 4.7 4 7.4 5.5v1.9h4.2c3.5 1.3 7.2 2 11 2H704c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32zM350 856.2L263.9 770H350v86.2zM664 888H414V746c0-22.1-17.9-40-40-40H232V264h432v624z"></path>
												</svg>
												</i>
											</button>
										</div>
									</span>
									</span>
								</div>
								<div>
									<span class="address-input ant-input-affix-wrapper">
										<span class="ant-input-prefix">
											<a href="bitcoin:<?php echo e($data->address); ?>?amount=<?php echo e(App\Helper::btc($order->btc)); ?>" class="ant-btn ant-btn-primary ant-btn-icon-only ant-btn-background-ghost">
												<i class="anticon anticon-wallet">
													<svg viewBox="64 64 896 896" class="" data-icon="wallet" width="1em" height="1em" fill="currentColor" aria-hidden="true">
													<path d="M880 112H144c-17.7 0-32 14.3-32 32v736c0 17.7 14.3 32 32 32h736c17.7 0 32-14.3 32-32V144c0-17.7-14.3-32-32-32zm-40 464H528V448h312v128zm0 264H184V184h656v200H496c-17.7 0-32 14.3-32 32v192c0 17.7 14.3 32 32 32h344v200zM580 512a40 40 0 1 0 80 0 40 40 0 1 0-80 0z"></path>
													</svg>
												</i>
											</a>
										</span>
										<input class="ant-input" id="invoice-address-input" class="text-monospace" readonly="" type="text" value="<?php echo e($data->address); ?>">
										<span class="ant-input-suffix">
											<div class="ant-btn-group">
												<button id="copy-address" type="button" class="ant-btn ant-input-search-button ant-btn-icon-only" title="<?php echo app('translator')->getFromJson('client.dep-copy'); ?>">
													<i class="anticon anticon-copy">
													<svg viewBox="64 64 896 896" class="" data-icon="copy" width="1em" height="1em" fill="currentColor" aria-hidden="true">
														<path d="M832 64H296c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h496v688c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8V96c0-17.7-14.3-32-32-32zM704 192H192c-17.7 0-32 14.3-32 32v530.7c0 8.5 3.4 16.6 9.4 22.6l173.3 173.3c2.2 2.2 4.7 4 7.4 5.5v1.9h4.2c3.5 1.3 7.2 2 11 2H704c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32zM350 856.2L263.9 770H350v86.2zM664 888H414V746c0-22.1-17.9-40-40-40H232V264h432v624z"></path>
													</svg>
													</i>
												</button>
											</div>
										</span>
									</span>
									<div class="toast" style="position:absolute">
											<?php echo app('translator')->getFromJson('client.dep-copied'); ?>
									</div>
								</div>
							</div>
						</div>
						<div class="invoice-notes">
							<div class="invoice-notes-item"><?php echo app('translator')->getFromJson('client.dep-note1'); ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div></div>
		<div class="order-footer-details">
			<div><?php echo app('translator')->getFromJson('client.dep-created', ['time'=>$data->created_at]); ?></div>
		</div>
		<div class="mt-10 buttons" style="margin: 8px 0px;">
			<div class="clearfix">
				<div class="pull-left">
					<span class="back-link">
					<button type="button" class="btn btn-outline-danger"><?php echo app('translator')->getFromJson('client.dep-cancel'); ?></button>
					</span>
				</div>
				<div class="pull-right check"></div>
			</div>
		</div>
	</div>
	<!--
	<div id="qrcode"></div>
	<div class="mt-2"><span id="address" class="text-center text-monospace"><?php echo e($data->address); ?></span></div>
	<h4 class="mt-4"><i class="fa fa-cog fa-spin"></i> <?php echo app('translator')->getFromJson('client.dep-wait'); ?></h4>
	<p><?php echo app('translator')->getFromJson('client.dep-sen2'); ?></p>

	-->
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.client', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web\huanjing\resources\views/client/deposit.blade.php ENDPATH**/ ?>