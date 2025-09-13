<?php $__env->startSection('title','Products'); ?>

<?php $__env->startSection('content'); ?>
    <h1 class="mb-4 d-flex align-items-center">
        <i data-feather="box" class="me-2"></i> Products
    </h1>

    
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-3">
        <form method="GET" class="d-flex gap-2 align-items-center">
            <input
                name="q"
                class="form-control rounded-pill px-3"
                placeholder="Search..."
                value="<?php echo e(request('q')); ?>"
                style="min-width: 200px;"
            >
            <button class="btn btn-outline-dark rounded-pill d-inline-flex align-items-center px-3">
                <i data-feather="search" class="me-1"></i> Search
            </button>
        </form>

        <a href="<?php echo e(route('products.create')); ?>"
           class="btn btn-primary rounded-pill d-flex align-items-center px-4 py-2">
            <i data-feather="plus" class="me-1"></i> Add Product
        </a>
    </div>

    
    <div class="d-flex flex-column flex-md-row justify-content-start align-items-start align-items-md-center gap-2 mb-4">
        <form method="GET" class="d-flex gap-2 align-items-center">
            <select
                name="sort"
                class="form-select rounded-pill"
                style="min-width: 200px;"
            >
                <option value="">Sort by</option>
                <option value="name_asc"       <?php if(request('sort')==='name_asc'): echo 'selected'; endif; ?>>Name (A-Z)</option>
                <option value="name_desc"      <?php if(request('sort')==='name_desc'): echo 'selected'; endif; ?>>Name (Z-A)</option>
                <option value="price_buy_asc"  <?php if(request('sort')==='price_buy_asc'): echo 'selected'; endif; ?>>Price Buy ↑</option>
                <option value="price_buy_desc" <?php if(request('sort')==='price_buy_desc'): echo 'selected'; endif; ?>>Price Buy ↓</option>
                <option value="price_sell_asc" <?php if(request('sort')==='price_sell_asc'): echo 'selected'; endif; ?>>Price Sell ↑</option>
                <option value="price_sell_desc"<?php if(request('sort')==='price_sell_desc'): echo 'selected'; endif; ?>>Price Sell ↓</option>
            </select>
            <button class="btn btn-outline-dark rounded-pill d-inline-flex align-items-center px-3">
                <i data-feather="sliders" class="me-1"></i> Sort
            </button>
        </form>
    </div>

    
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-bordered align-middle mb-0 bg-white">
            <thead class="table-light">
            <tr>
                <th style="width: 5%">#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price Buy</th>
                <th>Price Sell</th>
                <th>Supplier</th>
                <th class="text-end" style="width: 160px;">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($loop->iteration + ($products->currentPage() - 1) * $products->perPage()); ?></td>
                    <td><?php echo e($product->name); ?></td>
                    <td><?php echo e($product->description); ?></td>
                    <td><?php echo e(number_format($product->price_buy, 2)); ?></td>
                    <td><?php echo e(number_format($product->price_sell, 2)); ?></td>
                    <td><?php echo e($product->supplier->name); ?></td>
                    <td class="text-end">
                        <a href="<?php echo e(route('products.show', $product)); ?>"
                           class="btn btn-sm btn-light border d-inline-flex align-items-center me-1" title="View">
                            <i data-feather="eye" class="text-primary"></i>
                        </a>
                        <a href="<?php echo e(route('products.edit', $product)); ?>"
                           class="btn btn-sm btn-light border d-inline-flex align-items-center me-1" title="Edit">
                            <i data-feather="edit-2" class="text-warning"></i>
                        </a>
                        <form method="POST" action="<?php echo e(route('products.destroy', $product)); ?>" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-sm btn-light border d-inline-flex align-items-center"
                                    onclick="return confirm('Delete this product?')" title="Delete">
                                <i data-feather="trash-2" class="text-danger"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="7" class="text-center text-muted">No products found.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        <?php echo e($products->withQueryString()->links()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\elpartner\resources\views/products/index.blade.php ENDPATH**/ ?>