<?php $__env->startSection('title','Supplier Details'); ?>

<?php $__env->startSection('content'); ?>
    <h1 class="mb-4">Supplier Details</h1>

    <div class="card mb-4">
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-4 text-capitalize">Name</dt>
                <dd class="col-sm-8"><?php echo e($supplier->name); ?></dd>

                <dt class="col-sm-4 text-capitalize">NIP</dt>
                <dd class="col-sm-8"><?php echo e($supplier->nip); ?></dd>

                <dt class="col-sm-4 text-capitalize">Email</dt>
                <dd class="col-sm-8"><?php echo e($supplier->email); ?></dd>

                <dt class="col-sm-4 text-capitalize">Phone</dt>
                <dd class="col-sm-8"><?php echo e($supplier->phone); ?></dd>

                <dt class="col-sm-4 text-capitalize">Address</dt>
                <dd class="col-sm-8"><?php echo e($supplier->address); ?></dd>
            </dl>

            <a href="<?php echo e(route('suppliers.edit', $supplier)); ?>" class="btn btn-warning">Edit</a>
            <a href="<?php echo e(route('suppliers.index')); ?>" class="btn btn-secondary">Back</a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\elpartner\resources\views/suppliers/show.blade.php ENDPATH**/ ?>