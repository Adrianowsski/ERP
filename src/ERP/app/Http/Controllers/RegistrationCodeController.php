<?php

namespace App\Http\Controllers;

use App\Models\RegistrationCode;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRegistrationCodeRequest;
use App\Http\Requests\UpdateRegistrationCodeRequest;

class RegistrationCodeController extends Controller
{
    public function index()
    {
        $codes = RegistrationCode::with('creator')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('registration_codes.index', compact('codes'));
    }

    public function create()
    {
        return view('registration_codes.create');
    }

    public function store(StoreRegistrationCodeRequest $request)
    {
        $data = $request->validated();
        // Dodajemy automatycznie created_by = aktualnie zalogowany użytkownik
        $data['created_by'] = auth()->id();

        RegistrationCode::create($data);
        return redirect()->route('registration-codes.index')
            ->with('success', 'Kod rejestracyjny został wygenerowany.');
    }

    public function show(RegistrationCode $registrationCode)
    {
        return view('registration_codes.show', compact('registrationCode'));
    }

    // edit i update pomijamy, jeżeli nie chcemy pozwalać na modyfikację kodów
    // (w trasach mieliśmy ->except(['show','edit','update']) – jeśli zostawisz show, usuń edit i update routes)
    public function edit(RegistrationCode $registrationCode)
    {
        return view('registration_codes.edit', compact('registrationCode'));
    }

    public function update(UpdateRegistrationCodeRequest $request, RegistrationCode $registrationCode)
    {
        $data = $request->validated();
        $registrationCode->update($data);

        return redirect()->route('registration-codes.index')
            ->with('success', 'Kod rejestracyjny został zaktualizowany.');
    }

    public function destroy(RegistrationCode $registrationCode)
    {
        $registrationCode->delete();
        return redirect()->route('registration-codes.index')
            ->with('success', 'Kod rejestracyjny został usunięty.');
    }
}
