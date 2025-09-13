@extends('layouts.app')
@section('title','Create Product')

@section('content')
    <h1 class="mb-4 d-flex align-items-center">
        <i data-feather="box" class="me-1"></i> Create Product
    </h1>

    <form method="POST" action="{{ route('products.store') }}">
        @csrf
        @include('products.partials.form')

        <div class="d-flex justify-content-between">
            <button class="btn btn-success">
                <i data-feather="save" class="me-1"></i> Save Product
            </button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">
                <i data-feather="arrow-left" class="me-1"></i> Cancel
            </a>
        </div>
    </form>
@endsection
