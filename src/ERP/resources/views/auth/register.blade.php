@extends('layouts.app')
@section('title','Register')

@section('content')
    <div class="row justify-content-center py-5">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-header text-center bg-white fw-bold">
                    <i data-feather="user-plus" class="me-1"></i> Register
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label" for="name">Name</label>
                            <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus>
                            @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                            @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input id="password" type="password" name="password" class="form-control" required>
                            @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="password_confirmation">Confirm Password</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="registration_code">Registration Code</label>
                            <input id="registration_code" type="text" name="registration_code" class="form-control" value="{{ old('registration_code') }}" required>
                            @error('registration_code') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i data-feather="user-check" class="me-1"></i> Register
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
