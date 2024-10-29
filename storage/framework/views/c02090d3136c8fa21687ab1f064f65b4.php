<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1><?php echo e(__('View Task')); ?> - <?php echo e($task->title); ?> </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header">
      <?php echo e(__('Detail Task')); ?>

    </div>
    <div class="card-body">
          <table class="table">
            <tr>
              <td>ID</td>
              <td><?php echo e($task->id); ?></td>
            </tr>
            <tr>
              <td><?php echo e(__('Title:')); ?></td>
              <td><?php echo e($task->title); ?></td>
            </tr>
            <tr>
              <td><?php echo e(__('Description:')); ?></td>
              <td><?php echo e($task->description); ?></td>
            </tr>
            <tr>
              <td><?php echo e(__('Credit Value:')); ?></td>
              <td><?php echo e($task->credit_for_task); ?></td>
            </tr>
            <tr>
              <td><?php echo e(__('Expedition Date:')); ?></td>
              <td><?php echo e($task->expiration_date); ?></td>
            </tr>
            <tr>
              <td><?php echo e(__('Days Left:')); ?></td>
              <td><?php echo e(Helpers::getHoursPassed($task->hours_passed, ['format' => 'full','locale'=>'en'])); ?></td>
            </tr>
            <tr>
              <td><?php echo e(__('Status:')); ?></td>
              <td class="<?php echo e($task->statu->style); ?>"><?php echo e($task->statu->name); ?></td>
            </tr>
          </table>
          <div>
            <a class="btn btn-primary" href="/task/admin"><?php echo e(__('Back')); ?></a>
          </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/TaskManager/resources/views/task/view.blade.php ENDPATH**/ ?>