@extends('layouts.app')

@section('content')

<style>
    body {
        background-color: #f5f7fa;
        font-family: 'Segoe UI', sans-serif;
    }

    .white-wrapper {
        max-width: 900px;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    .white-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
        padding: 2rem;
        margin-bottom: 2rem;
        transition: transform 0.2s ease, box-shadow 0.3s ease;
    }

    .white-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
    }

    h4 {
        font-weight: 600;
        margin-bottom: 1.5rem;
        color: #222;
        border-left: 5px solid #007bff;
        padding-left: 0.6rem;
    }

    .form-control {
        height: 2.5rem;
        font-size: 0.95rem;
        border-radius: 8px;
    }

    .btn {
        font-size: 0.75rem;
        padding: 0.4rem 0.8rem;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .btn-warning:hover {
        background-color: #d39e00;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .table {
        border: 1px solid #ddd;
        border-collapse: collapse;
    }

    .table th,
    .table td {
        border: 1px solid #000;
        font-size: 0.85rem;
        vertical-align: middle;
        padding: 0.5rem;
        text-align: center;
    }

    .table th {
        background-color: #007bff;
        color: white;
        font-weight: 600;
    }

    .table-hover tbody tr:hover {
        background-color: #f1f8ff;
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.2);
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgb(167, 24, 24);
    }
</style>

<div class="container mt-5">

    <!-- Page Title -->
    <div class="mb-4">
        <h1 class="fw-bold fs-3">
            <span class="text-primary">📖 Available Books</span>
        </h1>
    </div>

    <!-- Search Form -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title mb-3">Search Books</h5>
            <form action="{{ route('dashboard.user') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Search by title or author">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search me-1"></i> Search
                </button>
            </form>
        </div>
    </div>

    <!-- Available Books Table -->
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-3">Available Books</h5>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>📘 Title</th>
                            <th>✍️ Author</th>
                            <th>📂 Category</th>
                            <th>✅ Available</th>
                            <th>🔧 Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($books as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->category }}</td>
                            <td>
                                <span class="badge bg-{{ $book->availability ? 'success' : 'secondary' }}">
                                    {{ $book->availability ? 'Yes' : 'No' }}
                                </span>
                            </td>
                            <td>
                                @if($book->availability)
                                <form action="{{ route('user.reserve', $book->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="bi bi-bookmark-plus"></i> Reserve
                                    </button>
                                </form>
                                @else
                                <span class="text-muted">N/A</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No books available.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
