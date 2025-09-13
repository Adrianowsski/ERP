@extends('layouts.app')
@section('title','Registration Codes')

@section('content')
    <h1 class="mb-4 d-flex align-items-center">
        <i data-feather="codesandbox" class="me-2"></i> Registration Codes
    </h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('registration-codes.create') }}"
           class="btn btn-primary d-inline-flex align-items-center">
            <i data-feather="plus" class="me-1"></i> New Code
        </a>
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-bordered align-middle mb-0 bg-white">
            <thead class="table-light">
            <tr>
                <th style="width: 5%">#</th>
                <th>Code</th>
                <th style="width: 15%">Status</th>
                <th style="width: 20%">Created By</th>
                <th class="text-end" style="width: 100px;">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($codes as $code)
                <tr>
                    <td>{{ $loop->iteration + ($codes->currentPage() - 1) * $codes->perPage() }}</td>
                    <td>{{ $code->code }}</td>
                    <td>
                        @if($code->is_used)
                            <span class="badge bg-danger">Used</span>
                        @else
                            <span class="badge bg-success">Unused</span>
                        @endif
                    </td>
                    <td>{{ $code->creator->name }}</td>
                    <td class="text-end d-flex flex-row justify-content-end flex-nowrap">
                        {{-- Usuń --}}
                        <form method="POST" action="{{ route('registration-codes.destroy', $code) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-light border d-inline-flex align-items-center"
                                    onclick="return confirm('Delete this code?')"
                                    title="Delete">
                                <i data-feather="trash-2" class="text-danger"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No registration codes found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $codes->withQueryString()->links() }}
    </div>
@endsection
