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
            <tr>
              <td><?php echo e(__('Type:')); ?></td>
              <td>
                <select class="form-control" name="type" id="type">
                  <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($type->id); ?>" <?php echo e($user->type_id == $type->id ? 'selected' : ''); ?>><?php echo e($type->name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <a href="" data-toggle="modal" data-target="#familyNucleusModal">
                   <p>New Type</p>
                  <div id="mensaje"></div>
                </a>
              </td>
            </tr>
            <tr>
                <td><?php echo e(__('Roles:')); ?></td>
                <td>
                  <select class="form-control" name="roles" id="roles">
                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($role->name); ?>" <?php echo e($user->hasRole($role->name) ? 'selected' : ''); ?>><?php echo e($role->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </td>
            </tr>
            </form>
          </table>
          <input type="hidden" name="id" value="<?php echo e($user->id); ?>">
          <a href="/user/admin"><input type="button" class="btn btn-primary" value="Back"></a>
          <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="familyNucleusModal" tabindex="-1" aria-labelledby="familyNucleusModal" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Family nucleus</h5>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
              <form id="familyNucleusForm">
                <?php echo csrf_field(); ?>
                  <label for="name">Name:</label>
                  <input type="text" name="name" id="name" class="form-control" required>
              </form>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="saveChangesBtn">Save changes</button>
          </div>
      </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        document.getElementById('saveChangesBtn').addEventListener('click', function() {
        // Obtenemos el formulario y el valor del campo de nombre
        const form = document.getElementById('familyNucleusForm');
        const formData = new FormData(form);

        // Enviamos el formulario con fetch
        fetch('/familynucleus', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                $('#mensaje').text('Type saved successfully!');
                location.reload();
                // Cerrar el modal y limpiar el formulario si es necesario
                $('#familyNucleusModal').modal('hide');
                form.reset();
            } else {
              $('#mensaje').text('There was an error saving the Type.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/TaskManager/resources/views/user/update.blade.php ENDPATH**/ ?>