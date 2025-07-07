@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Equipment Inventory</h2>

    <a href="{{ route('admin.equipments.create') }}" class="btn btn-primary mb-3">Add Equipment</a>

    @if(session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Stock</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($equipments as $equipment)
                <tr>
                    <td>{{ $equipment->name }}</td>
                    <td>{{ $equipment->category }}</td>
                    <td>{{ $equipment->stock }}</td>
                    <td>
                        <span class="badge bg-{{ $equipment->status == 'available' ? 'success' : 'secondary' }}">
                            {{ ucfirst($equipment->status) }}
                        </span>
                    </td>
                   <td>
                        <a href="{{ route('admin.equipments.show', $equipment) }}" class="btn btn-sm btn-info">Show</a>
                        <a href="{{ route('admin.equipments.edit', $equipment) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.equipments.destroy', $equipment) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this item?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $equipments->links() }}
</div>
@endsection
