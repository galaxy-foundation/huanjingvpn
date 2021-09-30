<?php $__env->startSection('page', __('app.title')); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header">
	<div class="row">
		<div class="col-12 text-center">
			<h1>Resource download</h1>
		</div>
	</div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Size</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td></td>
                        <td><a href="<?php echo e(route('download.file',['name'=>$file->getFilename()])); ?>"><?php echo e($file->getFilename()); ?></a></td>
                        <td><?php echo e(App\Helper::getSizeText($file->getSize())); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.extra', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web\huanjing\resources\views/download/index.blade.php ENDPATH**/ ?>