@extends('layouts.app')
@section('title','Edit Client')

@section('content')
    <h1 class="mb-4"><i data-feather="edit-3" class="me-1"></i> Edit Client</h1>

    <form method="POST" action="{{ route('clients.update', $client) }}">
        @csrf
        @method('PUT')

        @include('clients.partials.form')

        <div class="d-flex justify-content-between">
            <button class="btn btn-success">
                <i data-feather="save" class="me-1"></i>Update Client
            </button>
            <a href="{{ route('clients.index') }}" class="btn btn-secondary">
                <i data-feather="arrow-left" class="me-1"></i>Cancel
            </a>
        </div>
    </form>
@endsection
