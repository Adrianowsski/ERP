<?php $__env->startSection('title','Suppliers'); ?>

<?php $__env->startSection('content'); ?>
    <h1 class="mb-4 d-flex align-items-center">
        <i data-feather="truck" class="me-2"></i> Suppliers
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
            <button class="btn btn-outline-dark rounded-pill d-flex align-items-center px-3">
                <i data-feather="search" class="me-1"></i> Search
            </button>
        </form>

        <a href="<?php echo e(route('suppliers.create')); ?>"
           class="btn btn-primary rounded-pill d-flex align-items-center px-4 py-2">
            <i data-feather="plus" class="me-1"></i> Add Supplier
        </a>
    </div>

    
    <div class="d-flex flex-column flex-md-row justify-content-start align-items-start align-items-md-center gap-2 mb-4">
        <form method="GET" class="d-flex gap-2 align-items-center">
            <select
                name="sort"
                class="form-select rounded-pill"
                style="min-width: 180px;"
            >
                <option value="">Sort by</option>
                <option value="name_asc"   <?php if(request('sort') === 'name_asc'): echo 'selected'; endif; ?>>Name (A-Z)</option>
                <option value="name_desc"  <?php if(request('sort') === 'name_desc'): echo 'selected'; endif; ?>>Name (Z-A)</option>
                <option value="nip_asc"    <?php if(request('sort') === 'nip_asc'): echo 'selected'; endif; ?>>NIP ↑</option>
                <option value="nip_desc"   <?php if(request('sort') === 'nip_desc'): echo 'selected'; endif; ?>>NIP ↓</option>
            </select>
            <button class="btn btn-outline-dark rounded-pill d-flex align-items-center px-3">
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
                <th>NIP</th>
                <th>Email</th>
                <th>Phone</th>
                <th class="text-end" style="width: 160px;">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($loop->iteration + ($suppliers->currentPage() - 1) * $suppliers->perPage()); ?></td>
                    <td><?php echo e($supplier->name); ?></td>
                    <td><?php echo e($supplier->nip); ?></td>
                    <td><?php echo e($supplier->email); ?></td>
                    <td><?php echo e($supplier->phone); ?></td>
                    <td class="text-end">
                        <a href="<?php echo e(route('suppliers.show', $supplier)); ?>"
                           class="btn btn-sm btn-light border d-inline-flex align-items-center me-1" title="View">
                            <i data-feather="eye" class="text-primary"></i>
                        </a>
                        <a href="<?php echo e(route('suppliers.edit', $supplier)); ?>"
                           class="btn btn-sm btn-light border d-inline-flex align-items-center me-1" title="Edit">
                            <i data-feather="edit-2" class="text-warning"></i>
                        </a>
                        <form method="POST" action="<?php echo e(route('suppliers.destroy', $supplier)); ?>" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-sm btn-light border d-inline-flex align-items-center"
                                    onclick="return confirm('Delete this supplier?')" title="Delete">
                                <i data-feather="trash-2" class="text-danger"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="text-center text-muted">No suppliers found.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        <?php echo e($suppliers->withQueryString()->links()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\elpartner\resources\views/suppliers/index.blade.php ENDPATH**/ ?>