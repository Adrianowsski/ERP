<?php $__env->startSection('title','Order Details'); ?>

<?php $__env->startSection('content'); ?>
    <h1 class="mb-4 d-flex align-items-center">
        <i data-feather="info" class="me-1"></i> Order Details #<?php echo e($order->id); ?>

    </h1>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-4">Client</dt>
                <dd class="col-sm-8"><?php echo e($order->client->name); ?></dd>

                <dt class="col-sm-4">Order Date</dt>
                <dd class="col-sm-8"><?php echo e($order->order_date->format('Y-m-d')); ?></dd>

                <dt class="col-sm-4">Status</dt>
                <dd class="col-sm-8"><?php echo e(ucfirst($order->status)); ?></dd>
            </dl>
        </div>
    </div>

    <h5 class="mb-3">Ordered Products</h5>
    <?php if($order->products->count()): ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th style="width: 5%">#</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price Buy</th>
                <th>Price Sell</th>
                <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $order->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($product->name); ?></td>
                    <td><?php echo e($product->pivot->quantity); ?></td>
                    <td><?php echo e(number_format($product->pivot->price_buy, 2)); ?></td>
                    <td><?php echo e(number_format($product->pivot->price_sell, 2)); ?></td>
                    <td><?php echo e(number_format($product->pivot->quantity * $product->pivot->price_sell, 2)); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <div class="text-end mb-4">
            <h5>
                Grand Total:
                <?php echo e(number_format($order->products->sum(fn($p) => $p->pivot->quantity * $p->pivot->price_sell), 2)); ?>

            </h5>
        </div>
    <?php else: ?>
        <p>No products in this order.</p>
    <?php endif; ?>

    <div class="d-flex justify-content-between">
        <a href="<?php echo e(route('orders.edit', $order)); ?>" class="btn btn-warning d-flex align-items-center">
            <i data-feather="edit-2" class="me-1"></i> Edit
        </a>
        <a href="<?php echo e(route('orders.index')); ?>" class="btn btn-secondary d-flex align-items-center">
            <i data-feather="arrow-left" class="me-1"></i> Back
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\elpartner\resources\views/orders/show.blade.php ENDPATH**/ ?>