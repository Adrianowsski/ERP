<?php $__env->startSection('title','Generate Code'); ?>

<?php $__env->startSection('content'); ?>
    <h1 class="mb-4 d-flex align-items-center">
        <i data-feather="key" class="me-2"></i> Generate Registration Code
    </h1>

    
    <?php use Illuminate\Support\Str; ?>

    <form method="POST" action="<?php echo e(route('registration-codes.store')); ?>">
        <?php echo csrf_field(); ?>

        <div class="mb-3">
            <label class="form-label" for="code">
                <i data-feather="hash" class="me-1"></i>Code
            </label>
            <input
                type="text"
                name="code"
                id="code"
                class="form-control <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                value="<?php echo e(old('code', Str::random(10))); ?>"
                required
            >
            <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="text-danger small"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="d-flex justify-content-between">
            <button class="btn btn-success d-inline-flex align-items-center">
                <i data-feather="save" class="me-1"></i> Save
            </button>
            <a href="<?php echo e(route('registration-codes.index')); ?>"
               class="btn btn-secondary d-inline-flex align-items-center">
                <i data-feather="arrow-left" class="me-1"></i> Back
            </a>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\elpartner\resources\views/registration_codes/create.blade.php ENDPATH**/ ?>