<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\RegistrationCode;
use App\Models\User;
use Illuminate\Auth\Events\registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View; // dodaj import View

class RegisteredUserController extends Controller
{
    /**
     * Wyświetla formularz rejestracji.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Obsługuje POST /register – tworzy nowego użytkownika.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => 'required|string|email|max:255|unique:users',
            'password'          => 'required|string|confirmed|min:8',
            'registration_code' => 'required|string|exists:registration_codes,code',
        ]);

        // Sprawdź, czy kod nie został już użyty:
        $code = RegistrationCode::where('code', $request->registration_code)->first();

        if ($code->is_used) {
            return back()->withErrors(['registration_code' => 'Ten kod został już wykorzystany']);
        }

        // Oznacz kod jako użyty:
        $code->update(['is_used' => true]);

        // Stwórz nowego użytkownika z domyślną rolą 'user':
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user',
        ]);

        event(new registered($user));

        auth()->login($user);

        return redirect()->route('dashboard');
    }
}
