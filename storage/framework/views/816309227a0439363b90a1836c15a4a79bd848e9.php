<?php $__env->startSection('title', 'PROFILE'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container col-md-6">
        <div class="rounded mx-auto d-block" style="width: 200px; height: 200px;">
            <?php if(Auth::user()->img): ?>
                <img src="<?php echo e(route('get_avatar', ['img' => Auth::user()->img])); ?>" alt="profile_pic" class="rounded mx-auto d-block" style="width: 200px; height: 200px;">
            <?php endif; ?>
        </div>
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
            <strong> Joined: </strong> <?php echo e(Auth::user()->created_at->format('j F, Y')); ?> 
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/my_project/web-geo/resources/views//administration/home.blade.php ENDPATH**/ ?>