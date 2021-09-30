
<p>Users: <?php echo e($users['count']); ?> balance: <?php echo e(\App\Helper::btc($users['balance'],1).'BTC'); ?></p>
<p>Sessions: <?php echo e($sessions['count']); ?> Signed: <?php echo e(\App\Helper::btc($sessions['signed'],1)); ?></p>
<p>Wallets: <?php echo e($wallets['count']); ?></p><?php /**PATH D:\web\html-admin\resources\views/admin/statistics.blade.php ENDPATH**/ ?>