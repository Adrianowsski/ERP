<?php $__env->startSection('title','Create Supplier'); ?>

<?php $__env->startSection('content'); ?>
    <h1 class="mb-4 d-flex align-items-center">
        <i data-feather="truck" class="me-1"></i> Create Supplier
    </h1>

    <form method="POST" action="<?php echo e(route('suppliers.store')); ?>">
        <?php echo csrf_field(); ?>
        <?php echo $__env->make('suppliers.partials.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="d-flex justify-content-between">
            <button class="btn btn-success">
                <i data-feather="save" class="me-1"></i> Save Supplier
            </button>
            <a href="<?php echo e(route('suppliers.index')); ?>" class="btn btn-secondary">
                <i data-feather="arrow-left" class="me-1"></i> Cancel
            </a>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\elpartner\resources\views/suppliers/create.blade.php ENDPATH**/ ?>