<div class="mb-3">
    <label class="form-label" for="name">
        <i data-feather="box" class="me-1"></i>Name
    </label>
    <input
        type="text"
        name="name"
        id="name"
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $product->name ?? '') }}"
        required
    >
    @error('name')
    <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label" for="description">
        <i data-feather="file-text" class="me-1"></i>Description
    </label>
    <textarea
        name="description"
        id="description"
        rows="3"
        class="form-control @error('description') is-invalid @enderror"
        required
    >{{ old('description', $product->description ?? '') }}</textarea>
    @error('description')
    <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label" for="price_buy">
        <i data-feather="shopping-cart" class="me-1"></i>Price Buy
    </label>
    <input
        type="number"
        step="0.01"
        name="price_buy"
        id="price_buy"
        class="form-control @error('price_buy') is-invalid @enderror"
        value="{{ old('price_buy', $product->price_buy ?? '') }}"
        required
    >
    @error('price_buy')
    <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label" for="price_sell">
        <i data-feather="dollar-sign" class="me-1"></i>Price Sell
    </label>
    <input
        type="number"
        step="0.01"
        name="price_sell"
        id="price_sell"
        class="form-control @error('price_sell') is-invalid @enderror"
        value="{{ old('price_sell', $product->price_sell ?? '') }}"
        required
    >
    @error('price_sell')
    <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label" for="supplier_id">
        <i data-feather="truck" class="me-1"></i>Supplier
    </label>
    <select
        name="supplier_id"
        id="supplier_id"
        class="form-select @error('supplier_id') is-invalid @enderror"
        required
    >
        <option value="">— Choose supplier —</option>
        @foreach($suppliers as $id => $name)
            <option
                value="{{ $id }}"
                @selected(old('supplier_id', $product->supplier_id ?? '') == $id)
            >
                {{ $name }}
            </option>
        @endforeach
    </select>
    @error('supplier_id')
    <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>
