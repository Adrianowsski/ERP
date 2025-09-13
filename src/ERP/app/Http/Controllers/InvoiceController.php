<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    /**
     * Display a listing of invoices with optional search and sort.
     */
    public function index(Request $request)
    {
        $query = Invoice::with('order.client');

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('invoice_number', 'like', "%{$search}%")
                    ->orWhereHas('order.client', fn($q2) =>
                    $q2->where('name', 'like', "%{$search}%")
                    );
            });
        }

        switch ($request->sort) {
            case 'issue_asc':  $query->orderBy('issue_date', 'asc');  break;
            case 'issue_desc': $query->orderBy('issue_date', 'desc'); break;
            case 'due_asc':    $query->orderBy('due_date', 'asc');    break;
            case 'due_desc':   $query->orderBy('due_date', 'desc');   break;
            default:           $query->orderBy('issue_date', 'desc'); break;
        }

        $invoices = $query->paginate(10);

        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new invoice.
     */
    public function create()
    {
        $orders = Order::whereDoesntHave('invoice')
            ->with('client')
            ->orderBy('order_date', 'desc')
            ->get()
            ->mapWithKeys(fn($order) => [
                $order->id => "{$order->client->name} ({$order->order_date->format('Y-m-d')})"
            ]);

        return view('invoices.create', compact('orders'));
    }

    /**
     * Store a newly created invoice in storage.
     */
    public function store(StoreInvoiceRequest $request)
    {
        Invoice::create($request->validated());

        return redirect()
            ->route('invoices.index')
            ->with('success', 'Invoice has been created.');
    }

    /**
     * Display the specified invoice.
     */
    public function show(Invoice $invoice)
    {
        $invoice->load('order.client', 'order.products');
        return view('invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified invoice.
     */
    public function edit(Invoice $invoice)
    {
        return view('invoices.edit', compact('invoice'));
    }

    /**
     * Update the specified invoice in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        $invoice->update($request->validated());

        return redirect()
            ->route('invoices.index')
            ->with('success', 'Invoice has been updated.');
    }

    /**
     * Remove the specified invoice from storage (soft delete).
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()
            ->route('invoices.index')
            ->with('success', 'Invoice has been deleted.');
    }

    /**
     * Generate and download PDF of the invoice.
     */
    public function downloadPdf(Invoice $invoice)
    {
        $invoice->load('order.client', 'order.products');

        $pdf = Pdf::loadView('invoices.pdf', compact('invoice'));

        // sanitize filename
        $safeNumber = str_replace(['/', '\\'], '-', $invoice->invoice_number);
        $filename   = "invoice_{$safeNumber}.pdf";

        return $pdf->download($filename);
    }
}
