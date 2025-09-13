@extends('layouts.app')
@section('title','Code Details')

@section('content')
    <h1 class="mb-4 d-flex align-items-center">
        <i data-feather="info" class="me-2"></i> Code Details
    </h1>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <dl class="row mb-4">
                <dt class="col-sm-3">Code</dt>
                <dd class="col-sm-9">{{ $registrationCode->code }}</dd>

                <dt class="col-sm-3">Status</dt>
                <dd class="col-sm-9">
                    @if($registrationCode->is_used)
                        <span class="badge bg-danger">Used</span>
                    @else
                        <span class="badge bg-success">Unused</span>
                    @endif
                </dd>

                <dt class="col-sm-3">Created By</dt>
                <dd class="col-sm-9">{{ $registrationCode->creator->name }}</dd>

                <dt class="col-sm-3">Created At</dt>
                <dd class="col-sm-9">{{ $registrationCode->created_at->format('Y-m-d H:i') }}</dd>
            </dl>

            <a href="{{ route('registration-codes.index') }}"
               class="btn btn-secondary d-inline-flex align-items-center">
                <i data-feather="arrow-left" class="me-1"></i> Back
            </a>
        </div>
    </div>
@endsection
