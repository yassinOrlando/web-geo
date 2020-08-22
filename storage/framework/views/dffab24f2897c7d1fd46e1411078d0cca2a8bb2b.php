<?php $__env->startSection('title', 'COUNTRIES'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container col-md-12">
        <div class="container">
            <div class="row d-flex justify-content-between">
                <button class="btn btn-primary">  New country </button>

                <span> Total countries: (5) </span>
    
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
                    <th scope="col">Id</th>
                    <th scope="col" class="col-2">Name</th>
                    <th scope="col">Actions</th>
                    
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">3</th>
                    <td> MX </td>
                    <td> México </td>
                    <td class="d-flex justify-content-around" >
                        <button class="btn btn-warning col-sm-12 col-md-5"> Edit </button>
                        <button class="btn btn-danger col-sm-12 col-md-5"> Delete </button>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td> UK </td>
                    <td> United Kingdom </td>
                    <td class="d-flex justify-content-around" >
                        <button class="btn btn-warning col-sm-12 col-md-5"> Edit </button>
                        <button class="btn btn-danger col-sm-12 col-md-5"> Delete </button>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td> CN </td>
                    <td> China </td>
                    <td class="d-flex justify-content-around" >
                        <button class="btn btn-warning col-sm-12 col-md-5"> Edit </button>
                        <button class="btn btn-danger col-sm-12 col-md-5"> Delete </button>
                    </td>
                  </tr>
                </tbody>
              </table>
        </div>
        
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/my_project/web-geo/resources/views//administration/countries.blade.php ENDPATH**/ ?>