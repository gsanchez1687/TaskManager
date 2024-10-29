<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>Dashboard</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header">
      <?php echo e(__('Create Task')); ?>

    </div>
    <div>
      <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
      <?php endif; ?>
      <?php if(session('error')): ?>
        <div class="alert alert-danger">
            <?php echo e(session('error')); ?>

        </div>
      <?php endif; ?>
    </div>
    <div class="card-body">
      <form action="<?php echo e(route('store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="form-group row">
          <label for="title" class="col-sm-2 col-form-label"><?php echo e(__('Title')); ?></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="title" id="title"  >
          </div>
        </div>
        <div class="form-group row">
          <label for="description" class="col-sm-2 col-form-label"><?php echo e(__('Description')); ?></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="description" id="description">
          </div>
        </div>

        <div class="form-group row">
          <label for="credit_for_task" class="col-sm-2 col-form-label"><?php echo e(__('Credit Value')); ?></label>
          <div class="col-sm-10">
            <input type="number" class="form-control" name="credit_for_task" id="credit_for_task">
          </div>
        </div>

        <div class="form-group row">
          <label for="expiration_date" class="col-sm-2 col-form-label"><?php echo e(__('Expiration Date')); ?></label>
          <div class="col-sm-10">
            <input type="date" class="form-control" name="expiration_date" id="expiration_date">
          </div>
        </div>
        <a class="btn btn-primary" href="/task/admin"><?php echo e(__('Back')); ?></a>
        <input type="submit" class="btn btn-primary" name="save" value="Save" id="save">
      </form>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/TaskManager/resources/views/task/create.blade.php ENDPATH**/ ?>