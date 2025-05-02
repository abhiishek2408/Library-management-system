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

    .btn-update {
        background-color: #007bff;
        border: none;
        color: white;
        font-size: 1rem;
        border-radius: 10px;
        padding: 0.6rem 1.5rem;
        width: 100%;
        box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.1);
        transition: 0.3s ease;
    }

    .btn-update:hover {
        background-color: #0056b3;
    }
</style>

<div class="neumorph-wrapper">
    <div class="neumorph-card">
        <h2><i class="bi bi-pencil-square me-2"></i>Edit Book Details</h2>

        <form action="{{ route('librarian.update.book', $book->id) }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <label>📖 Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $book->title }}" required>

                    <label>👨‍🏫 Author</label>
                    <input type="text" name="author" class="form-control" value="{{ $book->author }}" required>

                    <label>🔢 ISBN</label>
                    <input type="text" name="isbn" class="form-control" value="{{ $book->isbn }}" required>

                    <label>🏢 Publisher</label>
                    <input type="text" name="publisher" class="form-control" value="{{ $book->publisher }}" required>

                    <label>📘 Edition</label>
                    <input type="text" name="edition" class="form-control" value="{{ $book->edition }}" required>
                </div>

                <div class="col-md-6">
                    <label>💰 Cost of Issue</label>
                    <input type="number" name="cost_of_issue" class="form-control" value="{{ $book->cost_of_issue }}" required>

                    <label>⚠️ Penalty per Day</label>
                    <input type="number" name="penalty_per_day" class="form-control" value="{{ $book->penalty_per_day }}" required>

                    <label>🏷️ Category</label>
                    <input type="text" name="category" class="form-control" value="{{ $book->category }}" required>

                    <label>📦 Quantity</label>
                    <input type="number" name="quantity" class="form-control" value="{{ $book->quantity }}" required>

                    <label>✅ Status</label>
                    <input type="text" name="status" class="form-control" value="{{ $book->status }}" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label>🟢 Availability</label>
                    <select name="availability" class="form-control">
                        <option value="1" {{ $book->availability ? 'selected' : '' }}>Available</option>
                        <option value="0" {{ !$book->availability ? 'selected' : '' }}>Not Available</option>
                    </select>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-update">
                    <i class="bi bi-check2-square me-1"></i> Update Book
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
