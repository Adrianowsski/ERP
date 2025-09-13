<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $clientId = $this->route('client')->id;

        return [
            'name'  => ['required', 'string', 'max:255'],
            'nip'   => [
                'required', 'string', 'max:20',
                Rule::unique('clients', 'nip')->ignore($clientId),
                // NIP checksum
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
            'email' => [
                'required', 'string', 'email', 'max:255',
                Rule::unique('clients', 'email')->ignore($clientId),
            ],
            'phone' => [
                'nullable', 'string', 'max:50',
                fn ($a, $v, $f) => $v !== null && ! preg_match('/^\+?\d+$/', $v)
                    ? $f('The phone number may contain only digits and an optional leading “+”.')
                    : null,
            ],
            'address' => ['nullable', 'string', 'max:1000'],
        ];
    }
}
