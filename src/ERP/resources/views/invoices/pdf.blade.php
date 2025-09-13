<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <style>
        /* --------------------------------------------------
           PAGE MARGINS FOR PDF
           -------------------------------------------------- */
        @page { margin: 20mm 10mm 20mm 10mm; }
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.4;
            margin: 0; padding: 0;
        }
        h1, h2, h3 { margin: 0; padding: 0; }
        .container { width: 100%; padding: 0 10px; box-sizing: border-box; }

        /* --------------------------------------------------
           HEADER: LOGO + COMPANY DETAILS (left),
                   INVOICE META (right)
           -------------------------------------------------- */
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
        }
        .company-info { width: 50%; }
        .company-logo { max-width: 180px; margin-bottom: 10px; }
        .company-info p { margin: 2px 0; font-size: 11px; }
        .invoice-meta { text-align: right; width: 50%; }
        .invoice-meta h1 {
            font-size: 24px; color: #2c3e50; margin-bottom: 5px;
        }
        .invoice-meta p { font-size: 11px; margin: 2px 0; }

        /* --------------------------------------------------
           BILL TO SECTION
           -------------------------------------------------- */
        .billing-info {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
        }
        .billing-info h2 {
            font-size: 16px; margin-bottom: 8px; color: #2c3e50;
        }
        .billing-info p { margin: 3px 0; font-size: 11px; }

        /* --------------------------------------------------
           ITEMS TABLE
           -------------------------------------------------- */
        table {
            width: 100%; border-collapse: collapse; margin-bottom: 15px;
        }
        table thead tr { background-color: #f6f6f6; }
        table th, table td {
            border: 1px solid #999; padding: 6px; font-size: 11px;
        }
        table th { text-align: center; font-weight: bold; }
        table td { vertical-align: middle; }
        table .text-center { text-align: center; }
        table .text-right { text-align: right; }

        /* --------------------------------------------------
           SUMMARY (NET / VAT / GROSS)
           -------------------------------------------------- */
        .summary {
            width: 100%; margin-top: 10px; display: flex; justify-content: flex-end;
        }
        .summary-table {
            width: 40%; border-collapse: collapse;
        }
        .summary-table td {
            border: 1px solid #999; padding: 6px; font-size: 11px;
        }
        .summary-table .label { background-color: #f6f6f6; }
        .summary-table .amount { text-align: right; }

        /* --------------------------------------------------
           FOOTER (PAYMENT TERMS, NOTES)
           -------------------------------------------------- */
        .invoice-footer {
            margin-top: 30px; border-top: 1px solid #ccc; padding-top: 10px;
            font-size: 10px; color: #666; line-height: 1.3;
        }
    </style>
</head>
<body>
<div class="container">

    {{-- --------------------------------------------------
         HEADER: Company data & Invoice metadata
       -------------------------------------------------- --}}
    <div class="invoice-header">
        <div class="company-info">
            {{-- LOGO: wstaw swoją ścieżkę do logo lub placeholder --}}
            @if(file_exists(public_path('images/logo.png')))
                <img src="{{ public_path('images/logo.png') }}" alt="Company Logo" class="company-logo">
            @else
                <p><em>Your Company Logo Here</em></p>
            @endif

            {{-- DANE FIRMY: Dostosuj pod swoje --}}
            <p><strong>Your Company Ltd.</strong></p>
            <p>123 Business St.</p>
            <p>Cityville, 54321</p>
            <p>Country</p>
            <p>VAT ID: 12-3456789</p>
            <p>Reg. No: 987654321</p>
            <p>Phone: +1 234 567 890</p>
            <p>Email: billing@yourcompany.com</p>
        </div>

        <div class="invoice-meta">
            <h1>INVOICE</h1>
            <p><strong>Invoice No:</strong> {{ $invoice->invoice_number }}</p>
            <p><strong>Issue Date:</strong> {{ $invoice->issue_date->format('Y-m-d') }}</p>
            <p><strong>Sale Date:</strong> {{ $invoice->issue_date->format('Y-m-d') }}</p>
            <p><strong>Due Date:</strong> {{ $invoice->due_date->format('Y-m-d') }}</p>
        </div>
    </div>

    {{-- --------------------------------------------------
         BILL TO: Client information
       -------------------------------------------------- --}}
    <div class="billing-info">
        <h2>Bill To</h2>
        <p><strong>{{ $invoice->order->client->name }}</strong></p>
        <p>{{ $invoice->order->client->address }}</p>
        <p>VAT/Tax ID: {{ $invoice->order->client->nip }}</p>
    </div>

    {{-- --------------------------------------------------
         ITEMS LINE-ITEMS TABLE
       -------------------------------------------------- --}}
    <table>
        <thead>
        <tr>
            <th style="width: 5%;">No.</th>
            <th style="width: 45%;">Description</th>
            <th style="width: 15%;">Quantity</th>
            <th style="width: 15%;">Unit Price (net)</th>
            <th style="width: 20%;">Line Total (net)</th>
        </tr>
        </thead>
        <tbody>
        @php $sumNet = 0; @endphp

        @foreach($invoice->order->products as $product)
            @php
                $lineNet = $product->pivot->quantity * $product->pivot->price_sell;
                $sumNet += $lineNet;
            @endphp
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $product->name }}</td>
                <td class="text-center">{{ $product->pivot->quantity }}</td>
                <td class="text-right">
                    {{ number_format($product->pivot->price_sell, 2, '.', ',') }}
                </td>
                <td class="text-right">
                    {{ number_format($lineNet, 2, '.', ',') }}
                </td>
            </tr>
        @endforeach

        @if($invoice->order->products->isEmpty())
            <tr>
                <td colspan="5" class="text-center">No items to display</td>
            </tr>
        @endif
        </tbody>
    </table>

    {{-- --------------------------------------------------
         SUMMARY: NET / VAT / GROSS
       -------------------------------------------------- --}}
    @php
        $vatRate = 0.23; // 23% VAT
        $netto  = $sumNet;
        $vat    = round($netto * $vatRate, 2);
        $brutto = $netto + $vat;
    @endphp

    <div class="summary">
        <table class="summary-table">
            <tbody>
            <tr>
                <td class="label">Total (net):</td>
                <td class="amount">{{ number_format($netto, 2, '.', ',') }} USD</td>
            </tr>
            <tr>
                <td class="label">VAT ({{ intval($vatRate * 100) }}%):</td>
                <td class="amount">{{ number_format($vat, 2, '.', ',') }} USD</td>
            </tr>
            <tr>
                <td class="label"><strong>Total (gross):</strong></td>
                <td class="amount"><strong>{{ number_format($brutto, 2, '.', ',') }} USD</strong></td>
            </tr>
            </tbody>
        </table>
    </div>

    {{-- --------------------------------------------------
         FOOTER: PAYMENT TERMS & NOTES
       -------------------------------------------------- --}}
    <div class="invoice-footer">
        <p><strong>Payment Terms:</strong> Bank transfer by {{ $invoice->due_date->format('Y-m-d') }} to:</p>
        <p>Bank of World – Account No: 12345678901234567890</p>
        <p><strong>Issued By:</strong> John Smith</p>
        <p><em>If you have any questions, please contact billing@yourcompany.com | +1 234 567 890</em></p>
        <p style="margin-top: 20px; font-size: 10px; text-align: center;">
            This document was generated electronically and does not require a signature.
        </p>
    </div>

</div>
</body>
</html>
