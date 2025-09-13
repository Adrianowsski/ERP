@extends('layouts.app')
@section('title','Login')

@section('content')
    <div class="row justify-content-center py-5">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-header text-center bg-white fw-bold">
                    <i data-feather="log-in" class="me-1"></i> Login
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="remember" id="remember">
                            <label class="form-check-label" for="remember">Remember Me</label>
                        </div>
                        <button class="btn btn-primary w-100">
                            <i data-feather="unlock" class="me-1"></i> Login
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
