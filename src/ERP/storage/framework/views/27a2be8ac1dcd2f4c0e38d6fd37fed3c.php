
<div class="mb-3">
    <label class="form-label" for="client_id">
        <i data-feather="user" class="me-1"></i>Client
    </label>
    <select
        id="client_id"
        name="client_id"
        class="form-select <?php $__errorArgs = ['client_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
        required
    >
        <option value="">— Choose client —</option>
        <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option
                value="<?php echo e($id); ?>"
                <?php if(old('client_id', $order->client_id ?? '') == $id): echo 'selected'; endif; ?>
            >
                <?php echo e($name); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <?php $__errorArgs = ['client_id'];
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


<div class="mb-3">
    <label class="form-label" for="order_date">
        <i data-feather="calendar" class="me-1"></i>Order Date
    </label>
    <input
        id="order_date"
        type="date"
        name="order_date"
        class="form-control <?php $__errorArgs = ['order_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
        value="<?php echo e(old('order_date', isset($order->order_date) ? $order->order_date->format('Y-m-d') : '')); ?>"
        required
    />
    <?php $__errorArgs = ['order_date'];
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


<div class="mb-3">
    <label class="form-label" for="status">
        <i data-feather="clipboard" class="me-1"></i>Status
    </label>
    <input
        id="status"
        type="text"
        name="status"
        class="form-control <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
        value="<?php echo e(old('status', $order->status ?? '')); ?>"
        required
        maxlength="50"
    />
    <?php $__errorArgs = ['status'];
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

<hr class="my-4">

<h5 class="mb-3">Products in this Order</h5>

<table class="table table-bordered">
    <thead>
    <tr>
        <th>Product</th>
        <th>Quantity</th>
        <th>Price Buy</th>
        <th>Price Sell</th>
        <th style="width: 1%"></th>
    </tr>
    </thead>
    <tbody id="order-products-rows">

    
    <tr class="d-none" id="order-product-template">
        <td>
            <select class="form-select product-select" disabled>
                <option value="">— Choose product —</option>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prodId => $prodName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $prodModel = \App\Models\Product::find($prodId); ?>
                    <option
                        value="<?php echo e($prodId); ?>"
                        data-buy="<?php echo e($prodModel->price_buy); ?>"
                        data-sell="<?php echo e($prodModel->price_sell); ?>"
                    >
                        <?php echo e($prodName); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </td>
        <td>
            <input
                type="number"
                min="1"
                class="form-control quantity-input"
                disabled
            />
        </td>
        <td>
            <input
                type="number"
                step="0.01"
                class="form-control price-buy-input"
                disabled
            />
        </td>
        <td>
            <input
                type="number"
                step="0.01"
                class="form-control price-sell-input"
                disabled
            />
        </td>
        <td class="text-center">
            <button type="button" class="btn btn-danger btn-sm remove-product-btn">&times;</button>
        </td>
    </tr>
    

    
    <?php if(isset($order) && $order->products->count()): ?>
        <?php $__currentLoopData = $order->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <select
                        class="form-select product-select <?php $__errorArgs = ['products.'.$index.'.product_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        name="products[<?php echo e($index); ?>][product_id]"
                        required
                    >
                        <option value="">— Choose product —</option>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prodId => $prodName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $prodModel = \App\Models\Product::find($prodId); ?>
                            <option
                                value="<?php echo e($prodId); ?>"
                                data-buy="<?php echo e($prodModel->price_buy); ?>"
                                data-sell="<?php echo e($prodModel->price_sell); ?>"
                                <?php if($prodId == $prod->id): echo 'selected'; endif; ?>
                            >
                                <?php echo e($prodName); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['products.'.$index.'.product_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger small"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </td>
                <td>
                    <input
                        type="number"
                        min="1"
                        class="form-control quantity-input <?php $__errorArgs = ['products.'.$index.'.quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        name="products[<?php echo e($index); ?>][quantity]"
                        value="<?php echo e(old('products.'.$index.'.quantity', $prod->pivot->quantity)); ?>"
                        required
                    />
                    <?php $__errorArgs = ['products.'.$index.'.quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger small"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </td>
                <td>
                    <input
                        type="number"
                        step="0.01"
                        class="form-control price-buy-input"
                        name="products[<?php echo e($index); ?>][price_buy]"
                        value="<?php echo e(number_format($prod->pivot->price_buy, 2)); ?>"
                        readonly
                    />
                </td>
                <td>
                    <input
                        type="number"
                        step="0.01"
                        class="form-control price-sell-input"
                        name="products[<?php echo e($index); ?>][price_sell]"
                        value="<?php echo e(number_format($prod->pivot->price_sell, 2)); ?>"
                        readonly
                    />
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm remove-product-btn">&times;</button>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

    </tbody>
</table>

<div class="mb-3">
    <button type="button" id="add-product-btn" class="btn btn-secondary">
        <i data-feather="plus" class="me-1"></i> Add Product
    </button>
</div>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const rowContainer = document.getElementById('order-products-rows');
            const templateRow  = document.getElementById('order-product-template');
            const addButton    = document.getElementById('add-product-btn');

            let nextIndex = 0;
            <?php if(isset($order)): ?>
                nextIndex = <?php echo e($order->products->count()); ?>;
            <?php endif; ?>

            function onProductChange(event) {
                const selectEl     = event.target;
                const chosenOption = selectEl.options[selectEl.selectedIndex];
                const buyValue     = chosenOption.getAttribute('data-buy')  || '';
                const sellValue    = chosenOption.getAttribute('data-sell') || '';

                const row = selectEl.closest('tr');
                if (!row) return;
                const buyEl  = row.querySelector('input.price-buy-input');
                const sellEl = row.querySelector('input.price-sell-input');
                if (buyEl)  buyEl.value  = buyValue;
                if (sellEl) sellEl.value = sellValue;
            }

            function addNewRow() {
                const newRow = templateRow.cloneNode(true);
                newRow.removeAttribute('id');
                newRow.classList.remove('d-none');

                const selectEl = newRow.querySelector('select.product-select');
                selectEl.removeAttribute('disabled');
                selectEl.name = `products[${nextIndex}][product_id]`;
                selectEl.id   = `products_${nextIndex}_product_id`;

                const qtyEl = newRow.querySelector('input.quantity-input');
                qtyEl.removeAttribute('disabled');
                qtyEl.name  = `products[${nextIndex}][quantity]`;
                qtyEl.id    = `products_${nextIndex}_quantity`;
                qtyEl.value = '';

                const buyEl = newRow.querySelector('input.price-buy-input');
                buyEl.removeAttribute('disabled');
                buyEl.name  = `products[${nextIndex}][price_buy]`;
                buyEl.id    = `products_${nextIndex}_price_buy`;
                buyEl.value = '';

                const sellEl = newRow.querySelector('input.price-sell-input');
                sellEl.removeAttribute('disabled');
                sellEl.name  = `products[${nextIndex}][price_sell]`;
                sellEl.id    = `products_${nextIndex}_price_sell`;
                sellEl.value = '';

                selectEl.addEventListener('change', onProductChange);
                newRow.querySelector('button.remove-product-btn').addEventListener('click', () => newRow.remove());

                rowContainer.appendChild(newRow);
                nextIndex++;
            }

            document.querySelectorAll('#order-products-rows select.product-select').forEach(sel => {
                sel.addEventListener('change', onProductChange);
            });
            document.querySelectorAll('#order-products-rows button.remove-product-btn').forEach(btn => {
                btn.addEventListener('click', () => btn.closest('tr').remove());
            });

            addButton.addEventListener('click', addNewRow);
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\elpartner\resources\views/orders/partials/form.blade.php ENDPATH**/ ?>