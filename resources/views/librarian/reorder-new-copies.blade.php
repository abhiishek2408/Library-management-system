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
        padding: 1.5rem; /* Reduced padding */
        width: 75%; /* Reduced width */
        max-width: 850px; /* Max width */
        margin: auto;
    }

    h4 {
        background-color: #007bff; /* Blue color theme */
        color: #fff;
        padding: 1rem;
        border-radius: 12px;
        text-align: center;
        margin-bottom: 2rem;
        font-size: 1.5rem;
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
        font-size: 0.9rem; /* Reduced font size */
    }

    .table td {
        font-size: 0.9rem; /* Reduced font size */
    }

</style>

<div class="container py-4">
    <div class="neumorph-container">
        <h4><i class="bi bi-arrow-repeat me-2"></i>Reorder New Copies</h4>

        <!-- Search Form -->
        <form method="GET" class="mb-3">
            <input type="text" name="search" class="form-control" placeholder="Search by title, author, or ISBN">
            <button type="submit" class="btn btn-primary mt-2 w-100">Search</button>
        </form>

        <!-- Low Stock Books Table -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>ISBN</th>
                        <th>Current Stock</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lowStockBooks as $index => $book)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->isbn }}</td>
                            <td>{{ $book->quantity }}</td>
                            <td>
                                <form action="{{ route('librarian.reorder.book', $book->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm">Reorder</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No books need reordering at the moment.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
