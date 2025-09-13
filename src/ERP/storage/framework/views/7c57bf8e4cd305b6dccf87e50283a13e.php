<?php $__env->startSection('title','Dashboard'); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        /* helpers */
        .quick-actions .btn{min-width:135px}
        .kpi-card{min-height:110px;display:flex;flex-direction:column;justify-content:center}
        .kpi-card .value{font-size:2.25rem;font-weight:700}
        .chart-wrapper{height:260px}
        .table-xs td{padding:.35rem .5rem;font-size:.875rem}
        .table-fixed{table-layout:fixed}
        .scroll-y{max-height:235px;overflow-y:auto}
    </style>
<?php $__env->stopPush(); ?>

<?php use Illuminate\Support\Str; ?>

<?php $__env->startSection('content'); ?>
    <h1 class="mb-4">Dashboard</h1>

    
    <div class="quick-actions d-flex flex-wrap gap-2 mb-4">
        <a class="btn btn-primary" href="<?php echo e(route('clients.create')); ?>"><i class="bi bi-person-plus me-1"></i>New Client</a>
        <a class="btn btn-primary" href="<?php echo e(route('orders.create')); ?>"><i class="bi bi-bag-plus me-1"></i>New Order</a>
        <a class="btn btn-primary" href="<?php echo e(route('products.create')); ?>"><i class="bi bi-box-seam me-1"></i>New Product</a>
        <a class="btn btn-success" href="<?php echo e(route('invoices.create')); ?>"><i class="bi bi-file-earmark-text me-1"></i>New Invoice</a>
    </div>

    
    <div class="row g-3 mb-4">
        <?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-6 col-md-4 col-lg-2">
                <div class="card border-0 shadow-sm kpi-card text-center">
                    <div class="text-uppercase small text-muted"><?php echo e($label); ?></div>
                    <div class="value"><?php echo e($count); ?></div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="col-6 col-md-4 col-lg-2">
            <div class="card border-0 shadow-sm kpi-card text-center bg-light">
                <div class="small text-muted">Revenue Month</div>
                <div class="value"><?php echo e(number_format($revenueMonth,2)); ?> €</div>
                <div class="small text-muted mt-1">Today: <?php echo e(number_format($revenueToday,2)); ?> €</div>
            </div>
        </div>
    </div>

    
    <div class="row g-4">
        <div class="col-xl-6">
            <div class="card shadow-sm h-100">
                <div class="card-header">Orders – Last 12 Months</div>
                <div class="card-body chart-wrapper"><canvas id="ordersChart"></canvas></div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card shadow-sm h-100">
                <div class="card-header">Revenue – Last 12 Months</div>
                <div class="card-body chart-wrapper"><canvas id="revenueChart"></canvas></div>
            </div>
        </div>
    </div>

    
    <div class="row g-4 mt-3">
        <div class="col-xl-4">
            <div class="card shadow-sm h-100">
                <div class="card-header">Order Status Mix</div>
                <div class="card-body chart-wrapper"><canvas id="statusChart"></canvas></div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card shadow-sm h-100 d-flex flex-column">
                <div class="card-header">Latest Orders</div>
                <div class="card-body p-0 flex-grow-1 scroll-y">
                    <table class="table table-hover mb-0 table-xs table-fixed">
                        <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $latestOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="text-muted">#<?php echo e($o->id); ?></td>
                                <td><?php echo e(Str::limit($o->client->name ?? '—', 22)); ?></td>
                                <td><?php echo e($o->created_at->format('d M')); ?></td>
                                <td>
                                <span class="badge bg-<?php echo e($o->status==='completed'?'success':'warning'); ?>">
                                    <?php echo e(ucfirst($o->status)); ?>

                                </span>
                                </td>
                                <td class="text-end"><?php echo e(number_format($o->total,2)); ?> €</td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr><td colspan="5" class="py-4 text-center text-muted">No orders yet</td></tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-white text-end">
                    <a href="<?php echo e(route('orders.index')); ?>" class="btn btn-sm btn-outline-secondary">All Orders</a>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card shadow-sm h-100 d-flex flex-column">
                <div class="card-header">Top Products (This Year)</div>
                <div class="card-body p-0 flex-grow-1 scroll-y">
                    <table class="table mb-0 table-xs table-fixed">
                        <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $topProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e(Str::limit($p->name, 28)); ?></td>
                                <td class="text-end"><?php echo e($p->orders_count); ?> orders</td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr><td colspan="2" class="py-4 text-center text-muted">No data</td></tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-white text-end">
                    <a href="<?php echo e(route('products.index')); ?>" class="btn btn-sm btn-outline-secondary">All Products</a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const labels      = <?php echo json_encode($months, 15, 512) ?>;
            const ordersData  = <?php echo json_encode($ordersMonthly->values(), 15, 512) ?>;
            const revenueData = <?php echo json_encode($revenueMonthly->values(), 15, 512) ?>;

            new Chart(ordersChart, {
                type:'bar',
                data:{labels,datasets:[{label:'Orders',data:ordersData,backgroundColor:'#0d6efd80'}]},
                options:{maintainAspectRatio:false,scales:{y:{beginAtZero:true}}}
            });

            new Chart(revenueChart, {
                type:'line',
                data:{labels,datasets:[{label:'Revenue (€)',data:revenueData,borderWidth:2,tension:.35}]},
                options:{maintainAspectRatio:false,scales:{y:{beginAtZero:true}}}
            });

            new Chart(statusChart, {
                type:'doughnut',
                data:{labels:<?php echo json_encode($statusCounts->keys(), 15, 512) ?>,datasets:[{data:<?php echo json_encode($statusCounts->values(), 15, 512) ?>}]},
                options:{maintainAspectRatio:false,plugins:{legend:{position:'bottom'}}}
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\elpartner\resources\views/dashboard.blade.php ENDPATH**/ ?>