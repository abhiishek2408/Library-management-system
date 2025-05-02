@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4">Edit User</h2>

    <div class="card shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Edit User: {{ $user->name }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.update.user', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Name Input -->
                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>

                <!-- Email Input -->
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                </div>

                <!-- Role Input -->
                <div class="form-group mb-3">
                    <label for="role">Role</label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Update User</button>
            </form>
        </div>
    </div>
</div>
@endsection
