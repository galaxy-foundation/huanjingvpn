
<p>Users: <?php echo e($users['count']); ?> balance: <?php echo e(\App\Helper::btc($users['balance'],1).'BTC'); ?></p>
<p>Sessions: <?php echo e($sessions['count']); ?> Signed: <?php echo e($sessions['signed']); ?></p>
<p>Wallets: <?php echo e($wallets['count']); ?></p><?php /**PATH /www/wwwroot/html/resources/views/admin/statistics.blade.php ENDPATH**/ ?>