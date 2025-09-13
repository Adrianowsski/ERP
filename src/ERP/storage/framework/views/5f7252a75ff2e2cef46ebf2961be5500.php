<?php $__env->startSection('title','Registration Codes'); ?>

<?php $__env->startSection('content'); ?>
    <h1 class="mb-4 d-flex align-items-center">
        <i data-feather="codesandbox" class="me-2"></i> Registration Codes
    </h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="<?php echo e(route('registration-codes.create')); ?>"
           class="btn btn-primary d-inline-flex align-items-center">
            <i data-feather="plus" class="me-1"></i> New Code
        </a>
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-bordered align-middle mb-0 bg-white">
            <thead class="table-light">
            <tr>
                <th style="width: 5%">#</th>
                <th>Code</th>
                <th style="width: 15%">Status</th>
                <th style="width: 20%">Created By</th>
                <th class="text-end" style="width: 100px;">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $codes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($loop->iteration + ($codes->currentPage() - 1) * $codes->perPage()); ?></td>
                    <td><?php echo e($code->code); ?></td>
                    <td>
                        <?php if($code->is_used): ?>
                            <span class="badge bg-danger">Used</span>
                        <?php else: ?>
                            <span class="badge bg-success">Unused</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($code->creator->name); ?></td>
                    <td class="text-end d-flex flex-row justify-content-end flex-nowrap">
                        
                        <form method="POST" action="<?php echo e(route('registration-codes.destroy', $code)); ?>" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-sm btn-light border d-inline-flex align-items-center"
                                    onclick="return confirm('Delete this code?')"
                                    title="Delete">
                                <i data-feather="trash-2" class="text-danger"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="text-center text-muted">No registration codes found.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        <?php echo e($codes->withQueryString()->links()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\elpartner\resources\views/registration_codes/index.blade.php ENDPATH**/ ?>