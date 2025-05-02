@extends('layouts.app')

@section('content')
<style>
    body {
        background: #eef2f7;
        font-family: 'Segoe UI', sans-serif;
    }

    .neumorph-card {
        background: #f0f0f3;
        border-radius: 20px;
        box-shadow: 8px 8px 16px #d1d9e6, -8px -8px 16px #ffffff;
        padding: 1.5rem;
        height: 100%;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .neumorph-card:hover {
        transform: translateY(-6px);
        box-shadow: inset 4px 4px 10px #d1d9e6, inset -4px -4px 10px #ffffff;
    }

    .book-placeholder {
        width: 100%;
        height: 180px;
        border-radius: 12px;
        background: linear-gradient(135deg, #cbd5e0, #e2e8f0);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: #6c757d;
        margin-bottom: 1rem;
    }

    .book-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #222;
        margin-bottom: 0.3rem;
    }

    .book-meta {
        font-size: 0.88rem;
        color: #555;
        margin-bottom: 0.25rem;
    }

    .btn-details {
        background-color: #007bff;
        color: white;
        font-size: 0.85rem;
        border-radius: 8px;
        padding: 0.4rem 0.8rem;
        align-self: flex-start;
    }

    .btn-details:hover {
        background-color: #0056b3;
    }
</style>

<div class="container py-4">
    <h2 class="mb-4 text-primary">
        <i class="bi bi-book-fill me-2"></i>Fiction Books
    </h2>

    <div class="row g-4">
        @forelse($fictionBooks as $book)
        <div class="col-md-4">
            <div class="neumorph-card">
                <div>
                    <div class="book-placeholder">
                        <i class="bi bi-book-half"></i>
                    </div>
                    <h5 class="book-title">{{ $book->title }}</h5>
                    <p class="book-meta">
                        <i class="bi bi-person-fill me-1 text-secondary"></i> {{ $book->author }}
                    </p>
                    <p class="book-meta">
                        <i class="bi bi-tag-fill me-1 text-warning"></i> {{ $book->category }}
                    </p>
                    <p class="book-meta">
                        <i class="bi bi-calendar-check me-1 text-success"></i>
                        {{ $book->published_year ?? 'Year Unknown' }}
                    </p>
                </div>
                <a href="#" class="btn btn-details mt-3">
                    <i class="bi bi-info-circle me-1"></i>Details
                </a>
            </div>
        </div>
        @empty
        <div class="col-12 text-center">
            <p class="text-muted">No fiction books available at the moment.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
