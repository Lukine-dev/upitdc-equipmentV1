@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Request #{{ $request->id }}</h2>
    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Requester:</strong> {{ $request->user->name }} ({{ $request->user->email }})</p>
            <p><strong>Equipment:</strong> {{ $request->equipment->name }}</p>
            <p><strong>Purpose:</strong> {{ $request->purpose }}</p>
            <p><strong>Release Date:</strong> {{ $request->release_date }}</p>
            <p><strong>Status:</strong> <span class="badge bg-{{ $request->status == 'pending' ? 'warning' : ($request->status == 'approved' ? 'success' : ($request->status == 'declined' ? 'danger' : 'secondary')) }}">{{ ucfirst($request->status) }}</span></p>

            @if($request->status === 'pending')
                <form action="{{ route('admin.rentals.approve', $request->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-success">Approve</button>
                </form>
                <form action="{{ route('admin.rentals.decline', $request->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-danger">Decline</button>
                </form>
            @elseif($request->status === 'approved')
                <form action="{{ route('admin.rentals.return', $request->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-dark">Mark as Returned</button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
