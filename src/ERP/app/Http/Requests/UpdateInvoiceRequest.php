<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class UpdateInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $invoiceId = $this->route('invoice')->id;

        return [
            'order_id' => ['required', 'exists:orders,id'],
            'invoice_number' => [
                'required', 'string', 'max:100',
                Rule::unique('invoices', 'invoice_number')->ignore($invoiceId),
                // pattern INV/YYYY/NNNN
                fn ($a, $v, $f) => ! preg_match('/^INV\/\d{4}\/\d{4}$/', $v)
                    ? $f('The invoice number format must be INV/YYYY/NNNN.')
                    : null,
            ],
            'issue_date' => ['required', 'date'],
            'due_date'   => [
                'required', 'date', 'after_or_equal:issue_date',
                // ≤ 90 days
                function ($a, $v, $f) {
                    if (Carbon::parse($this->input('issue_date'))->diffInDays(Carbon::parse($v)) > 90) {
                        $f('The due date may not be more than 90 days after the issue date.');
                    }
                },
            ],
            'total'      => ['required', 'numeric', 'between:0,9999999999.99'],
        ];
    }
}
