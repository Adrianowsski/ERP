@extends('layouts.app')
@section('title','Client Details')

@section('content')
    <h1 class="mb-4"><i data-feather="info" class="me-1"></i>Client Details</h1>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-4">Name</dt>
                <dd class="col-sm-8">{{ $client->name }}</dd>

                <dt class="col-sm-4">NIP</dt>
                <dd class="col-sm-8">{{ $client->nip }}</dd>

                <dt class="col-sm-4">Email</dt>
                <dd class="col-sm-8">{{ $client->email }}</dd>

                <dt class="col-sm-4">Phone</dt>
                <dd class="col-sm-8">{{ $client->phone }}</dd>

                <dt class="col-sm-4">Address</dt>
                <dd class="col-sm-8">{{ $client->address }}</dd>
            </dl>
            <div class="d-flex justify-content-between">
                <a href="{{ route('clients.edit', $client) }}" class="btn btn-warning"><i data-feather="edit" class="me-1"></i>Edit</a>
                <a href="{{ route('clients.index') }}" class="btn btn-secondary"><i data-feather="arrow-left" class="me-1"></i>Back</a>
            </div>
        </div>
    </div>
@endsection
