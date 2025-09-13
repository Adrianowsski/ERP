{{--
  Partial dla formularza faktury:
  - wybór zamówienia (tylko takie, które nie mają jeszcze faktury),
  - numer faktury, daty i wartość.
--}}

{{-- 1. Dropdown: wybór zamówienia --}}
<div class="mb-3">
    <label class="form-label" for="order_id">
        <i data-feather="file-text" class="me-1"></i>Order
    </label>
    <select
        id="order_id"
        name="order_id"
        class="form-select @error('order_id') is-invalid @enderror"
        required
    >
        <option value="">— Choose order —</option>
        @foreach($orders as $id => $label)
            <option
                value="{{ $id }}"
                @selected(old('order_id', $invoice->order_id ?? '') == $id)
            >
                {{ $label }}
            </option>
        @endforeach
    </select>
    @error('order_id')
    <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

{{-- 2. Invoice Number --}}
<div class="mb-3">
    <label class="form-label" for="invoice_number">
        <i data-feather="hash" class="me-1"></i>Invoice Number
    </label>
    <input
        type="text"
        name="invoice_number"
        id="invoice_number"
        class="form-control @error('invoice_number') is-invalid @enderror"
        value="{{ old('invoice_number', $invoice->invoice_number ?? '') }}"
        required
    >
    @error('invoice_number')
    <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

{{-- 3. Issue Date --}}
<div class="mb-3">
    <label class="form-label" for="issue_date">
        <i data-feather="calendar" class="me-1"></i>Issue Date
    </label>
    <input
        type="date"
        name="issue_date"
        id="issue_date"
        class="form-control @error('issue_date') is-invalid @enderror"
        value="{{ old('issue_date', isset($invoice->issue_date) ? $invoice->issue_date->format('Y-m-d') : '') }}"
        required
    >
    @error('issue_date')
    <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

{{-- 4. Due Date --}}
<div class="mb-3">
    <label class="form-label" for="due_date">
        <i data-feather="clock" class="me-1"></i>Due Date
    </label>
    <input
        type="date"
        name="due_date"
        id="due_date"
        class="form-control @error('due_date') is-invalid @enderror"
        value="{{ old('due_date', isset($invoice->due_date) ? $invoice->due_date->format('Y-m-d') : '') }}"
        required
    >
    @error('due_date')
    <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

{{-- 5. Total --}}
<div class="mb-3">
    <label class="form-label" for="total">
        <i data-feather="dollar-sign" class="me-1"></i>Total
    </label>
    <input
        type="number"
        step="0.01"
        name="total"
        id="total"
        class="form-control @error('total') is-invalid @enderror"
        value="{{ old('total', $invoice->total ?? '') }}"
        required
    >
    @error('total')
    <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>
