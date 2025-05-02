@extends('layouts.app')

@section('content')
<style>
    .form-wrapper {
        max-width: 550px;
        margin: 3rem auto;
        background: #fff;
        padding: 2rem 2.5rem;
        border-radius: 12px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
    }
    .form-header {
        text-align: center;
        font-size: 1.75rem;
        font-weight: 700;
        color: #007bff;
        margin-bottom: 1.5rem;
        letter-spacing: 0.5px;
    }
    .form-group label {
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #007bff;
    }
    .form-control {
        border-radius: 8px;
        padding: 0.6rem 1rem;
        font-size: 0.95rem;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }
    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.15rem rgba(0, 123, 255, 0.25);
    }
    .btn-submit {
        width: 100%;
        background-color: #007bff;
        color: #fff;
        padding: 0.75rem;
        font-size: 1rem;
        font-weight: 600;
        border: none;
        border-radius: 8px;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }
    .btn-submit:hover {
        background-color: #0069d9;
        transform: translateY(-2px);
    }
    .alert {
        font-size: 0.95rem;
        margin-bottom: 1rem;
    }
    .invalid-feedback {
        font-size: 0.85rem;
    }
</style>

<div class="form-wrapper">
    <h2 class="form-header">Add New Librarian</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form -->
    <form action="{{ route('admin.store.librarian') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="name">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="password">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>

        <div class="form-group mb-4">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control @error('role') is-invalid @enderror" required>
                <option value="librarian" selected>Librarian</option>
            </select>
            @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn-submit">Add Librarian</button>
    </form>
</div>
@endsection
