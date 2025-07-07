@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Equipment</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('editors.equipments.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Category</label>
            <input type="text" name="category" class="form-control">
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Stock</label>
            <input type="number" name="stock" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-select">
                <option value="available">Available</option>
                <option value="unavailable">Unavailable</option>
                <option value="reserved">Reserved</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Upload Image</label>
            <input type="file" name="image" class="form-control" onchange="previewImage(event)">
            <img id="imagePreview" src="#" style="max-width: 200px; margin-top: 1rem; display: none;">
        </div>

        <button class="btn btn-primary">Submit</button>
        <a href="{{ route('editors.equipments.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script>
    function previewImage(event) {
        const preview = document.getElementById('imagePreview');
        const file = event.target.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        }
    }
</script>
@endsection
