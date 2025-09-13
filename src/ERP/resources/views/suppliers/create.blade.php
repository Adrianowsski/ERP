@extends('layouts.app')
@section('title','Create Supplier')

@section('content')
    <h1 class="mb-4 d-flex align-items-center">
        <i data-feather="truck" class="me-1"></i> Create Supplier
    </h1>

    <form method="POST" action="{{ route('suppliers.store') }}">
        @csrf
        @include('suppliers.partials.form')

        <div class="d-flex justify-content-between">
            <button class="btn btn-success">
                <i data-feather="save" class="me-1"></i> Save Supplier
            </button>
            <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">
                <i data-feather="arrow-left" class="me-1"></i> Cancel
            </a>
        </div>
    </form>
@endsection
