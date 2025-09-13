<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegistrationCodeRequest extends FormRequest
{
    public function authorize()
    {
        // Załóżmy, że tylko administrator (rola = "admin") może tworzyć kody rejestracyjne:
        return auth()->check() && auth()->user()->isAdmin();
    }

    public function rules()
    {
        return [
            'code' => ['required', 'string', 'max:100', 'unique:registration_codes,code'],
            // 'is_used' definiujemy domyślnie w migracji (false), więc nie pozwalamy na jego ustawianie przy tworzeniu:
        ];
    }

    public function messages()
    {
        return [
            'code.unique' => 'Podany kod rejestracyjny już istnieje.',
        ];
    }
}
