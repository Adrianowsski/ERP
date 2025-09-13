@extends('layouts.app')
@section('title','Invoice Details')

@section('content')
    <h1 class="mb-4 d-flex align-items-center">
        <i data-feather="info" class="me-1"></i>Invoice {{ $invoice->invoice_number }}
    </h1>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5>Client</h5>
                    <p>
                        <strong>{{ $invoice->order->client->name }}</strong><br>
                        {{ $invoice->order->client->address }}<br>
                        {{ $invoice->order->client->nip }}
                    </p>
                </div>
                <div class="col-md-6">
                    <h5>Invoice Details</h5>
                    <p><strong>Invoice No.</strong> {{ $invoice->invoice_number }}</p>
                    <p><strong>Issue Date:</strong> {{ $invoice->issue_date->format('Y-m-d') }}</p>
                    <p><strong>Due Date:</strong> {{ $invoice->due_date->format('Y-m-d') }}</p>
                    <p><strong>Total:</strong> {{ number_format($invoice->total, 2) }}</p>
                </div>
            </div>

            <h5 class="mt-4">Items</h5>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                    <tr>
                        <th style="width: 5%">#</th>
                        <th>Product</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-end">Price</th>
                        <th class="text-end">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($invoice->order->products as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->name }}</td>
                            <td class="text-center">{{ $product->pivot->quantity }}</td>
                            <td class="text-end">{{ number_format($product->pivot->price_sell, 2) }}</td>
                            <td class="text-end">
                                {{ number_format($product->pivot->quantity * $product->pivot->price_sell, 2) }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('invoices.edit', $invoice) }}" class="btn btn-warning d-inline-flex align-items-center">
                    <i data-feather="edit-2" class="me-1"></i> Edit
                </a>
                <div>
                    <a href="{{ route('invoices.pdf', $invoice) }}" class="btn btn-secondary d-inline-flex align-items-center me-2">
                        <i data-feather="download" class="me-1"></i> Download PDF
                    </a>
                    <a href="{{ route('invoices.index') }}" class="btn btn-secondary d-inline-flex align-items-center">
                        <i data-feather="arrow-left" class="me-1"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
