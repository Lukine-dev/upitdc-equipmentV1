@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">My Equipment Requests</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('user.rentals.create') }}" class="btn btn-primary mb-3">New Request</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Equipment</th>
                <th>Purpose</th>
                <th>Status</th>
                <th>Release Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($requests as $request)
                <tr>
                    <td>{{ $request->id }}</td>
                    <td>{{ $request->equipment->name }}</td>
                    <td>{{ $request->purpose }}</td>
                    <td><span class="badge bg-{{ $request->status == 'pending' ? 'warning' : ($request->status == 'approved' ? 'success' : ($request->status == 'declined' ? 'danger' : 'secondary')) }}">{{ ucfirst($request->status) }}</span></td>
                    <td>{{ $request->release_date }}</td>
                </tr>
            @empty
                <tr><td colspan="5">No requests found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection