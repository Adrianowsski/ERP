@extends('layouts.app')
@section('title','Dashboard')

@push('styles')
    <style>
        /* helpers */
        .quick-actions .btn{min-width:135px}
        .kpi-card{min-height:110px;display:flex;flex-direction:column;justify-content:center}
        .kpi-card .value{font-size:2.25rem;font-weight:700}
        .chart-wrapper{height:260px}
        .table-xs td{padding:.35rem .5rem;font-size:.875rem}
        .table-fixed{table-layout:fixed}
        .scroll-y{max-height:235px;overflow-y:auto}
    </style>
@endpush

@php use Illuminate\Support\Str; @endphp

@section('content')
    <h1 class="mb-4">Dashboard</h1>

    {{-- QUICK ACTIONS --}}
    <div class="quick-actions d-flex flex-wrap gap-2 mb-4">
        <a class="btn btn-primary" href="{{ route('clients.create') }}"><i class="bi bi-person-plus me-1"></i>New Client</a>
        <a class="btn btn-primary" href="{{ route('orders.create') }}"><i class="bi bi-bag-plus me-1"></i>New Order</a>
        <a class="btn btn-primary" href="{{ route('products.create') }}"><i class="bi bi-box-seam me-1"></i>New Product</a>
        <a class="btn btn-success" href="{{ route('invoices.create') }}"><i class="bi bi-file-earmark-text me-1"></i>New Invoice</a>
    </div>

    {{-- KPI ROW --}}
    <div class="row g-3 mb-4">
        @foreach($stats as $label => $count)
            <div class="col-6 col-md-4 col-lg-2">
                <div class="card border-0 shadow-sm kpi-card text-center">
                    <div class="text-uppercase small text-muted">{{ $label }}</div>
                    <div class="value">{{ $count }}</div>
                </div>
            </div>
        @endforeach
        <div class="col-6 col-md-4 col-lg-2">
            <div class="card border-0 shadow-sm kpi-card text-center bg-light">
                <div class="small text-muted">Revenue Month</div>
                <div class="value">{{ number_format($revenueMonth,2) }} €</div>
                <div class="small text-muted mt-1">Today: {{ number_format($revenueToday,2) }} €</div>
            </div>
        </div>
    </div>

    {{-- CHARTS --}}
    <div class="row g-4">
        <div class="col-xl-6">
            <div class="card shadow-sm h-100">
                <div class="card-header">Orders – Last 12 Months</div>
                <div class="card-body chart-wrapper"><canvas id="ordersChart"></canvas></div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card shadow-sm h-100">
                <div class="card-header">Revenue – Last 12 Months</div>
                <div class="card-body chart-wrapper"><canvas id="revenueChart"></canvas></div>
            </div>
        </div>
    </div>

    {{-- LOWER GRID --}}
    <div class="row g-4 mt-3">
        <div class="col-xl-4">
            <div class="card shadow-sm h-100">
                <div class="card-header">Order Status Mix</div>
                <div class="card-body chart-wrapper"><canvas id="statusChart"></canvas></div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card shadow-sm h-100 d-flex flex-column">
                <div class="card-header">Latest Orders</div>
                <div class="card-body p-0 flex-grow-1 scroll-y">
                    <table class="table table-hover mb-0 table-xs table-fixed">
                        <tbody>
                        @forelse($latestOrders as $o)
                            <tr>
                                <td class="text-muted">#{{ $o->id }}</td>
                                <td>{{ Str::limit($o->client->name ?? '—', 22) }}</td>
                                <td>{{ $o->created_at->format('d M') }}</td>
                                <td>
                                <span class="badge bg-{{ $o->status==='completed'?'success':'warning' }}">
                                    {{ ucfirst($o->status) }}
                                </span>
                                </td>
                                <td class="text-end">{{ number_format($o->total,2) }} €</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="py-4 text-center text-muted">No orders yet</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-white text-end">
                    <a href="{{ route('orders.index') }}" class="btn btn-sm btn-outline-secondary">All Orders</a>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card shadow-sm h-100 d-flex flex-column">
                <div class="card-header">Top Products (This Year)</div>
                <div class="card-body p-0 flex-grow-1 scroll-y">
                    <table class="table mb-0 table-xs table-fixed">
                        <tbody>
                        @forelse($topProducts as $p)
                            <tr>
                                <td>{{ Str::limit($p->name, 28) }}</td>
                                <td class="text-end">{{ $p->orders_count }} orders</td>
                            </tr>
                        @empty
                            <tr><td colspan="2" class="py-4 text-center text-muted">No data</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-white text-end">
                    <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-secondary">All Products</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const labels      = @json($months);
            const ordersData  = @json($ordersMonthly->values());
            const revenueData = @json($revenueMonthly->values());

            new Chart(ordersChart, {
                type:'bar',
                data:{labels,datasets:[{label:'Orders',data:ordersData,backgroundColor:'#0d6efd80'}]},
                options:{maintainAspectRatio:false,scales:{y:{beginAtZero:true}}}
            });

            new Chart(revenueChart, {
                type:'line',
                data:{labels,datasets:[{label:'Revenue (€)',data:revenueData,borderWidth:2,tension:.35}]},
                options:{maintainAspectRatio:false,scales:{y:{beginAtZero:true}}}
            });

            new Chart(statusChart, {
                type:'doughnut',
                data:{labels:@json($statusCounts->keys()),datasets:[{data:@json($statusCounts->values())}]},
                options:{maintainAspectRatio:false,plugins:{legend:{position:'bottom'}}}
            });
        });
    </script>
@endpush
