@extends('layouts.app')
@section('title','Edit Invoice')

@section('content')
    <h1 class="mb-4 d-flex align-items-center">
        <i data-feather="edit-3" class="me-1"></i> Edit Invoice
    </h1>

    <form method="POST" action="{{ route('invoices.update', $invoice) }}">
        @csrf
        @method('PUT')

        {{-- Numer faktury nie zmieniamy w edycji, ale zostawiamy w formularzu --}}
        <div class="mb-3">
            <label class="form-label" for="invoice_number">
                <i data-feather="hash" class="me-1"></i>Invoice Number
            </label>
            <input
                type="text"
                name="invoice_number"
                id="invoice_number"
                class="form-control @error('invoice_number') is-invalid @enderror"
                value="{{ old('invoice_number', $invoice->invoice_number) }}"
                required
            >
            @error('invoice_number')
            <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        {{-- Issue Date --}}
        <div class="mb-3">
            <label class="form-label" for="issue_date">
                <i data-feather="calendar" class="me-1"></i>Issue Date
            </label>
            <input
                type="date"
                name="issue_date"
                id="issue_date"
                class="form-control @error('issue_date') is-invalid @enderror"
                value="{{ old('issue_date', $invoice->issue_date->format('Y-m-d')) }}"
                required
            >
            @error('issue_date')
            <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        {{-- Due Date --}}
        <div class="mb-3">
            <label class="form-label" for="due_date">
                <i data-feather="clock" class="me-1"></i>Due Date
            </label>
            <input
                type="date"
                name="due_date"
                id="due_date"
                class="form-control @error('due_date') is-invalid @enderror"
                value="{{ old('due_date', $invoice->due_date->format('Y-m-d')) }}"
                required
            >
            @error('due_date')
            <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        {{-- Total --}}
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
                value="{{ old('total', $invoice->total) }}"
                required
            >
            @error('total')
            <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between">
            <button class="btn btn-success d-inline-flex align-items-center">
                <i data-feather="save" class="me-1"></i> Update Invoice
            </button>
            <a href="{{ route('invoices.index') }}" class="btn btn-secondary d-inline-flex align-items-center">
                <i data-feather="arrow-left" class="me-1"></i> Cancel
            </a>
        </div>
    </form>
@endsection
