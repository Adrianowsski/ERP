@extends('layouts.app')
@section('title','Products')

@section('content')
    <h1 class="mb-4 d-flex align-items-center">
        <i data-feather="box" class="me-2"></i> Products
    </h1>

    {{-- 1️⃣ Pierwszy wiersz: Search + Search Button obok siebie + Add Product --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-3">
        <form method="GET" class="d-flex gap-2 align-items-center">
            <input
                name="q"
                class="form-control rounded-pill px-3"
                placeholder="Search..."
                value="{{ request('q') }}"
                style="min-width: 200px;"
            >
            <button class="btn btn-outline-dark rounded-pill d-inline-flex align-items-center px-3">
                <i data-feather="search" class="me-1"></i> Search
            </button>
        </form>

        <a href="{{ route('products.create') }}"
           class="btn btn-primary rounded-pill d-flex align-items-center px-4 py-2">
            <i data-feather="plus" class="me-1"></i> Add Product
        </a>
    </div>

    {{-- 2️⃣ Drugi wiersz: Sort + Sort Button obok siebie --}}
    <div class="d-flex flex-column flex-md-row justify-content-start align-items-start align-items-md-center gap-2 mb-4">
        <form method="GET" class="d-flex gap-2 align-items-center">
            <select
                name="sort"
                class="form-select rounded-pill"
                style="min-width: 200px;"
            >
                <option value="">Sort by</option>
                <option value="name_asc"       @selected(request('sort')==='name_asc')>Name (A-Z)</option>
                <option value="name_desc"      @selected(request('sort')==='name_desc')>Name (Z-A)</option>
                <option value="price_buy_asc"  @selected(request('sort')==='price_buy_asc')>Price Buy ↑</option>
                <option value="price_buy_desc" @selected(request('sort')==='price_buy_desc')>Price Buy ↓</option>
                <option value="price_sell_asc" @selected(request('sort')==='price_sell_asc')>Price Sell ↑</option>
                <option value="price_sell_desc"@selected(request('sort')==='price_sell_desc')>Price Sell ↓</option>
            </select>
            <button class="btn btn-outline-dark rounded-pill d-inline-flex align-items-center px-3">
                <i data-feather="sliders" class="me-1"></i> Sort
            </button>
        </form>
    </div>

    {{-- Tabela produktów --}}
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-bordered align-middle mb-0 bg-white">
            <thead class="table-light">
            <tr>
                <th style="width: 5%">#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price Buy</th>
                <th>Price Sell</th>
                <th>Supplier</th>
                <th class="text-end" style="width: 160px;">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($products as $product)
                <tr>
                    <td>{{ $loop->iteration + ($products->currentPage() - 1) * $products->perPage() }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ number_format($product->price_buy, 2) }}</td>
                    <td>{{ number_format($product->price_sell, 2) }}</td>
                    <td>{{ $product->supplier->name }}</td>
                    <td class="text-end">
                        <a href="{{ route('products.show', $product) }}"
                           class="btn btn-sm btn-light border d-inline-flex align-items-center me-1" title="View">
                            <i data-feather="eye" class="text-primary"></i>
                        </a>
                        <a href="{{ route('products.edit', $product) }}"
                           class="btn btn-sm btn-light border d-inline-flex align-items-center me-1" title="Edit">
                            <i data-feather="edit-2" class="text-warning"></i>
                        </a>
                        <form method="POST" action="{{ route('products.destroy', $product) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-light border d-inline-flex align-items-center"
                                    onclick="return confirm('Delete this product?')" title="Delete">
                                <i data-feather="trash-2" class="text-danger"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">No products found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $products->withQueryString()->links() }}
    </div>
@endsection
