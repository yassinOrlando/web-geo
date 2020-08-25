<?php $__env->startSection('title', 'AUTHORS'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container col-md-12">
        <div class="container">
            <div class="row d-flex justify-content-between">
              <?php if(Auth::user()->role == 'admin'): ?>
                <a class="text-white" href="<?php echo e(url('/register')); ?>">
                    <button class="btn btn-primary">  New author </button>
                </a> 
              <?php endif; ?>
                <span> Total admins: (<?php echo e($total_admins); ?>) </span>
                <span> Total authors: (<?php echo e($total_auths); ?>) </span>
    
                <form class="form-inline my-2 my-lg-0 mr-md-2 " action="<?php echo e(route('search_author')); ?>">
                    <?php echo csrf_field(); ?>
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" name="research" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </div>
        
        <div style="overflow: scroll">
            <table class="table col-md-12" style="margin-top: 15px; overflow: scroll">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col" class="col-2">Name</th>
                    <th scope="col" class="col-2">Last name</th>
                    <th scope="col">Role</th>
                    <th scope="col">Email</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Updated at</th>
                    <th scope="col">Actions</th>
                    
                  </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <th scope="row"> <?php echo e($author->id); ?> </th>
                      <td> <?php echo e($author->f_name); ?> </td>
                      <td> <?php echo e($author->last_name); ?> </td>
                      <td> <?php echo e($author->role); ?> </td>
                      <td> <?php echo e($author->email); ?> </td>
                      <td> <?php echo e($author->created_at->format('j F, Y')); ?> </td>
                      <td> <?php echo e($author->updated_at->format('j F, Y')); ?> </td>
                      <td class="d-flex justify-content-around" >
                          <a href="<?php echo e(route('author_edit', ['author_id' => $author->id, 'id' => $author->id ])); ?>" >
                            <button class="btn btn-warning  "> Edit </button>
                          </a>
                          <a href="<?php echo e(route('author_delete', ['auth_id' => $author->id])); ?>"
                            onclick="return confirm('Are you sure you want to delete this user? \n All related posts will be deleted too!')"
                            >
                            <button class="btn btn-danger "> Delete </button>
                          </a>
                      </td>
                    </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
              
        </div>
        <?php echo e($authors->links()); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/my_project/web-geo/resources/views//administration/authors.blade.php ENDPATH**/ ?>