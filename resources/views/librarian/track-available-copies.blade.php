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
        width: 70%; /* Reduced container width */
        max-width: 900px; /* Max width for responsiveness */
        margin: auto;
    }

    h4 {
        background-color: #007bff; /* Consistent theme color */
        color: #fff;
        padding: 1rem;
        border-radius: 12px;
        text-align: center;
        margin-bottom: 2rem;
    }

    .btn {
        border-radius: 10px;
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
    }

    .table th, .table td {
        vertical-align: middle;
    }

    .table td {
        font-size: 1rem;
    }

    .form-control {
        border-radius: 10px;
        box-shadow: inset 4px 4px 8px #d1d9e6, inset -4px -4px 8px #ffffff;
        font-size: 0.95rem; /* Slightly reduced font size for compact look */
    }

    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }
</style>

<div class="container py-4">
    <div class="neumorph-container">
        <h4><i class="bi bi-search me-2"></i>Track Available Copies</h4>

        <!-- Search Form -->
        <form method="GET" action="{{ route('track.available.copies') }}" class="mb-3">
            <input type="text" name="search" class="form-control" placeholder="Search books..." value="{{ request('search') }}">
        </form>

        <!-- Available Books Table -->
        <div class="card mb-5 shadow">
            <div class="card-header  text-white">
                <h4 class="mb-0">Available Books</h4>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>ISBN</th>
                            <th>Total Copies</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($books as $index => $book)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->category }}</td>
                                <td>{{ $book->isbn }}</td>
                                <td>{{ $book->quantity }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No books available.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
