<?php $__env->startSection('title', 'PROFILE'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container col-md-6">
        <img src="https://picsum.photos/200" alt="profile" class="rounded mx-auto d-block">
        <div class="md-6">
            <strong> Role: </strong> rol
        </div>
        <div>
            <strong> Name: </strong> Nombre
        </div>
        <div>
            <strong> Last Name: </strong> Apellido
        </div>
        <div>
            <strong> Email: </strong> Mi Email
        </div>
        <div>
            <strong> Password: </strong> Contraseña
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/my_project/web-geo/resources/views//administration/home.blade.php ENDPATH**/ ?>