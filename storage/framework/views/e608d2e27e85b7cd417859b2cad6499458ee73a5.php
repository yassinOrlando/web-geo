<?php $__env->startSection('title', 'POSTS'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container col-md-12">
        <div class="container">
          <div class="row d-flex justify-content-between">
            <a href="<?php echo e(route('post_form_create', ['id' => Auth::user()->id])); ?>">
              <button class="btn btn-primary "> New post </button>
            </a>
    
            <span class="align-baseline "> Total posts: (<?php echo e($total_posts); ?>) </span>
    
            <form class="form-inline my-2 my-lg-0 mr-md-2 ">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
          </div>
        </div>
        
        <div style="overflow: scroll">
            <table class="table col-md-12" style="margin-top: 15px; overflow: scroll">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col" class="col-3">Title</th>
                    <th scope="col">Status</th>
                    <th scope="col">Category</th>
                    <th scope="col">Author</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Updated at</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <th scope="row"> <?php echo e($post->id); ?> </th>
                      <td> <?php echo e($post->title); ?> </td>
                      <td> <?php echo e($post->status); ?> </td>
                      <td> <?php echo e($post->category->name); ?> </td>
                      <td> <?php echo e($post->user->f_name); ?> </td>
                      <td> <?php echo e($post->created_at->format('j F, Y')); ?> </td>
                      <td> <?php echo e($post->updated_at->format('j F, Y')); ?> </td>
                      <td class="d-flex justify-content-around" >
                        
                          <button class="btn btn-warning  "> Edit </button>
                        
                        <a href="<?php echo e(route('post_delete', ['post_id' => $post->id ])); ?>" onclick="return confirm('Are you sure you want to delete this post?')">
                          <button class="btn btn-danger "> Delete </button>
                        </a>
                      </td>
                    </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
              
        </div>
        <?php echo e($posts->links()); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/my_project/web-geo/resources/views//administration/posts.blade.php ENDPATH**/ ?>