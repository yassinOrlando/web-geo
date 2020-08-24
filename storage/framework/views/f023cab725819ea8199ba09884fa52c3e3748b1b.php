<?php $__env->startSection('title', 'CATEGORIES'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container col-md-12">
        <div class="container">
            <div class="row d-flex justify-content-between">
                <span> Total categories: (<?php echo e($total_cats); ?>) </span>

                <form class="form-inline my-2 my-lg-0 mr-md-2 " action=" <?php echo e(route('categories_add', ['id' => Auth::user()->id])); ?> " method="POST">
                  <?php echo csrf_field(); ?>
                  <label for="name" class="mr-sm-2"> New category: </label>
                  <input name="name" class="form-control mr-sm-2" type="text" placeholder="Category name" aria-label="Search">
                  <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"> Add </button>
                </form>
    
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
                    <th scope="col">Created at</th>
                    <th scope="col">Updated at</th>
                    <th scope="col">Actions</th>
                    
                  </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <th scope="row"> <?php echo e($category->id); ?> </th>
                      <td> <?php echo e($category->name); ?> </td>
                      <td> <?php echo e($category->created_at->format('j F, Y')); ?> </td>
                      <td> <?php echo e($category->updated_at->format('j F, Y')); ?> </td>
                      <td class="d-flex justify-content-around" >
                          <a href="<?php echo e(route('cat_edit', ['cat_id' => $category->id, 'id' => $category->id ])); ?>" >
                            <button class="btn btn-warning  "> Edit </button>
                          </a>
                          <a href="<?php echo e(route('category_delete', ['cat_id' => $category->id])); ?>" 
                            class="col-sm-12 col-md-5"
                            onclick="
                            return confirm('Are you sure you want to delete this category? All the related post will be deleted too!')
                            ">
                            <button class="btn btn-danger "> Delete </button>
                          </a>
                      </td>
                    </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
              
        </div>
        <?php echo e($categories->links()); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/my_project/web-geo/resources/views//administration/categories.blade.php ENDPATH**/ ?>