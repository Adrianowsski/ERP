<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use App\Models\Invoice;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke()
    {
        /* ── KPI counters ───────────────────────────────────────── */
        $stats = [
            'clients'  => Client::count(),
            'products' => Product::count(),
            'orders'   => Order::count(),
            'invoices' => Invoice::count(),
        ];

        /* ── Revenue today / this-month ─────────────────────────── */
        $today        = Carbon::today();
        $monthStart   = $today->copy()->startOfMonth();
        $revenueToday = Invoice::whereDate('issue_date', $today)->sum('total');
        $revenueMonth = Invoice::whereBetween('issue_date', [$monthStart, $today])->sum('total');

        /* ── 12-month orders & revenue data ─────────────────────── */
        $months = collect(range(11, 0))
            ->map(fn ($i) => now()->subMonths($i)->format('M Y'));

        $ordersMonthly = Order::selectRaw('DATE_FORMAT(created_at,"%b %Y") m, COUNT(*) total')
            ->where('created_at', '>=', now()->subMonths(11)->startOfMonth())
            ->groupBy('m')->pluck('total', 'm');

        $revenueMonthly = Invoice::selectRaw('DATE_FORMAT(issue_date,"%b %Y") m, SUM(total) revenue')
            ->where('issue_date', '>=', now()->subMonths(11)->startOfMonth())
            ->groupBy('m')->pluck('revenue', 'm');

        // Fill gaps with zeros so the charts look nice
        $ordersMonthly  = $months->mapWithKeys(fn ($m) => [$m => $ordersMonthly[$m]  ?? 0]);
        $revenueMonthly = $months->mapWithKeys(fn ($m) => [$m => $revenueMonthly[$m] ?? 0]);

        /* ── Order-status doughnut ──────────────────────────────── */
        $statusCounts = Order::select('status', DB::raw('COUNT(*) total'))
            ->groupBy('status')->pluck('total', 'status');

        /* ── Latest & top lists ─────────────────────────────────── */
        $latestOrders = Order::with('client')->latest()->take(5)->get();
        $topProducts  = Product::withCount('orders')
            ->orderByDesc('orders_count')->take(5)->get();

        return view('dashboard', [
            'stats'          => $stats,
            'revenueToday'   => $revenueToday,
            'revenueMonth'   => $revenueMonth,
            'months'         => $months,
            'ordersMonthly'  => collect($ordersMonthly),
            'revenueMonthly' => collect($revenueMonthly),
            'statusCounts'   => $statusCounts,
            'latestOrders'   => $latestOrders,
            'topProducts'    => $topProducts,
        ]);
    }
}
