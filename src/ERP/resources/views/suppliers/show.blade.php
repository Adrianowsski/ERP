@extends('layouts.app')
@section('title','Supplier Details')

@section('content')
    <h1 class="mb-4 d-flex align-items-center">
        <i data-feather="info" class="me-1"></i> Supplier Details
    </h1>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-4">Name</dt>
                <dd class="col-sm-8">{{ $supplier->name }}</dd>

                <dt class="col-sm-4">NIP</dt>
                <dd class="col-sm-8">{{ $supplier->nip }}</dd>

                <dt class="col-sm-4">Email</dt>
                <dd class="col-sm-8">{{ $supplier->email }}</dd>

                <dt class="col-sm-4">Phone</dt>
                <dd class="col-sm-8">{{ $supplier->phone }}</dd>

                <dt class="col-sm-4">Address</dt>
                <dd class="col-sm-8">{{ $supplier->address }}</dd>
            </dl>

            <div class="d-flex justify-content-between">
                <a href="{{ route('suppliers.edit', $supplier) }}" class="btn btn-warning d-flex align-items-center">
                    <i data-feather="edit-2" class="me-1"></i> Edit
                </a>
                <a href="{{ route('suppliers.index') }}" class="btn btn-secondary d-flex align-items-center">
                    <i data-feather="arrow-left" class="me-1"></i> Back
                </a>
            </div>
        </div>
    </div>
@endsection
