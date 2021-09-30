<?php $__env->startSection('page', __('wallet.title')); ?>

<?php $__env->startSection('content'); ?>
    <table id="example" class="table">
        <thead>
            <tr>
                <th></th>
                <th>地址</th>
                <th>交易ID</th>
                <th>金额</th>
                <th>用户名</th>
                <th>状态</th>
                <th>时间</th>
            </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <th><?php echo e(\App\Helper::decrypt($row->address)); ?></th>
                <th><?php echo e($row->tx); ?></th>
                <th><?php echo e(\App\Helper::btc($row->value)); ?></th>
                <th><?php echo e($row->user); ?></th>
                <th><?php echo e($row->status); ?></th>
                <th><?php echo e($row->updated_at); ?></th>
                <th></th>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody> 
    </table>
    <div class="d-flex justify-content-center"><?php echo e($rows->links()); ?></div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web\html-admin\resources\views/admin/wallet.blade.php ENDPATH**/ ?>