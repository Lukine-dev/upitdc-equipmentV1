@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Equipment</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('admin.equipments.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
        </div>
        

        <div class="mb-3">
            <label>Category</label>
            <input type="text" name="category" class="form-control" value="{{ old('category') }}">
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Stock</label>
            <input type="number" name="stock" class="form-control" required value="{{ old('stock', 1) }}">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-select">
                <option value="available" selected>Available</option>
                <option value="unavailable">Unavailable</option>
                <option value="reserved">Reserved</option>
            </select>
        </div>

      <div class="mb-3">
        <label>Upload Image</label>
        <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(event)">
        <img id="imagePreview" src="#" alt="Image Preview" style="max-width: 200px; margin-top: 1rem; display: none;">
    </div>

        <button class="btn btn-success">Create</button>
        <a href="{{ route('admin.equipments.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script>
    function previewImage(event) {
        const preview = document.getElementById('imagePreview');
        const file = event.target.files[0];

        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        } else {
            preview.src = '';
            preview.style.display = 'none';
        }
    }
</script>
@endsection
