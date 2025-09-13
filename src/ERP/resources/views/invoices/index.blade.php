@extends('layouts.app')
@section('title','Invoices')

@section('content')
    <h1 class="mb-4 d-flex align-items-center">
        <i data-feather="file-text" class="me-2"></i> Invoices
    </h1>

    {{-- 1️⃣ Pierwszy wiersz: Search + Search Button + Add Invoice --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-3">
        <form method="GET" class="d-flex gap-2 align-items-center">
            <input
                name="q"
                class="form-control rounded-pill px-3"
                placeholder="Search by Number or Client..."
                value="{{ request('q') }}"
                style="min-width: 200px;"
            >
            <button class="btn btn-outline-dark rounded-pill d-inline-flex align-items-center px-3">
                <i data-feather="search" class="me-1"></i> Search
            </button>
        </form>

        <a href="{{ route('invoices.create') }}"
           class="btn btn-primary rounded-pill d-inline-flex align-items-center px-4 py-2">
            <i data-feather="plus" class="me-1"></i> Add Invoice
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
                <option value="issue_asc"   @selected(request('sort')==='issue_asc')>Issue Date ↑</option>
                <option value="issue_desc"  @selected(request('sort')==='issue_desc')>Issue Date ↓</option>
                <option value="due_asc"     @selected(request('sort')==='due_asc')>Due Date ↑</option>
                <option value="due_desc"    @selected(request('sort')==='due_desc')>Due Date ↓</option>
            </select>
            <button class="btn btn-outline-dark rounded-pill d-inline-flex align-items-center px-3">
                <i data-feather="sliders" class="me-1"></i> Sort
            </button>
        </form>
    </div>

    {{-- Tabela faktur --}}
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-bordered align-middle mb-0 bg-white">
            <thead class="table-light">
            <tr>
                <th style="width: 5%">#</th>
                <th style="width: 8%">Invoice No.</th>
                <th style="width: 15%">Issue Date</th>
                <th style="width: 15%">Due Date</th>
                <th style="width: 12%">Total</th>
                <th style="width: 35%">Client</th>
                <th class="text-end" style="width: 180px;">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($invoices as $invoice)
                <tr>
                    <td>{{ $loop->iteration + ($invoices->currentPage() - 1) * $invoices->perPage() }}</td>
                    <td>{{ $invoice->invoice_number }}</td>
                    <td>{{ $invoice->issue_date->format('Y-m-d') }}</td>
                    <td>{{ $invoice->due_date->format('Y-m-d') }}</td>
                    <td>{{ number_format($invoice->total, 2) }}</td>
                    <td>{{ $invoice->order->client->name }}</td>

                    {{-- tutaj d-flex flex-nowrap wymusza pojedynczy wiersz --}}
                    <td class="text-end d-flex flex-row justify-content-end flex-nowrap">
                        <a href="{{ route('invoices.show', $invoice) }}"
                           class="btn btn-sm btn-light border d-inline-flex align-items-center me-1"
                           title="View">
                            <i data-feather="eye" class="text-primary"></i>
                        </a>
                        <a href="{{ route('invoices.edit', $invoice) }}"
                           class="btn btn-sm btn-light border d-inline-flex align-items-center me-1"
                           title="Edit">
                            <i data-feather="edit-2" class="text-warning"></i>
                        </a>
                        <a href="{{ route('invoices.pdf', $invoice) }}"
                           class="btn btn-sm btn-light border d-inline-flex align-items-center me-1"
                           title="Download PDF">
                            <i data-feather="download" class="text-success"></i>
                        </a>
                        <form method="POST" action="{{ route('invoices.destroy', $invoice) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-light border d-inline-flex align-items-center"
                                    onclick="return confirm('Delete this invoice?')"
                                    title="Delete">
                                <i data-feather="trash-2" class="text-danger"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">No invoices found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $invoices->withQueryString()->links() }}
    </div>
@endsection
