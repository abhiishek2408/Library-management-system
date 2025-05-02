@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f7f9fc;
    }

    .neumorph-container {
        background: #f0f0f3;
        border-radius: 20px;
        box-shadow: 8px 8px 16px #d1d9e6, -8px -8px 16px #ffffff;
        padding: 1.5rem;
        width: 80%; /* Decreased width */
        max-width: 1100px; /* Limit to avoid excessive width */
        margin: auto;
    }

    h4 {
        background-color: #007bff;
        color: #fff;
        padding: 1rem;
        border-radius: 12px;
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .btn {
        border-radius: 10px;
        padding: 0.5rem 1rem;
        font-size: 0.85rem; /* Reduced font size */
    }

    .form-control {
        border-radius: 10px;
        box-shadow: inset 4px 4px 8px #d1d9e6, inset -4px -4px 8px #ffffff;
    }

    .table th, .table td {
        vertical-align: middle;
        font-size: 0.9rem; /* Reduced font size */
    }

    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }

    /* Ensures the search input is also narrower */
    .form-control {
        width: 100%;
        max-width: 400px; /* Limiting width of the search input */
        margin: auto;
    }
</style>

<div class="container py-4">
    <div class="neumorph-container">
        <h4><i class="bi bi-pencil-square me-2"></i>Update Book Details</h4>

        <!-- Search Form -->
        <form method="GET" action="{{ route('librarian.updated.book.record') }}">
            <input type="text" name="search" placeholder="Search Books" class="form-control mb-3" value="{{ request('search') }}">
        </form>

        <!-- Books Table -->
        <div class="card mb-5 shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Books</h4>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped table-bordered mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Book Title</th>
                            <th>Author</th>
                            <th>ISBN</th>
                            <th>Category</th>
                            <th>Action</th> <!-- Edit button -->
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($books as $index => $book)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->isbn }}</td>
                                <td>{{ $book->category }}</td>
                                <td>
                                    <a href="{{ route('librarian.edit.book', $book->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No books found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
