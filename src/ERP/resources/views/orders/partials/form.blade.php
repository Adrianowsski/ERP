{{-- 1. Wybór klienta --}}
<div class="mb-3">
    <label class="form-label" for="client_id">
        <i data-feather="user" class="me-1"></i>Client
    </label>
    <select
        id="client_id"
        name="client_id"
        class="form-select @error('client_id') is-invalid @enderror"
        required
    >
        <option value="">— Choose client —</option>
        @foreach($clients as $id => $name)
            <option
                value="{{ $id }}"
                @selected(old('client_id', $order->client_id ?? '') == $id)
            >
                {{ $name }}
            </option>
        @endforeach
    </select>
    @error('client_id')
    <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

{{-- 2. Data zamówienia --}}
<div class="mb-3">
    <label class="form-label" for="order_date">
        <i data-feather="calendar" class="me-1"></i>Order Date
    </label>
    <input
        id="order_date"
        type="date"
        name="order_date"
        class="form-control @error('order_date') is-invalid @enderror"
        value="{{ old('order_date', isset($order->order_date) ? $order->order_date->format('Y-m-d') : '') }}"
        required
    />
    @error('order_date')
    <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

{{-- 3. Status --}}
<div class="mb-3">
    <label class="form-label" for="status">
        <i data-feather="clipboard" class="me-1"></i>Status
    </label>
    <input
        id="status"
        type="text"
        name="status"
        class="form-control @error('status') is-invalid @enderror"
        value="{{ old('status', $order->status ?? '') }}"
        required
        maxlength="50"
    />
    @error('status')
    <div class="text-danger small">{{ $message }}</div>
    @enderror
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

    {{-- ----------------------------
         Wiersz-szablon (hidden template)
       ---------------------------- --}}
    <tr class="d-none" id="order-product-template">
        <td>
            <select class="form-select product-select" disabled>
                <option value="">— Choose product —</option>
                @foreach($products as $prodId => $prodName)
                    @php $prodModel = \App\Models\Product::find($prodId); @endphp
                    <option
                        value="{{ $prodId }}"
                        data-buy="{{ $prodModel->price_buy }}"
                        data-sell="{{ $prodModel->price_sell }}"
                    >
                        {{ $prodName }}
                    </option>
                @endforeach
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
    {{-- ---------------------------- --}}

    {{-- Jeśli edycja – wczytujemy istniejące produkty --}}
    @if(isset($order) && $order->products->count())
        @foreach($order->products as $index => $prod)
            <tr>
                <td>
                    <select
                        class="form-select product-select @error('products.'.$index.'.product_id') is-invalid @enderror"
                        name="products[{{ $index }}][product_id]"
                        required
                    >
                        <option value="">— Choose product —</option>
                        @foreach($products as $prodId => $prodName)
                            @php $prodModel = \App\Models\Product::find($prodId); @endphp
                            <option
                                value="{{ $prodId }}"
                                data-buy="{{ $prodModel->price_buy }}"
                                data-sell="{{ $prodModel->price_sell }}"
                                @selected($prodId == $prod->id)
                            >
                                {{ $prodName }}
                            </option>
                        @endforeach
                    </select>
                    @error('products.'.$index.'.product_id')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </td>
                <td>
                    <input
                        type="number"
                        min="1"
                        class="form-control quantity-input @error('products.'.$index.'.quantity') is-invalid @enderror"
                        name="products[{{ $index }}][quantity]"
                        value="{{ old('products.'.$index.'.quantity', $prod->pivot->quantity) }}"
                        required
                    />
                    @error('products.'.$index.'.quantity')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </td>
                <td>
                    <input
                        type="number"
                        step="0.01"
                        class="form-control price-buy-input"
                        name="products[{{ $index }}][price_buy]"
                        value="{{ number_format($prod->pivot->price_buy, 2) }}"
                        readonly
                    />
                </td>
                <td>
                    <input
                        type="number"
                        step="0.01"
                        class="form-control price-sell-input"
                        name="products[{{ $index }}][price_sell]"
                        value="{{ number_format($prod->pivot->price_sell, 2) }}"
                        readonly
                    />
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm remove-product-btn">&times;</button>
                </td>
            </tr>
        @endforeach
    @endif

    </tbody>
</table>

<div class="mb-3">
    <button type="button" id="add-product-btn" class="btn btn-secondary">
        <i data-feather="plus" class="me-1"></i> Add Product
    </button>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const rowContainer = document.getElementById('order-products-rows');
            const templateRow  = document.getElementById('order-product-template');
            const addButton    = document.getElementById('add-product-btn');

            let nextIndex = 0;
            @if(isset($order))
                nextIndex = {{ $order->products->count() }};
            @endif

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
@endpush
