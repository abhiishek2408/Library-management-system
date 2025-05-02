@extends('layouts.app')

@section('content')
<style>
    .neumorphic-card {
        background: #e0e0e0;
        border-radius: 20px;
        box-shadow: 8px 8px 20px #bebebe, -8px -8px 20px #ffffff;
        transition: all 0.3s ease-in-out;
        width: 60%;
        margin: 2rem auto;
        padding: 1.2rem;
    }
    .page-title {
        text-align: center;
        font-size: 1.8rem;
        font-weight: 700;
        color: #007bff;
        margin-top: 1rem;
        margin-bottom: 1.5rem;
        letter-spacing: 1px;
        text-shadow: 1px 1px 3px #bebebe;
    }
    .card-header-simple {
        text-align: center;
        background: #007bff;
        color: #fff;
        border-radius: 10px;
        padding: 0.65rem;
        margin-bottom: 1rem;
        font-size: 1.2rem;
        font-weight: 600;
    }
    .form-label {
        font-size: 0.85rem;
        color: #333;
        font-weight: 500;
        margin-bottom: 0.3rem;
    }
    .form-control {
        border-radius: 12px;
        box-shadow: inset 3px 3px 7px #bebebe, inset -3px -3px 7px #ffffff;
        border: none;
        padding: 0.4rem 0.7rem;
        font-size: 0.85rem;
        height: 36px;
    }
    .form-control:focus {
        box-shadow: inset 1px 1px 5px #bebebe, inset -1px -1px 5px #ffffff;
    }
    .btn-submit {
        background: #007bff;
        border: none;
        border-radius: 25px;
        width: 100%;
        padding: 0.45rem 1rem;
        font-size: 0.95rem;
        font-weight: 500;
        color: #fff;
        transition: all 0.3s ease-in-out;
    }
    .btn-submit:hover {
        background: #0069d9;
    }
    .alert-success {
        text-align: center;
        font-size: 0.85rem;
    }
</style>

<h1 class="page-title">Create User / Admin / Librarian</h1>

<div class="neumorphic-card">
    <div class="card-header-simple">Create New User</div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.store.user') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">👤 Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">📧 Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">🔑 Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">🔒 Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">🛠️ Role</label>
            <select name="role" id="role" class="form-control" required>
                <option value="admin">Admin</option>
                <option value="librarian">Librarian</option>
                <option value="user">User</option>
            </select>
        </div>

        <button type="submit" class="btn-submit mt-3">Create User</button>
    </form>
</div>
@endsection
