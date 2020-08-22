<?php $__env->startSection('title', 'PROFILE'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container col-md-6">
        <img src="<?php echo e(Auth::user()->img); ?> " alt="profile" class="rounded mx-auto d-block" style="width: 200px; height: 200px;">
        <div class="md-6">
            <strong> Role: </strong> <?php echo e(Auth::user()->role); ?> 
        </div>
        <div>
            <strong> Name: </strong> <?php echo e(Auth::user()->f_name); ?> 
        </div>
        <div>
            <strong> Last Name: </strong> <?php echo e(Auth::user()->last_name); ?> 
        </div>
        <div>
            <strong> Email: </strong> <?php echo e(Auth::user()->email); ?> 
        </div>
        <div>
            <strong> Joined: </strong> <?php echo e(Auth::user()->created_at); ?> 
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/my_project/web-geo/resources/views//administration/home.blade.php ENDPATH**/ ?>