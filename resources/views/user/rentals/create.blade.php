@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Request Equipment</h2>

    <form method="POST" action="{{ route('user.rentals.store') }}">
        @csrf

        <div class="mb-3">
            <label for="equipment_id" class="form-label">Select Equipment</label>
            <select name="equipment_id" id="equipment_id" class="form-control" required>
                <option value="">-- Choose Equipment --</option>
                @foreach($equipment as $item)
                    <option value="{{ $item->id }}">{{ $item->name }} ({{ $item->model }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="purpose" class="form-label">Purpose of Use</label>
            <textarea name="purpose" id="purpose" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label for="release_date" class="form-label">Requested Date</label>
            <input type="date" name="release_date" id="release_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit Request</button>
    </form>
</div>
@endsection

