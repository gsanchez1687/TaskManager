<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1><?php echo e(__('Change Password')); ?></h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header">
      <?php echo e(__('Change Password')); ?>

    </div>
    <div class="card-body">
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
        <form action="<?php echo e(route('changePasswordStore')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">Change Password</label>
                <div class="col-sm-10">
                  <input type="password" required class="form-control" id="password" name="password">
                </div>
              </div>

              <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">Confirm Password</label>
                <div class="col-sm-10">
                  <input type="password" required class="form-control" id="confirmPassword" name="confirmPassword">
                </div>
              </div>
              <a href="/task/admin" class="btn btn-primary" role="button"><?php echo e(__('Back')); ?></a>
            <button type="submit" class="btn btn-primary">Change</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/TaskManager/resources/views/user/changePassword.blade.php ENDPATH**/ ?>