<?php $__env->startSection('content'); ?>
<div class="container col-md-12">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card bg-warning">
                <div class="card-header text-center"><b><?php echo e(__('Dashboard')); ?></b></div>
                
            </div>
        </div>
    </div>

    <div class="row justify-content-center" >
        <div class="col-md-2" style="margin-top: 20px">
            <div class="card text-white bg-secondary">
                <div class="card-header text-center"><?php echo e(__('OPTIONS')); ?></div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item bg-secondary">Posts</li>
                    <li class="list-group-item bg-secondary">Categories</li>
                    <li class="list-group-item bg-secondary">Authors</li>
                    <li class="list-group-item bg-secondary">Countries</li>
                </ul>
            </div>
        </div>

        <div class="col-md-10" style="margin-top: 20px">
            <div class="card">
                <div class="card-header text-center"><?php echo e(__('CHOSED OPTION')); ?></div>
                <div class="card-body">
                    <?php echo e(__('Option 1')); ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/my_project/web-geo/resources/views//administration/home.blade.php ENDPATH**/ ?>