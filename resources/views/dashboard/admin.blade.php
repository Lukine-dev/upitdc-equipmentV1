@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">📊 Admin Dashboard</h2>

    {{-- Insight Cards --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="fs-4">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Administrators</h5>
                    <p class="fs-4">{{ $totalAdmins }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Editors</h5>
                    <p class="fs-4">{{ $totalEditors }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Unverified</h5>
                    <p class="fs-4">{{ $unverifiedUsers }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Users Table --}}
    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0">🕒 Recent Registrations</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Verified</th>
                        <th>Registered</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentUsers as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td><span class="badge bg-info text-dark">{{ ucfirst($user->role) }}</span></td>
                            <td>
                                @if($user->email_verified_at)
                                    <span class="text-success">Yes</span>
                                @else
                                    <span class="text-danger">No</span>
                                @endif
                            </td>
                            <td>{{ $user->created_at->diffForHumans() }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center">No recent users.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
