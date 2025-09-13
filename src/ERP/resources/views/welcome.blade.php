@extends('layouts.app')
@section('title','Welcome')

@section('content')
    <div class="text-center py-5">
        <h1 class="display-4 mb-4">Welcome to <span class="text-primary fw-bold">ERP App</span></h1>
        <p class="lead mb-4">Manage clients, suppliers, orders and invoices seamlessly in one unified system.</p>

        @guest
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg me-2">
                <i data-feather="user-plus" class="me-1"></i> Sign Up
            </a>
            <a href="{{ route('login') }}" class="btn btn-outline-dark btn-lg">
                <i data-feather="log-in" class="me-1"></i> Login
            </a>
        @endguest
    </div>
@endsection
