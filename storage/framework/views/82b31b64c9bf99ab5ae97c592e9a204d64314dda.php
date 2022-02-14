<?php echo $__env->make('layouts/sidebar1.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layouts/headers.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Tables</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Tables</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Tables</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="#" class="btn btn-sm btn-neutral">New</a>
              <a href="#" class="btn btn-sm btn-neutral">Filters</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Start main Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card"> 
      <!-- Dark table -->
      <div class="row">
        <div class="col">
          <div class="card bg-default shadow">
            <div class="card-header bg-transparent border-0">
              <h3 class="text-white mb-0 list-title">Add Village</h3>
              <a href="addVillage" class="btn btn-success list-addbtn">
                Add Villages
            </a>
          </div>
          <form method="post" action = "<?php echo e(url('add-student')); ?>">
              <?php echo csrf_field(); ?> <!-- This blade directive generates <input type="hidden" name="_token" value="xyz..." /> -->
                <div class="col-md-12 pb-3">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="text" class="form-control" name="villagename" id="villagename" placeholder="Village Name">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <select name="cityname" class="form-control" id="cityname">
                          <option value="">Select City</option>
                          <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      </div>
                    </div>
                  </div>
                <div class="text-center"><input type="submit" name="submit" id="submit" class="btn btn-primary" /></div>
                </div>
               
            </form>
            
          </div>
        </div>
      </div>
    <!-- End main containt -->

    <?php echo $__env->make('layouts/footers.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\wamp64\www\makel-and-company\resources\views/villages/add.blade.php ENDPATH**/ ?>