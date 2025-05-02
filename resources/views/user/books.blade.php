@extends('layouts.app')

@section('content')
<style>
    .simple-card {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 12px;
        padding: 1.2rem;
        transition: all 0.3s ease-in-out;
        width: 85%;
        margin: 0 auto;
        position: relative;
        overflow: hidden;
        text-align: center;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .simple-card:hover {
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        transform: translateY(-5px);
    }

    .book-placeholder {
        font-size: 3rem;
        text-align: center;
        color: #aaa;
        margin-bottom: 0.8rem;
    }

    .book-title {
        font-weight: 600;
        font-size: 1.2rem;
        color: #333;
    }

    .book-info {
        font-size: 0.85rem;
        color: #555;
        margin-bottom: 0.3rem;
    }

    .star-rating {
        display: flex;
        justify-content: center;
        gap: 4px; /* Reduced gap between stars */
        margin-top: 0.5rem; /* Reduced top margin */
    }

    .star-btn {
        background: none;
        border: none;
        font-size: 1.2rem; /* Reduced size */
        color: #ffc107; /* Golden color */
        cursor: pointer;
        transition: transform 0.2s ease-in-out, color 0.2s ease-in-out;
    }

    .star-btn:hover {
        transform: scale(1.3); /* Slightly bigger on hover */
        color: #ff9800; /* Darker gold for hover effect */
    }

    .review-label {
        text-align: center;
        margin-top: 0.6rem;
        font-size: 0.8rem;
        color: #555;
        font-weight: 500;
    }
</style>

<div class="container my-5">
    <h4 class="fw-bold fs-3 text-primary mb-4">📚 All Books</h4>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row justify-content-center">
        @foreach($books as $book)
        <div class="col-md-3 d-flex align-items-stretch mb-4">
            <div class="simple-card d-flex flex-column justify-content-between">

                <div class="book-placeholder">
                    <i class="bi bi-book-half"></i>
                </div>

                <h5 class="book-title mb-2">{{ $book->title }}</h5>
                <p class="book-info"><strong>✍️ Author:</strong> {{ $book->author }}</p>
                <p class="book-info"><strong>🔢 ISBN:</strong> {{ $book->isbn }}</p>
                <p class="book-info"><strong>🏷️ Category:</strong> {{ $book->category }}</p>
                <p class="book-info"><strong>⭐ Review:</strong>
                    @if($book->reviews->count() > 0)
                        {{ number_format($book->reviews->avg('rating'), 1) }} / 5
                        <small class="text-muted">({{ $book->reviews->count() }} reviews)</small>
                    @else
                        <span class="text-muted">No reviews yet</span>
                    @endif
                </p>

                <form action="{{ route('user.add.review', $book->id) }}" method="POST">
                    @csrf
                    <div class="star-rating">
                        @for($i = 1; $i <= 5; $i++)
                            <button type="submit" name="review" value="{{ $i }}" class="star-btn" title="{{ $i }} Star">
                                <i class="bi bi-star-fill"></i>
                            </button>
                        @endfor
                    </div>
                    <div class="review-label">Rate by clicking a star</div>
                </form>

            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
