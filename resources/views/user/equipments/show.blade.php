@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('user.equipments.index') }}" class="btn btn-secondary mb-3">&larr; Back to Equipment List</a>

    <div class="card shadow-sm">
        @if($equipment->image_path)
             <img src="{{ asset('storage/' . $equipment->image_path) }}">
            {{-- <img src="{{ asset($equipment->image_path) }}" class="card-img-top" alt="{{ $equipment->name }}"> --}}
        @endif

        

        <div class="card-body">
            <h3 class="card-title">{{ $equipment->name }}</h3>
            <p class="card-text">
                <strong>Model:</strong> {{ $equipment->model }}<br>
                <strong>Category:</strong> {{ $equipment->category }}<br>
                <strong>Serial Number:</strong> {{ $equipment->serial_number }}<br>
                <strong>Description:</strong> {{ $equipment->description }}<br>
                <strong>Status:</strong> 
                <span class="badge bg-{{ $equipment->status === 'available' ? 'success' : 'secondary' }}">
                    {{ ucfirst($equipment->status) }}
                </span>
            </p>

            @if($equipment->status === 'available')
                <a href="{{ route('user.rentals.create', ['equipment_id' => $equipment->id]) }}" class="btn btn-primary">
                    Request This Equipment
                </a>
            @else
                <button class="btn btn-secondary" disabled>Not Available</button>
            @endif
        </div>
    </div>
</div>
@endsection
