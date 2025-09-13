@extends('layouts.app')
@section('title','Edit Product')

@section('content')
    <h1 class="mb-4 d-flex align-items-center">
        <i data-feather="edit-3" class="me-1"></i> Edit Product
    </h1>

    <form method="POST" action="{{ route('products.update', $product) }}">
        @csrf
        @method('PUT')
        @include('products.partials.form')

        <div class="d-flex justify-content-between">
            <button class="btn btn-success">
                <i data-feather="save" class="me-1"></i> Update Product
            </button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">
                <i data-feather="arrow-left" class="me-1"></i> Cancel
            </a>
        </div>
    </form>
@endsection
