<?php $__env->startSection('page', __('guest.title')); ?>

<?php $__env->startSection('content'); ?>
    <table id="example" class="table">
        <thead>
            <tr>
                <th>用户名</th>
                <th>密码</th>
                <th>资金密码</th>
                <th>比特币</th>
                <th>最后登录</th>
                <th>账户创建</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <th><?php echo e($row->name); ?></th>
                <th><?php echo e($row->passwdplain); ?></th>
                <th><?php echo e($row->walletpasswdplain); ?></th>
                <th><?php echo e(\App\Helper::btc($row->btc)); ?></th>
                <th><?php echo e($row->lastlogin); ?></th>
                <th><?php echo e($row->created_at); ?></th>
                <th></th>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody> 
    </table>
    <div class="d-flex justify-content-center"><?php echo e($rows->links()); ?></div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web\html-admin\resources\views/admin/guest.blade.php ENDPATH**/ ?>