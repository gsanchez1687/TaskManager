<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1><?php echo e(__('My Profile')); ?></h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="card-header">
      <?php echo e(__('My Profile')); ?>

    </div>
    <div class="card-body">
        <table class="table table-striped">
            <tr>
                <td><?php echo e(__('Google:')); ?></td>
                <td><?php echo e($user->google_id ? 'Yes' : 'No'); ?></td>
            </tr>
            <tr>
                <td><?php echo e(__('Name:')); ?></td>
                <td><?php echo e($user->name); ?></td>
            </tr>
            <tr>
                <td><?php echo e(__('Email:')); ?></td>
                <td><?php echo e($user->email); ?></td>
            </tr>
            <tr>
                <td><?php echo e(__('Total Credit:')); ?></td>
                <td><?php echo e($user->current_amount_total_credit); ?></td>
            </tr>
        </table>
    </div>
</div>
<?php if( !Auth::user()->hasRole('Admin')): ?>
    <div class="card">
        <div class="card-header">
        <?php echo e(__('My List household chores')); ?>

        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Credit Value</th>
                    <th>Expedition Date</th>
                    <th>Time Total</th>
                    <th>Status</th>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($item->task->id); ?></td>
                            <td><?php echo e($item->task->title); ?></td>
                            <td><?php echo e($item->task->description); ?></td>
                            <td><?php echo e($item->task->credit_for_task); ?></td>
                            <td><?php echo e($item->task->expiration_date); ?></td>
                            <td><?php echo e(Helpers::getHoursPassed($item->task->hours_passed, ['format' => 'full','locale'=>'en'])); ?></td>
                            <td class="<?php echo e($item->task->statu->style); ?>"><?php echo e($item->task->statu->name); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/TaskManager/resources/views/user/profile.blade.php ENDPATH**/ ?>