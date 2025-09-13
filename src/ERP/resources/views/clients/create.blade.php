@extends('layouts.app')
@section('title','Create Client')

@section('content')
    <h1 class="mb-4"><i data-feather="plus-circle" class="me-1"></i> Create Client</h1>

    <form method="POST" action="{{ route('clients.store') }}">
        @csrf
        @include('clients.partials.form')

        <div class="d-flex justify-content-between">
            <button class="btn btn-success"><i data-feather="save" class="me-1"></i>Save Client</button>
            <a href="{{ route('clients.index') }}" class="btn btn-secondary"><i data-feather="arrow-left" class="me-1"></i>Cancel</a>
        </div>
    </form>
@endsection
