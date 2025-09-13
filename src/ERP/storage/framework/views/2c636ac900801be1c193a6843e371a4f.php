<?php $__env->startSection('title','Product Details'); ?>

<?php $__env->startSection('content'); ?>
    <h1 class="mb-4 d-flex align-items-center">
        <i data-feather="info" class="me-1"></i> Product Details
    </h1>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-4">Name</dt>
                <dd class="col-sm-8"><?php echo e($product->name); ?></dd>

                <dt class="col-sm-4">Description</dt>
                <dd class="col-sm-8"><?php echo e($product->description); ?></dd>

                <dt class="col-sm-4">Price Buy</dt>
                <dd class="col-sm-8"><?php echo e(number_format($product->price_buy, 2)); ?></dd>

                <dt class="col-sm-4">Price Sell</dt>
                <dd class="col-sm-8"><?php echo e(number_format($product->price_sell, 2)); ?></dd>

                <dt class="col-sm-4">Supplier</dt>
                <dd class="col-sm-8"><?php echo e($product->supplier->name); ?></dd>
            </dl>

            <div class="d-flex justify-content-between">
                <a href="<?php echo e(route('products.edit', $product)); ?>" class="btn btn-warning d-flex align-items-center">
                    <i data-feather="edit-2" class="me-1"></i> Edit
                </a>
                <a href="<?php echo e(route('products.index')); ?>" class="btn btn-secondary d-flex align-items-center">
                    <i data-feather="arrow-left" class="me-1"></i> Back
                </a>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\elpartner\resources\views/products/show.blade.php ENDPATH**/ ?>