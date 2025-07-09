@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Equipment Release Requests</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Requester</th>
                <th>Equipment</th>
                <th>Purpose</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $request)
                <tr>
                    <td>{{ $request->id }}</td>
                    <td>{{ $request->user->name }}</td>
                    <td>{{ $request->equipment->name }}</td>
                    <td>{{ $request->purpose }}</td>
                    <td><span class="badge bg-{{ $request->status == 'pending' ? 'warning' : ($request->status == 'approved' ? 'success' : ($request->status == 'declined' ? 'danger' : 'secondary')) }}">{{ ucfirst($request->status) }}</span></td>
                    <td>
                        <a href="{{ route('admin.rentals.show', $request->id) }}" class="btn btn-sm btn-primary">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection