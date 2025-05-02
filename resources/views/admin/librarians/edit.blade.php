<!-- resources/views/admin/librarians/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>Edit Librarian</h2>

    <form method="POST" action="{{ route('admin.librarian.update', $librarian->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $librarian->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $librarian->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password (Leave blank if not changing)</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Update Librarian</button>
    </form>
</div>
@endsection
