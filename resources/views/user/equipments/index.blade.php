@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Available Equipment</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @forelse($equipments as $equipment)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($equipment->image_path)
                        <img src="{{ asset($equipment->image_path) }}" class="card-img-top" alt="{{ $equipment->name }}">
                    @else
                        <img src="{{ asset('Images/default-equipment.png') }}" class="card-img-top" alt="Default">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $equipment->name }}</h5>
                        <p class="card-text">
                            <strong>Model:</strong> {{ $equipment->model }}<br>
                            <strong>Category:</strong> {{ $equipment->category }}<br>
                            <strong>Status:</strong> 
                            <span class="badge bg-{{ $equipment->status === 'available' ? 'success' : 'secondary' }}">
                                {{ ucfirst($equipment->status) }}
                            </span>
                        </p>
                        @if($equipment->status === 'available')
                            <a href="{{ route('user.rentals.create', ['equipment_id' => $equipment->id]) }}" class="btn btn-primary">
                                Request This
                            </a>
                        @else
                            <button class="btn btn-secondary" disabled>Unavailable</button>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">No equipment found.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection
