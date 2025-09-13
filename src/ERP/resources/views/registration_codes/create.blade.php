@extends('layouts.app')
@section('title','Generate Code')

@section('content')
    <h1 class="mb-4 d-flex align-items-center">
        <i data-feather="key" class="me-2"></i> Generate Registration Code
    </h1>

    {{-- Import Str::random w tym widoku --}}
    @php use Illuminate\Support\Str; @endphp

    <form method="POST" action="{{ route('registration-codes.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label" for="code">
                <i data-feather="hash" class="me-1"></i>Code
            </label>
            <input
                type="text"
                name="code"
                id="code"
                class="form-control @error('code') is-invalid @enderror"
                value="{{ old('code', Str::random(10)) }}"
                required
            >
            @error('code')
            <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between">
            <button class="btn btn-success d-inline-flex align-items-center">
                <i data-feather="save" class="me-1"></i> Save
            </button>
            <a href="{{ route('registration-codes.index') }}"
               class="btn btn-secondary d-inline-flex align-items-center">
                <i data-feather="arrow-left" class="me-1"></i> Back
            </a>
        </div>
    </form>
@endsection
