<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1><?php echo e(__('Admin Daughter')); ?></h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<?php if( Auth::user()->hasRole('Admin')): ?>

<div class="card">
  <div class="card-header">
    <?php echo e(__('Admin Daughter')); ?>

  </div>

  <div class="card-body">
    <div class="mb-3">
      <a href="<?php echo e(route('user.create')); ?>" class="btn btn-primary"><?php echo e(__('New user son')); ?></a>
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
        <table id="users-table" class="table table-striped table-bordered">
          <thead>
              <th>ID</th>
              <th>name</th>
              <th>email</th>
              <th>Type</th>
              <th>Credits</th>
              <th>Google</th>
              <th>Rol</th>
              <th>Created</th>
              <th>Updated</th>
              <th>Actions</th>
          </thead>
          <tbody>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($item->id); ?></td>
                    <td><?php echo e($item->name); ?></td>
                    <td><?php echo e($item->email); ?></td>
                    <td><?php echo e($item->type->name); ?></td>
                    <td><?php echo e(Helpers::getCreditByUser($item->id)); ?></td>
                    <td><?php echo e($item->google_id ? 'Yes' : 'No'); ?></td>
                    <td><?php echo e($item->getRoleNames()->implode(', ')); ?></td>
                    <td><?php echo e($item->created_at); ?></td>
                    <td><?php echo e($item->updated_at); ?></td>
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

<?php $__env->startSection('css'); ?>
  <link href="https://cdn.datatables.net/v/bs5/dt-2.1.8/datatables.min.css" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
  <script src="https://cdn.datatables.net/v/bs5/dt-2.1.8/datatables.min.js"></script>
  <script>
    
    $(document).ready( function () {
      $('#users-table').DataTable({
         paging: false
      });
    } );
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/TaskManager/resources/views/user/admin.blade.php ENDPATH**/ ?>