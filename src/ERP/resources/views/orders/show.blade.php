@extends('layouts.app')
@section('title','Order Details')

@section('content')
    <h1 class="mb-4 d-flex align-items-center">
        <i data-feather="info" class="me-1"></i> Order Details #{{ $order->id }}
    </h1>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-4">Client</dt>
                <dd class="col-sm-8">{{ $order->client->name }}</dd>

                <dt class="col-sm-4">Order Date</dt>
                <dd class="col-sm-8">{{ $order->order_date->format('Y-m-d') }}</dd>

                <dt class="col-sm-4">Status</dt>
                <dd class="col-sm-8">{{ ucfirst($order->status) }}</dd>
            </dl>
        </div>
    </div>

    <h5 class="mb-3">Ordered Products</h5>
    @if($order->products->count())
        <table class="table table-bordered">
            <thead>
            <tr>
                <th style="width: 5%">#</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price Buy</th>
                <th>Price Sell</th>
                <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->pivot->quantity }}</td>
                    <td>{{ number_format($product->pivot->price_buy, 2) }}</td>
                    <td>{{ number_format($product->pivot->price_sell, 2) }}</td>
                    <td>{{ number_format($product->pivot->quantity * $product->pivot->price_sell, 2) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="text-end mb-4">
            <h5>
                Grand Total:
                {{ number_format($order->products->sum(fn($p) => $p->pivot->quantity * $p->pivot->price_sell), 2) }}
            </h5>
        </div>
    @else
        <p>No products in this order.</p>
    @endif

    <div class="d-flex justify-content-between">
        <a href="{{ route('orders.edit', $order) }}" class="btn btn-warning d-flex align-items-center">
            <i data-feather="edit-2" class="me-1"></i> Edit
        </a>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary d-flex align-items-center">
            <i data-feather="arrow-left" class="me-1"></i> Back
        </a>
    </div>
@endsection
