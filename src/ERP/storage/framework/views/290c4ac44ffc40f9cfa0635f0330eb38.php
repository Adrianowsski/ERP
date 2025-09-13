<?php $__env->startSection('title','Invoice Details'); ?>

<?php $__env->startSection('content'); ?>
    <h1 class="mb-4 d-flex align-items-center">
        <i data-feather="info" class="me-1"></i>Invoice <?php echo e($invoice->invoice_number); ?>

    </h1>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5>Client</h5>
                    <p>
                        <strong><?php echo e($invoice->order->client->name); ?></strong><br>
                        <?php echo e($invoice->order->client->address); ?><br>
                        <?php echo e($invoice->order->client->nip); ?>

                    </p>
                </div>
                <div class="col-md-6">
                    <h5>Invoice Details</h5>
                    <p><strong>Invoice No.</strong> <?php echo e($invoice->invoice_number); ?></p>
                    <p><strong>Issue Date:</strong> <?php echo e($invoice->issue_date->format('Y-m-d')); ?></p>
                    <p><strong>Due Date:</strong> <?php echo e($invoice->due_date->format('Y-m-d')); ?></p>
                    <p><strong>Total:</strong> <?php echo e(number_format($invoice->total, 2)); ?></p>
                </div>
            </div>

            <h5 class="mt-4">Items</h5>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                    <tr>
                        <th style="width: 5%">#</th>
                        <th>Product</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-end">Price</th>
                        <th class="text-end">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $invoice->order->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($product->name); ?></td>
                            <td class="text-center"><?php echo e($product->pivot->quantity); ?></td>
                            <td class="text-end"><?php echo e(number_format($product->pivot->price_sell, 2)); ?></td>
                            <td class="text-end">
                                <?php echo e(number_format($product->pivot->quantity * $product->pivot->price_sell, 2)); ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="<?php echo e(route('invoices.edit', $invoice)); ?>" class="btn btn-warning d-inline-flex align-items-center">
                    <i data-feather="edit-2" class="me-1"></i> Edit
                </a>
                <div>
                    <a href="<?php echo e(route('invoices.pdf', $invoice)); ?>" class="btn btn-secondary d-inline-flex align-items-center me-2">
                        <i data-feather="download" class="me-1"></i> Download PDF
                    </a>
                    <a href="<?php echo e(route('invoices.index')); ?>" class="btn btn-secondary d-inline-flex align-items-center">
                        <i data-feather="arrow-left" class="me-1"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\elpartner\resources\views/invoices/show.blade.php ENDPATH**/ ?>