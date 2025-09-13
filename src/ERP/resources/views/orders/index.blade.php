@extends('layouts.app')
@section('title','Orders')

@section('content')
    <h1 class="mb-4 d-flex align-items-center">
        <i data-feather="file-text" class="me-2"></i> Orders
    </h1>

    {{-- 1️⃣ Pierwszy wiersz: Search + Search Button + Add Order --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-3">
        <form method="GET" class="d-flex gap-2 align-items-center">
            <input
                name="q"
                class="form-control rounded-pill px-3"
                placeholder="Search by Client or Status..."
                value="{{ request('q') }}"
                style="min-width: 200px;"
            >
            <button class="btn btn-outline-dark rounded-pill d-inline-flex align-items-center px-3">
                <i data-feather="search" class="me-1"></i> Search
            </button>
        </form>

        <a href="{{ route('orders.create') }}"
           class="btn btn-primary rounded-pill d-flex align-items-center px-4 py-2">
            <i data-feather="plus" class="me-1"></i> Add Order
        </a>
    </div>

    {{-- 2️⃣ Drugi wiersz: Sort + Sort Button --}}
    <div class="d-flex flex-column flex-md-row justify-content-start align-items-start align-items-md-center gap-2 mb-4">
        <form method="GET" class="d-flex gap-2 align-items-center">
            <select
                name="sort"
                class="form-select rounded-pill"
                style="min-width: 180px;"
            >
                <option value="">Sort by</option>
                <option value="date_asc"    @selected(request('sort')==='date_asc')>Date ↑</option>
                <option value="date_desc"   @selected(request('sort')==='date_desc')>Date ↓</option>
                <option value="status_asc"  @selected(request('sort')==='status_asc')>Status ↑</option>
                <option value="status_desc" @selected(request('sort')==='status_desc')>Status ↓</option>
            </select>
            <button class="btn btn-outline-dark rounded-pill d-inline-flex align-items-center px-3">
                <i data-feather="sliders" class="me-1"></i> Sort
            </button>
        </form>
    </div>

    {{-- Tabela zamówień --}}
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-bordered align-middle mb-0 bg-white">
            <thead class="table-light">
            <tr>
                <th style="width: 5%">#</th>
                <th>Client</th>
                <th>Order Date</th>
                <th>Status</th>
                <th class="text-end" style="width: 160px;">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>{{ $loop->iteration + ($orders->currentPage() - 1) * $orders->perPage() }}</td>
                    <td>{{ $order->client->name }}</td>
                    <td>{{ $order->order_date->format('Y-m-d') }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td class="text-end">
                        <a href="{{ route('orders.show', $order) }}"
                           class="btn btn-sm btn-light border d-inline-flex align-items-center me-1" title="View">
                            <i data-feather="eye" class="text-primary"></i>
                        </a>
                        <a href="{{ route('orders.edit', $order) }}"
                           class="btn btn-sm btn-light border d-inline-flex align-items-center me-1" title="Edit">
                            <i data-feather="edit-2" class="text-warning"></i>
                        </a>
                        <form method="POST" action="{{ route('orders.destroy', $order) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-light border d-inline-flex align-items-center"
                                    onclick="return confirm('Delete this order?')" title="Delete">
                                <i data-feather="trash-2" class="text-danger"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No orders found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $orders->withQueryString()->links() }}
    </div>
@endsection
