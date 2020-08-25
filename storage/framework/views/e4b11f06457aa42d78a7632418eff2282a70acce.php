<?php $__env->startSection('title', 'NEW POST'); ?>

<?php $__env->startSection('content'); ?>
<form method="POST" action="<?php echo e(route('post_add', ['id' => Auth::user()->id])); ?>" class="col-md-12">
    <?php echo csrf_field(); ?>

    <div class="form-group row d-flex justify-content-around ">
        <input id="user_id" type="text" class="form-control col-md-5" value="<?php echo e(Auth::user()->id); ?>" name="user_id" hidden>
        

        <div class="col-md-2">
            <span class="align-middle">User: <?php echo e(Auth::user()->id); ?></span>
        </div>

        <div class="col-md-4">
            <label for="category_id" class=" col-form-label text-md-left"><?php echo e(__('Category')); ?></label>
            <select name="category_id" id="category_id" class="col-md-8">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>"> <?php echo e($category->name); ?> </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        
        <div class="col-md-3">
            <label for="status" class=" col-form-label text-md-left"><?php echo e(__('Status')); ?></label>
            <select name="status" id="status">
                <option value="draft" selected> Draft </option>
                <option value="published"> Published </option>
            </select>
        </div>
    </div>
    
    <label for="img" class="col-md-2 col-form-label text-md-left"><?php echo e(__('Post image')); ?></label>

    <div class="col-md-12">
        <input id="img" type="text" class="form-control <?php $__errorArgs = ['img'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-valid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('img')); ?>"
            name="img">

        <?php $__errorArgs = ['img'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <span class="invalid-feedback" category_id="alert">
            <strong><?php echo e($message); ?></strong>
        </span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <label for="title" class="col-md-2 col-form-label text-md-left"><?php echo e(__('Title')); ?></label>

    <div class="col-md-12">
        <input id="title" type="text" class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="title"
            value="<?php echo e(old('title')); ?>" autocomplete="title" autofocus>

        <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <span class="invalid-feedback" category_id="alert">
            <strong><?php echo e($message); ?></strong>
        </span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>


    <label for="content" class="col-md-4 col-form-label text-md-left"><?php echo e(__('Content')); ?></label>

    <div class="col-md-12">
        <textarea name="content" id="content" class="col-md-12" cols="30" rows="10"></textarea>
    </div>

    <br>

    <div class="col-md-6">
        <a href="<?php echo e(route('home')); ?>" onclick="return confirm('Your canges are not goin to be saved')">
            <button type="button" class="btn btn-danger" id="back" >
                <?php echo e(__('Cancel')); ?>

            </button>
        </a>

        <button type="submit" class="btn btn-primary">
            <?php echo e(__('Add post')); ?>

        </button>
    </div>
</form>


<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.gen_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/my_project/web-geo/resources/views//administration/forms_add/add_post.blade.php ENDPATH**/ ?>