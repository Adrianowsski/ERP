<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class StoreInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'order_id'       => ['required', 'exists:orders,id'],
            'invoice_number' => [
                'required', 'string', 'max:100', 'unique:invoices,invoice_number',
                // ✅ 6) pattern INV/YYYY/NNNN
                function ($attribute, $value, $fail) {
                    if (! preg_match('/^INV\/\d{4}\/\d{4}$/', $value)) {
                        $fail('The invoice number format must be INV/YYYY/NNNN.');
                    }
                },
            ],
            'issue_date'     => ['required', 'date'],
            'due_date'       => [
                'required', 'date', 'after_or_equal:issue_date',
                // ✅ 7) ≤ 90 days after issue_date
                function ($attribute, $value, $fail) {
                    if (Carbon::parse($this->input('issue_date'))->diffInDays(Carbon::parse($value)) > 90) {
                        $fail('The due date may not be more than 90 days after the issue date.');
                    }
                },
            ],
            'total'          => ['required', 'numeric', 'between:0,9999999999.99'],
        ];
    }
}
