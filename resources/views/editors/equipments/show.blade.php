@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">{{ $equipment->name }}</h3>
        <a href="{{ route('editors.equipments.index') }}" class="btn btn-outline-secondary btn-sm">← Back to List</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="row g-0">
            {{-- Image Section --}}
            <div class="col-md-5 text-center bg-light p-4">
                @if ($equipment->image_path)
                    <img src="{{ asset('storage/' . $equipment->image_path) }}" alt="{{ $equipment->name }}" class="img-fluid rounded shadow-sm" style="max-height: 300px;">
                @else
                    <div class="text-muted mt-5">No Image Available</div>
                @endif
            </div>

            {{-- Info Section --}}
            <div class="col-md-7">
                <div class="card-body p-4">
                    <div class="mb-3">
                        <h5 class="text-muted">Category</h5>
                        <p class="fw-semibold">{{ $equipment->category ?: 'N/A' }}</p>
                    </div>

                    <div class="mb-3">
                        <h5 class="text-muted">Description</h5>
                        <p>{{ $equipment->description ?: 'No description provided.' }}</p>
                    </div>

                    <div class="mb-3">
                        <h5 class="text-muted">Stock</h5>
                        <span class="badge bg-{{ $equipment->stock > 0 ? 'success' : 'danger' }}">
                            {{ $equipment->stock }} {{ $equipment->stock === 1 ? 'unit' : 'units' }}
                        </span>
                    </div>

                    <div class="mb-3">
                        <h5 class="text-muted">Status</h5>
                        <span class="badge bg-{{ $equipment->status === 'available' ? 'primary' : ($equipment->status === 'reserved' ? 'warning' : 'secondary') }}">
                            {{ ucfirst($equipment->status) }}
                        </span>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('editors.equipments.edit', $equipment) }}" class="btn btn-outline-primary me-2">Edit</a>

                
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
