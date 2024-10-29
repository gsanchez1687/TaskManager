<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1><?php echo e(__('Admin Users')); ?></h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<?php if( Auth::user()->hasRole('Admin')): ?>

<div class="card">
  <div class="card-header">
    <?php echo e(__('Admin Users')); ?>

  </div>
  
  <div class="card-body">
        <table class="table table-striped table-bordered">
          <thead>
              <th>ID</th>
              <th>name</th>
              <th>email</th>
              <th>Google</th>
              <th>Rol</th>
              <th>Created</th>
              <th>Actions</th>
          </thead>
          <tbody></tbody>
              <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($item->id); ?></td>
                    <td><?php echo e($item->name); ?></td>
                    <td><?php echo e($item->email); ?></td>
                    <td><?php echo e($item->google_id ? 'Yes' : 'No'); ?></td>
                    <td><?php echo e($item->getRoleNames()->implode(', ')); ?></td>
                    <td><?php echo e($item->created_at); ?></td>
                    <td>
                        <a href="<?php echo e(route('update', $item->id)); ?>" class="btn btn-primary btn-block" href="">Update</a>
                    </td>
                  </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
        <div class="mt-3">
          <?php echo e($users->links()); ?>

        </div>
  </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/TaskManager/resources/views/user/admin.blade.php ENDPATH**/ ?>