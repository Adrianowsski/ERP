@extends('layouts.app')
@section('title','Product Details')

@section('content')
    <h1 class="mb-4 d-flex align-items-center">
        <i data-feather="info" class="me-1"></i> Product Details
    </h1>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-4">Name</dt>
                <dd class="col-sm-8">{{ $product->name }}</dd>

                <dt class="col-sm-4">Description</dt>
                <dd class="col-sm-8">{{ $product->description }}</dd>

                <dt class="col-sm-4">Price Buy</dt>
                <dd class="col-sm-8">{{ number_format($product->price_buy, 2) }}</dd>

                <dt class="col-sm-4">Price Sell</dt>
                <dd class="col-sm-8">{{ number_format($product->price_sell, 2) }}</dd>

                <dt class="col-sm-4">Supplier</dt>
                <dd class="col-sm-8">{{ $product->supplier->name }}</dd>
            </dl>

            <div class="d-flex justify-content-between">
                <a href="{{ route('products.edit', $product) }}" class="btn btn-warning d-flex align-items-center">
                    <i data-feather="edit-2" class="me-1"></i> Edit
                </a>
                <a href="{{ route('products.index') }}" class="btn btn-secondary d-flex align-items-center">
                    <i data-feather="arrow-left" class="me-1"></i> Back
                </a>
            </div>
        </div>
    </div>
@endsection
