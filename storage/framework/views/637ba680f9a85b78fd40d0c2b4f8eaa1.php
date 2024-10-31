<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1><?php echo e(__('Update Task')); ?> - <?php echo e($task->title); ?> </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header">
      <?php echo e(__('Update Task')); ?>

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
          <table class="table">
            <form action="<?php echo e(route('updateStore', $task->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <tr>
              <td>ID</td>
              <td><?php echo e($task->id); ?></td>
            </tr>
            <tr>
              <td><?php echo e(__('Title:')); ?></td>
              <td><input type="text" class="form-control" name="title" id="title" value="<?php echo e($task->title); ?>"></td>
            </tr>
            <tr>
              <td><?php echo e(__('Description:')); ?></td>
              <td><input type="text" class="form-control" name="description" id="description" value="<?php echo e($task->description); ?>"></td>
            </tr>
            <tr>
              <td><?php echo e(__('Expedition Date:')); ?></td>
              <td><input type="date" class="form-control" name="expiration_date" id="expiration_date" value="<?php echo e($task->expiration_date); ?>"></td>
            </tr>
            <tr>
              <td><?php echo e(__('Status to change:')); ?></td>
              <td>
                  <select class="form-control" name="status" id="status">
                      <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option <?php echo e($task->statu_id == $item->id ? 'selected' : ''); ?> value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
              </td>
          </tr>
            <tr>
              <td><?php echo e(__('Credit value:')); ?></td>
              <?php if( Auth::user()->hasRole('Admin')): ?>
                <td><input type="number" class="form-control" name="credit_for_task" id="credit_for_task" value="<?php echo e($task->credit_for_task); ?>"></td>
              <?php else: ?>
                <td><?php echo e($task->credit_for_task); ?></td>
              <?php endif; ?>
            </tr>
          <?php if( Auth::user()->hasRole('Admin')): ?>
            <tr>
              <td><?php echo e(__('Select Daughter:')); ?></td>
              <td>
                <select class="form-control" name="nonAdminUsers" id="nonAdminUsers">
                    <option value="0">Select daughter...</option>
                    <?php $__currentLoopData = $nonAdminUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option <?php echo e(Helpers::getAssignedTaskById($task->id) == $item->id ? 'selected' : ''); ?> value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </td>
            </tr>
            <tr>
              <td><?php echo e(__('Credit Paid:')); ?></td>
              <td>
                <select class="form-control" name="credit_paid" id="credit_paid">
                    <option <?php echo e($task->credit_paid == 0 ? 'selected' : ''); ?> value="0">No Paid</option>
                    <option <?php echo e($task->credit_paid == 1 ? 'selected' : ''); ?> value="1">Yes Paid</option>
                </select>
              </td>
            </tr>
          <?php endif; ?>
            <tr>
              <td><?php echo e(__('Days Left:')); ?></td>
              <td><?php echo e(Helpers::getHoursPassed($task->hours_passed, ['format' => 'full','locale'=>'en'])); ?></td>
            </tr>
            <tr>
              <td><?php echo e(__('Current status:')); ?></td>
              <td class="<?php echo e($task->statu->style); ?>"><?php echo e($task->statu->name); ?></td>
            </tr>
            <tr>
                <td>
                  <a class="btn btn-primary" href="/task/admin"><?php echo e(__('Back')); ?></a>
                  <button type="submit" class="btn btn-primary">Update</button>
                </td>
            </tr>
            </form>
          </table>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/TaskManager/resources/views/task/update.blade.php ENDPATH**/ ?>