<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'price_buy'   => ['required', 'numeric', 'between:0,99999999.99'],
            'price_sell'  => [
                'required', 'numeric', 'between:0,99999999.99',
                // selling ≥ buying
                fn ($a, $v, $f) => $v < $this->input('price_buy')
                    ? $f('The selling price must be greater than or equal to the buying price.')
                    : null,
            ],
            'supplier_id' => ['required', 'exists:suppliers,id'],
        ];
    }
}
