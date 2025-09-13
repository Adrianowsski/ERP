<?php $__env->startSection('title','Edit Client'); ?>

<?php $__env->startSection('content'); ?>
    <h1 class="mb-4"><i data-feather="edit-3" class="me-1"></i> Edit Client</h1>

    <form method="POST" action="<?php echo e(route('clients.update', $client)); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <?php echo $__env->make('clients.partials.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="d-flex justify-content-between">
            <button class="btn btn-success">
                <i data-feather="save" class="me-1"></i>Update Client
            </button>
            <a href="<?php echo e(route('clients.index')); ?>" class="btn btn-secondary">
                <i data-feather="arrow-left" class="me-1"></i>Cancel
            </a>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\elpartner\resources\views/clients/edit.blade.php ENDPATH**/ ?>