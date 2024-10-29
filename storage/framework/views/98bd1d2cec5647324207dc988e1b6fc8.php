<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1><?php echo e(__('Update User')); ?> - <?php echo e($user->name); ?> </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header">
      <?php echo e(__('Update User')); ?>

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
        <form action="<?php echo e(route('updatestore', $user->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
          <table class="table">
            <tr>
                <td><?php echo e(__('Name:')); ?></td>  
                <td><input type="text" class="form-control" name="name" id="name" value="<?php echo e($user->name); ?>"></td>
            </tr>
            <tr>
                <td><?php echo e(__('Email:')); ?></td> 
                <td><input type="text" class="form-control" name="email" id="email" value="<?php echo e($user->email); ?>"></td>
            </tr>
            <tr>
                <td><?php echo e(__('Password:')); ?></td>
                <td><input type="password" class="form-control" name="password" id="password"></td>
            </tr>
            </form>
          </table>
          <input type="hidden" name="id" value="<?php echo e($user->id); ?>">
          <a href="/user/admin"><input type="button" class="btn btn-primary" value="Back"></a>
          <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/TaskManager/resources/views/user/update.blade.php ENDPATH**/ ?>