@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #eef2f7;
        font-family: 'Segoe UI', sans-serif;
    }

    .neumorph-wrapper {
        max-width: 850px;
        margin: 2rem auto;
        padding: 1.5rem;
    }

    .neumorph-card {
        background: #f0f0f3;
        border-radius: 20px;
        box-shadow: 8px 8px 16px #d1d9e6, -8px -8px 16px #ffffff;
        padding: 2rem 2.5rem;
    }

    .neumorph-card h2 {
        font-weight: 600;
        color: #fff;
        background-color: #007bff;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        box-shadow: inset 4px 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
        text-align: center;
    }

    label {
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #333;
    }

    .form-control {
        border-radius: 12px;
        box-shadow: inset 2px 2px 6px #d1d9e6, inset -2px -2px 6px #ffffff;
        padding: 0.65rem 1rem;
        font-size: 0.95rem;
        margin-bottom: 1rem;
    }

    .btn-submit {
        background-color: #007bff;
        border: none;
        color: white;
        font-size: 1rem;
        border-radius: 10px;
        padding: 0.6rem 1.5rem;
        box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.1);
        transition: 0.3s ease;
    }

    .btn-submit:hover {
        background-color: #0056b3;
    }

    .alert-success {
        background-color: #d1e7ff;
        color: #0c63e4;
        border-left: 5px solid #007bff;
        padding: 0.75rem 1rem;
        border-radius: 10px;
        margin-bottom: 1.5rem;
    }
</style>

<div class="neumorph-wrapper">
    <div class="neumorph-card">
        <h2><i class="bi bi-plus-square-fill me-2"></i>Add New Book</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('librarian.addNewBook') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <label>📖 Title</label>
                    <input type="text" name="title" class="form-control" required>

                    <label>👨‍🏫 Author</label>
                    <input type="text" name="author" class="form-control" required>

                    <label>🔢 ISBN</label>
                    <input type="text" name="isbn" class="form-control" required>

                    <label>🏢 Publisher</label>
                    <input type="text" name="publisher" class="form-control">
                </div>

                <div class="col-md-6">
                    <label>📘 Edition</label>
                    <input type="text" name="edition" class="form-control">

                    <label>💰 Cost of Issue</label>
                    <input type="number" step="0.01" name="cost_of_issue" class="form-control" required>

                    <label>⚠️ Penalty Per Day</label>
                    <input type="number" step="0.01" name="penalty_per_day" class="form-control" required>

                    <label>🏷️ Category</label>
                    <input type="text" name="category" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label>📦 Quantity</label>
                    <input type="number" name="quantity" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label>✅ Status</label>
                    <input type="text" name="status" class="form-control" required placeholder="e.g., available">
                </div>

                <div class="col-md-3">
                    <label>🟢 Availability</label>
                    <input type="text" name="availability" class="form-control" required placeholder="e.g., yes">
                </div>
            </div>

            <div class="text-end mt-4">
                <button type="submit" class="btn btn-submit">
                    <i class="bi bi-bookmark-plus me-1"></i> Add Book
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
