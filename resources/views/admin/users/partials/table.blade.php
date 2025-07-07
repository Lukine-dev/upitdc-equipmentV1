@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">All Registered Users</h2>

    @if(session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('users.create') }}" class="btn btn-success">Create Admin/Editor</a>

        <form action="{{ route('users.index') }}" method="GET" class="d-flex" role="search">
            <input type="text" name="search" class="form-control me-2" placeholder="Search by name, email, or role" value="{{ $search ?? '' }}">
            <button type="submit" class="btn btn-outline-primary">Search</button>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped align-middle">
            @php
                function sort_link($column, $label, $currentSort, $currentDirection) {
                    $newDirection = ($currentSort === $column && $currentDirection === 'asc') ? 'desc' : 'asc';
                    $icon = '';

                    if ($currentSort === $column) {
                        $icon = $currentDirection === 'asc' ? '↑' : '↓';
                    }

                    $url = request()->fullUrlWithQuery([
                        'sort_by' => $column,
                        'direction' => $newDirection
                    ]);

                    return '<a href="' . $url . '" class="text-white text-decoration-none">' . $label . ' ' . $icon . '</a>';
                }
            @endphp

            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>{!! sort_link('name', 'Name', $sortBy, $direction) !!}</th>
                    <th>{!! sort_link('email', 'Email', $sortBy, $direction) !!}</th>
                    <th>CU</th>
                    <th>Department</th>
                    <th>{!! sort_link('role', 'Role', $sortBy, $direction) !!}</th>
                    <th>{!! sort_link('email_verified_at', 'Verified', $sortBy, $direction) !!}</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $index => $user)
                    <tr>
                        <td>{{ ($users->currentPage() - 1) * $users->perPage() + $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->cu }}</td>
                        <td>{{ $user->department }}</td>
                        <td>
                            <span class="badge bg-info text-dark">{{ ucfirst($user->role) }}</span>
                        </td>
                        <td>
                            @if($user->email_verified_at)
                                <span class="text-success">Yes</span>
                            @else
                                <span class="text-danger">No</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-primary me-1">Edit</a>

                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this user?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($users->hasPages())
        <div class="d-flex justify-content-center">
            {{ $users->appends(['search' => $search ?? ''])->links() }}
        </div>
    @endif
</div>
@endsection
