@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Equipment: {{ $equipment->name }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('editors.equipments.update', $equipment) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name', $equipment->name) }}">
        </div>

        <div class="mb-3">
            <label>Category</label>
            <input type="text" name="category" class="form-control" value="{{ old('category', $equipment->category) }}">
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ old('description', $equipment->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Stock</label>
            <input type="number" name="stock" class="form-control" required value="{{ old('stock', $equipment->stock) }}">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-select">
                <option value="available" {{ $equipment->status == 'available' ? 'selected' : '' }}>Available</option>
                <option value="unavailable" {{ $equipment->status == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                <option value="reserved" {{ $equipment->status == 'reserved' ? 'selected' : '' }}>Reserved</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Replace Image (optional)</label>
            <input type="file" name="image" class="form-control">
            @if($equipment->image_path)
                <div class="mt-2"><img src="{{ asset('storage/' . $equipment->image_path) }}" width="120"></div>
            @endif
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('editors.equipments.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

@endsection
