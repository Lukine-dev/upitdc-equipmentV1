@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit User Account</h2>

    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf @method('PUT')

        {{-- Include the same fields as create, with value="{{ old() ?? $user->field }}" --}}
        <div class="mb-3">
            <label>Name</label>
            <input name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="mb-3">
            <label>Password (leave blank to keep existing)</label>
            <input name="password" class="form-control" type="password">
        </div>

        <div class="mb-3">
            <label>Confirm Password</label>
            <input name="password_confirmation" class="form-control" type="password">
        </div>

        <div class="mb-3">
            <label>CU</label>
            <input name="cu" class="form-control" value="{{ old('cu', $user->cu) }}" required>
        </div>

        <div class="mb-3">
            <label>Designation</label>
            <input name="designation" class="form-control" value="{{ old('designation', $user->designation) }}" required>
        </div>

        <div class="mb-3">
            <label>Department</label>
            <input name="department" class="form-control" value="{{ old('department', $user->department) }}" required>
        </div>

        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-control" required>
                <option value="editor" {{ $user->role === 'editor' ? 'selected' : '' }}>Editor</option>
                <option value="administrator" {{ $user->role === 'administrator' ? 'selected' : '' }}>Administrator</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
</div>
@endsection
