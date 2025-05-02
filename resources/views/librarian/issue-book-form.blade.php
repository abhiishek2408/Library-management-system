@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #eef2f7;
    }

    .issue-wrapper {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    .neumorph-issue-card {
        background: #f0f0f3;
        border-radius: 20px;
        box-shadow: 8px 8px 16px #d1d9e6, -8px -8px 16px #ffffff;
        padding: 2rem 2.5rem;
        width: 100%;
        max-width: 500px;
    }

    .neumorph-issue-card h3 {
        color: #fff;
        background-color: #007bff;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        box-shadow: inset 4px 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
        text-align: center;
    }

    .form-group label {
        font-weight: 600;
        color: #333;
    }

    .form-control {
        border-radius: 12px;
        box-shadow: inset 2px 2px 6px #d1d9e6, inset -2px -2px 6px #ffffff;
        padding: 0.65rem 1rem;
        font-size: 0.95rem;
    }

    .btn-issue {
        background-color: #007bff;
        color: white;
        font-size: 1rem;
        border-radius: 10px;
        padding: 0.6rem 1.5rem;
        width: 100%;
        border: none;
        transition: 0.3s ease;
        margin-top: 1rem;
    }

    .btn-issue:hover {
        background-color: #0056b3;
    }
</style>

<div class="issue-wrapper">
    <div class="neumorph-issue-card">
        <h3><i class="bi bi-journal-plus me-2"></i>Issue Book: {{ $book->title }}</h3>

        <form method="POST" action="{{ route('librarian.issue.book.manually') }}">
            @csrf
            <input type="hidden" name="book_id" value="{{ $book->id }}">

            <div class="form-group mb-3">
                <label for="user_id"><i class="bi bi-person-fill me-1"></i>User ID</label>
                <input type="text" class="form-control" name="user_id" required>
            </div>

            <button type="submit" class="btn btn-issue">
                <i class="bi bi-box-arrow-right me-1"></i> Issue Book
            </button>
        </form>
    </div>
</div>
@endsection
