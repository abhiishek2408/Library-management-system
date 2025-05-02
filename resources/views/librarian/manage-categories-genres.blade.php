@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #eef2f7;
    }

    .neumorph-container {
        background: #f0f0f3;
        border-radius: 20px;
        box-shadow: 8px 8px 16px #d1d9e6, -8px -8px 16px #ffffff;
        padding: 1.5rem; /* Reduced padding for narrower design */
        width: 70%; /* Decreased width to 70% */
        max-width: 950px; /* Maximum width */
        margin: auto;
    }

    h2 {
        background-color: #007bff;
        color: #fff;
        padding: 1rem;
        border-radius: 12px;
        text-align: center;
        margin-bottom: 1.5rem;
    }

    label {
        font-weight: 500;
    }

    .form-control {
        border-radius: 12px;
        box-shadow: inset 2px 2px 6px #d1d9e6, inset -2px -2px 6px #ffffff;
        padding: 0.65rem 1rem;
        font-size: 0.95rem;
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
        border-radius: 10px;
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-sm {
        font-size: 0.8rem;
        border-radius: 8px;
    }

    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #212529;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
        color: #fff;
    }

    .card-header {
        background-color: #007bff !important;
        color: #fff;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }

    .table th, .table td {
        vertical-align: middle;
    }

    /* Make the table even more compact */
    .table {
        font-size: 0.9rem;
    }
</style>

<div class="container my-4">
    <div class="neumorph-container">
        <h2><i class="bi bi-tags me-2"></i>Manage Categories & Genres</h2>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('librarian.manage.categories.genres') }}" class="mb-4">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="category">Filter by Category</label>
                    <select name="category" id="category" class="form-control">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="genre">Filter by Genre</label>
                    <select name="genre" id="genre" class="form-control">
                        <option value="">All Genres</option>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre }}" {{ request('genre') == $genre ? 'selected' : '' }}>
                                {{ $genre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </div>
        </form>

        <!-- Books Table -->
        <div class="card shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Books List</h4>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>Genre</th>
                                <th>ISBN</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($books as $index => $book)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->author }}</td>
                                    <td>{{ $book->category }}</td>
                                    <td>{{ $book->genre }}</td>
                                    <td>{{ $book->isbn }}</td>
                                    <td>
                                        <a href="{{ route('librarian.update.book', $book->id) }}" class="btn btn-sm btn-warning me-1">Edit</a>
                                        <form action="{{ route('librarian.delete.book', $book->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">No books available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
