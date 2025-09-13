@extends('layouts.app')
@section('title','Create Invoice')

@section('content')
    <h1 class="mb-4 d-flex align-items-center">
        <i data-feather="plus-circle" class="me-1"></i> Create Invoice
    </h1>

    <form method="POST" action="{{ route('invoices.store') }}">
        @csrf

        @include('invoices.partials.form')

        <div class="d-flex justify-content-between">
            <button class="btn btn-success d-inline-flex align-items-center">
                <i data-feather="save" class="me-1"></i> Save Invoice
            </button>
            <a href="{{ route('invoices.index') }}" class="btn btn-secondary d-inline-flex align-items-center">
                <i data-feather="arrow-left" class="me-1"></i> Cancel
            </a>
        </div>
    </form>
@endsection
