@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Admin or Editor Account</h2>

    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>CU / Campus</label>
            <input type="text" name="cu" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Designation</label>
            <input type="text" name="designation" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Department / Office Unit</label>
            <input type="text" name="department" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-control" required>
                <option value="editor">Editor</option>
                <option value="administrator">Administrator</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Create User</button>
    </form>
</div>
@endsection
