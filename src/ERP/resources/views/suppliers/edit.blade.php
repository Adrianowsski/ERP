@extends('layouts.app')
@section('title','Edit Supplier')

@section('content')
    <h1 class="mb-4 d-flex align-items-center">
        <i data-feather="edit-3" class="me-1"></i> Edit Supplier
    </h1>

    <form method="POST" action="{{ route('suppliers.update', $supplier) }}">
        @csrf
        @method('PUT')
        @include('suppliers.partials.form')

        <div class="d-flex justify-content-between">
            <button class="btn btn-success">
                <i data-feather="save" class="me-1"></i> Update Supplier
            </button>
            <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">
                <i data-feather="arrow-left" class="me-1"></i> Cancel
            </a>
        </div>
    </form>
@endsection
