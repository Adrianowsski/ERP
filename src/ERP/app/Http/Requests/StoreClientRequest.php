<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class StoreClientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name'    => ['required', 'string', 'max:255'],
            'nip'     => [
                'required', 'string', 'max:20', 'unique:clients,nip',
                // ✅ 1) NIP checksum (Polish VAT No.)
                function ($attribute, $value, $fail) {
                    $digits = preg_replace('/\D/', '', $value);
                    if (strlen($digits) !== 10) {
                        return $fail('The VAT number must contain 10 digits.');
                    }
                    $w = [6, 5, 7, 2, 3, 4, 5, 6, 7];
                    $sum = array_sum(array_map(fn ($d, $k) => $d * $w[$k], str_split(substr($digits, 0, 9)), array_keys($w)));
                    if ($sum % 11 !== (int) $digits[9]) {
                        $fail('The VAT number checksum is invalid.');
                    }
                },
            ],
            'email'   => ['required', 'string', 'email', 'max:255', 'unique:clients,email'],
            'phone'   => [
                'nullable', 'string', 'max:50',
                // ✅ 2) digits-only phone (optional “+”)
                function ($attribute, $value, $fail) {
                    if ($value !== null && ! preg_match('/^\+?\d+$/', $value)) {
                        $fail('The phone number may contain only digits and an optional leading “+”.');
                    }
                },
            ],
            'address' => ['nullable', 'string', 'max:1000'],
        ];
    }
}
