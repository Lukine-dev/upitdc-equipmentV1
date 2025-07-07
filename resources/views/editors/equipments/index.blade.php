@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Manage Equipments</h2>

    @if(session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <a href="{{ route('editors.equipments.create') }}" class="btn btn-success mb-3">Add Equipment</a>

    <div class="mb-3">
    <form action="{{ route('editors.equipments.index') }}" method="GET" class="d-flex" role="search">
        <input type="text" name="search" class="form-control me-2" placeholder="Search equipment..." value="{{ $search ?? '' }}">
        <button type="submit" class="btn btn-outline-primary">Search</button>
        @if(request()->has('search'))
            <a href="{{ route('editors.equipments.index') }}" class="btn btn-outline-secondary ms-2">Reset</a>
        @endif
    </form>
    </div>
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Category</th>
                <th>Stock</th>
                <th>Status</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($equipments as $index => $equipment)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $equipment->name }}</td>
                    <td>{{ $equipment->category }}</td>
                    <td>{{ $equipment->stock }}</td>
                    <td>
                        <span class="badge bg-{{ $equipment->status == 'available' ? 'success' : 'secondary' }}">
                            {{ ucfirst($equipment->status) }}
                        </span>
                    </td>
                    <td>
                        @if($equipment->image_path)
                            <img src="{{ asset('storage/' . $equipment->image_path) }}" width="80">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('editors.equipments.edit', $equipment) }}" class="btn btn-sm btn-warning">Edit</a>
                         <a href="{{ route('editors.equipments.show', $equipment->id) }}" class="btn btn-sm btn-secondary">View</a>
                        <form action="{{ route('editors.equipments.destroy', $equipment) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this item?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7">No equipments found.</td></tr>
            @endforelse
            {{ $equipments->appends(['search' => $search])->links() }}
        </tbody>
    </table>
</div>
@endsection
