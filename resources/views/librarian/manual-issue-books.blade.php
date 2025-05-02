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
        padding: 2rem;
    }

    h3 {
        background-color: #007bff;
        color: #fff;
        padding: 1rem;
        border-radius: 12px;
        text-align: center;
        margin-bottom: 2rem;
    }

    .form-control {
        border-radius: 12px;
        box-shadow: inset 2px 2px 6px #d1d9e6, inset -2px -2px 6px #ffffff;
        padding: 0.65rem 1rem;
        font-size: 0.95rem;
    }

    .btn {
        border-radius: 10px;
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .table th, .table td {
        vertical-align: middle;
    }

    .gap-1 > * {
        margin-right: 0.5rem;
    }
</style>

<div class="container my-4">
    <div class="neumorph-container">
        <h3><i class="bi bi-bookmark-fill me-2"></i>Available Books for Manual Issue</h3>

        <!-- Search Form -->
        <form method="GET" class="mb-4">
            <input type="text" name="search" class="form-control" placeholder="Search by title, author, or ISBN" value="{{ request('search') }}">
            <button class="btn btn-primary mt-2 w-100">Search</button>
        </form>

        <!-- Available Books Table -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered shadow-sm">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>ISBN</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Action</th>
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
                            <td>{{ $book->quantity }}</td>
                            <td>{{ ucfirst($book->status) }}</td>
                            <td>
                                <a href="{{ route('librarian.show.issue.book.form', $book->id) }}" class="btn btn-success btn-sm">Issue</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No books available for issuing.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
