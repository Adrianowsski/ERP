<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo e(route('dashboard')); ?>">
            <i data-feather="briefcase" class="me-1"></i> ERP
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php if(auth()->guard()->check()): ?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('clients.index')); ?>"><i data-feather="users" class="me-1"></i>Clients</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('suppliers.index')); ?>"><i data-feather="truck" class="me-1"></i>Suppliers</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('products.index')); ?>"><i data-feather="box" class="me-1"></i>Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('orders.index')); ?>"><i data-feather="file-text" class="me-1"></i>Orders</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('invoices.index')); ?>"><i data-feather="file" class="me-1"></i>Invoices</a></li>

                    <?php if(auth()->user()->role === 'admin'): ?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('registration-codes.index')); ?>"><i data-feather="key" class="me-1"></i>Reg. Codes</a></li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>

            <ul class="navbar-nav">
                <?php if(auth()->guard()->guest()): ?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('login')); ?>">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('register')); ?>">Register</a></li>
                <?php else: ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown">
                            <i data-feather="user" class="me-1"></i><?php echo e(Auth::user()->name); ?>

                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                            <li>
                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button class="dropdown-item"><i data-feather="log-out" class="me-1"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<?php /**PATH C:\xampp\htdocs\elpartner\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>