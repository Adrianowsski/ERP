<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class UpdateOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'client_id'  => ['required', 'exists:clients,id'],
            'order_date' => [
                'required', 'date',
                // not future
                fn ($a, $v, $f) => Carbon::parse($v)->isFuture()
                    ? $f('The order date cannot be in the future.')
                    : null,
            ],
            'status' => ['required', 'string', 'max:50'],
            'products' => [
                'sometimes', 'array', 'min:1',
                // no duplicates
                function ($a, $v, $f) {
                    $ids = array_column($v ?? [], 'product_id');
                    if (count($ids) !== count(array_unique($ids))) {
                        $f('Duplicate products are not allowed in the order.');
                    }
                },
            ],
            'products.*.product_id' => ['required_with:products', 'integer', 'exists:products,id'],
            'products.*.quantity'   => ['required_with:products', 'integer', 'min:1'],
        ];
    }
}
