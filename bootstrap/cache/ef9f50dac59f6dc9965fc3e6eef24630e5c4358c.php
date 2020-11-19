<?php $__env->startSection('title','Category'); ?>
<?php $__env->startSection('content'); ?>
<style>
  .pagination li {
    border: 1px solid #eee;
    width: 30px;
    height: 30px;
  }
</style>
<div class="container-fluid my-5">
  <div class="row g-0">
    <div class="col-md-4 mb-3">
      <?php echo $__env->make('layouts.admin_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <div class="col">
      <div class="container">
        <form action="<?php echo e(url('/admin/category/create')); ?>" method="post">
          <?php if(App\Classes\Session::has('delete_success')): ?>
          <div class="alert alert-success">
            <?php echo e(App\Classes\Session::flash("delete_success")); ?>

          </div>
          <?php endif; ?>
          <?php echo $__env->make('layouts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <input type="hidden" name="_token" value="<?php echo e(csrf_field()); ?>">
          <div class="form-group">
            <label>Categroy Name</label>
            <input type="text" class="form-control mt-3" name="name" placeholder="Type Category Name">
          </div>
          <div class="form-group">
            <div class="form-control border-0">
              <input type="submit" value="Create" class="btn btn-outline-success float-right">
            </div>
          </div>

        </form>
        <ul class="list-group my-5">
          <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li class="list-group-item">
            <?php echo e($cat->name); ?>

            <!-- Edit and Delete Button Of Cat -->
            <a href="<?php echo url('/admin/category/'.$cat->id.'/delete'); ?>" class="btn btn-danger btn-sm float-right ml-3">Delete</a>
            <button class="btn btn-sm btn-info float-right" data-toggle="modal"
            data-target="#editCat" onclick="putData('<?php echo e($cat->name); ?>','<?php echo e($cat->id); ?>')">
              Edit
            </button>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
          <div class="text-center">
            <?php echo $pages; ?>

          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Start -->
  <!-- Modal -->
  <div class="modal fade" id="editCat" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                    <p id="errors"></p>
          <form id="edit-form">
            <label>Enter Name</label>
            <input class="form-control form-control-sm" type="text" id="edit-name">
            <input class="form-control form-control-sm" type="hidden" id="edit-token" value="<?php echo e(csrf_field()); ?>">
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal End -->
  <?php $__env->stopSection(); ?>
  <?php $__env->startSection("scripts"); ?>
  <script>
  let catName =  document.querySelector("#edit-name");
  // Edit Id
  let edit_id = "";
  function putData(name,id){
    catName.value = name;
    edit_id = id;
  }
  // Get Form Data
  let form = document.querySelector("#edit-form");
  form.addEventListener("submit",function(e){
    e.preventDefault();
    let edit_token = document.querySelector("#edit-token").value;
    let edit_value = document.querySelector("#edit-name").value;
    let editData = new FormData();
    editData.append("edit_id",edit_id);
    editData.append("name",edit_value);
    editData.append("edit_token",edit_token);
    axios.post("<?php echo e(URL_ROOT); ?>"+"/admin/category/"+edit_id+"/update",editData)
    .then(function(res){
      if(res.data){
      let shoErr = document.querySelector("#errors");
      shoErr.innerHTML = `
      <div class="alert alert-danger">
      ${res.data.name}
      </div>
      `;
      }else{
        window.location.href = "http://localhost:8080/E-Commerence/public/admin/category/create";
      }
    })

  })
  </script>
      <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /storage/emulated/0/htdocs/E-Commerence/resources/views/admin/category/create.blade.php ENDPATH**/ ?>