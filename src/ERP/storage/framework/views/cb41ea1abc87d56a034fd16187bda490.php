<?php $__env->startSection('title','Welcome'); ?>

<?php $__env->startSection('content'); ?>
    <div class="text-center py-5">
        <h1 class="display-4 mb-4">Welcome to <span class="text-primary fw-bold">ERP App</span></h1>
        <p class="lead mb-4">Manage clients, suppliers, orders and invoices seamlessly in one unified system.</p>

        <?php if(auth()->guard()->guest()): ?>
            <a href="<?php echo e(route('register')); ?>" class="btn btn-primary btn-lg me-2">
                <i data-feather="user-plus" class="me-1"></i> Sign Up
            </a>
            <a href="<?php echo e(route('login')); ?>" class="btn btn-outline-dark btn-lg">
                <i data-feather="log-in" class="me-1"></i> Login
            </a>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\elpartner\resources\views/welcome.blade.php ENDPATH**/ ?>