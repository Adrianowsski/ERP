<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRegistrationCodeRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    public function rules()
    {
        // Metoda route('registration_code') z resource Route-model binding
        $regCodeId = $this->route('registration_code')->id;

        return [
            'code' => [
                'required',
                'string',
                'max:100',
                Rule::unique('registration_codes', 'code')->ignore($regCodeId),
            ],
            'is_used' => ['required', 'boolean'],
        ];
    }

    public function messages()
    {
        return [
            'code.unique' => 'Podany kod rejestracyjny już istnieje.',
        ];
    }
}
