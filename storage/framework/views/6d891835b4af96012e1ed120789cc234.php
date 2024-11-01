<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1><?php echo e(__('Admin Task')); ?></h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<?php if( Auth::user()->hasRole('Admin')): ?>

<div class="card">
  <div class="card-header">
    <?php echo e(__('My Tasks Admin')); ?>

  </div>
  
  <div class="card-body">
        <div class="mb-3">
          <a class="btn btn-primary" href="<?php echo e(route('create')); ?>"><?php echo e(__('Add Task')); ?></a>
          
          <a class="btn btn-primary" href="/user/admin"><?php echo e(__('Admin users')); ?></a>
        </div>
        <table class="table table-striped table-bordered">
          <thead>
              <th>ID</th>
              <th>Title</th>
              <th>Description</th>
              <th>Credit Value</th>
              <th>Expedition Date</th>
              <th>Status</th>
              <th>Days Passed</th>
              <th>Assigned Task</th>
              <th>Actions</th>
          </thead>
          <tbody></tbody>
              <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                      <td><?php echo e($item->id); ?></td>
                      <td><?php echo e($item->title); ?></td>
                      <td><?php echo e($item->description); ?></td>
                      <td><?php echo e($item->credit_for_task); ?></td>
                      <td><?php echo e($item->expiration_date); ?></td>
                      <td class="<?php echo e($item->statu->style); ?>"><?php echo e($item->statu->name); ?></td>
                      <td><?php echo e(Helpers::getHoursPassed($item->hours_passed, ['format' => 'full','locale'=>'en'])); ?></td>
                      <td><?php echo e(Helpers::getAssignedTask($item->id)); ?></td>
                      <td>
                          <a class="btn btn-primary btn-block" href="<?php echo e(route('view', $item->id)); ?>">Show</a>
                          <a class="btn btn-primary btn-block" href="<?php echo e(route('update', $item->id)); ?>">Update</a>
                      </td>
                  </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
        <div class="mt-3">
          <?php echo e($tasks->links()); ?>

        </div>
  </div>
</div>

<?php else: ?>
<div class="card">
  <div class="card-header">
    <?php echo e(__('My Tasks Admin')); ?>

  </div>
  <div class="row ml-2">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><?php echo e(__('Credit Total: ')); ?></h5>
          <p class="card-text">
            <span class="badge badge-primary">Credits : <?php echo e(Helpers::getCreditTotal(Auth::user()->id)); ?></span>
          </p>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><?php echo e(__('Statistics')); ?></h5>
          <p class="card-text">
            <span class="badge badge-primary">Active: <?php echo e(Helpers::getActive(Auth::user()->id)); ?></span>
            <span class="badge badge-warning">Pending: <?php echo e(Helpers::getPending(Auth::user()->id)); ?></span>
            <span class="badge badge-success">Completed: <?php echo e(Helpers::getCompletion(Auth::user()->id)); ?></span>
          </p>
        </div>
      </div>
    </div>

  </div>
  <div class="card-body">
        <table class="table table-striped table-bordered">
          <thead>
              <th>ID</th>
              <th>Title</th>
              <th>Description</th>
              <th>Credit Value</th>
              <th>Expedition Date</th>
              <th>Status</th>
              <th>Days Passed</th>
              <th>Actions</th>
          </thead>
          <tbody></tbody>
              <?php $__currentLoopData = $taskUser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                      <td><?php echo e($item->task->id); ?></td>
                      <td><?php echo e($item->task->title); ?></td>
                      <td><?php echo e($item->task->description); ?></td>
                      <td><?php echo e($item->task->credit_for_task); ?></td>
                      <td><?php echo e($item->task->expiration_date); ?></td>
                      <td class="<?php echo e($item->task->statu->style); ?>"><?php echo e($item->task->statu->name); ?></td>
                      <td><?php echo e(Helpers::getHoursPassed($item->task->hours_passed, ['format' => 'full','locale'=>'en'])); ?></td>
                      <td>
                          <a class="btn btn-primary btn-block" href="<?php echo e(route('view', $item->task->id)); ?>">Show</a>
                          <a class="btn btn-primary btn-block" href="<?php echo e(route('update', $item->task->id)); ?>">Update</a>
                      </td>
                  </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
        <div class='mt-3'>
          <?php echo e($taskUser->links()); ?>

        </div>
  </div>
</div>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/TaskManager/resources/views/task/admin.blade.php ENDPATH**/ ?>