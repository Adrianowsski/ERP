@extends('layouts.app')
@section('title','Create Order')

@section('content')
    <h1 class="mb-4 d-flex align-items-center">
        <i data-feather="file-plus" class="me-1"></i> Create Order
    </h1>

    <form method="POST" action="{{ route('orders.store') }}">
        @csrf
        @include('orders.partials.form')

        <div class="d-flex justify-content-between">
            <button class="btn btn-success">
                <i data-feather="save" class="me-1"></i> Save Order
            </button>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                <i data-feather="arrow-left" class="me-1"></i> Cancel
            </a>
        </div>
    </form>
@endsection
