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
        color: #fff;
        background-color: #007bff;
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

    .btn-search {
        background-color: #007bff;
        color: white;
        font-size: 0.9rem;
        border-radius: 10px;
        width: 100%;
        margin-top: 0.5rem;
    }

    .btn-search:hover {
        background-color: #0056b3;
    }

    .table thead {
        background-color: #e7ecf5;
    }

    .btn-return {
        background-color: #dc3545;
        color: white;
        font-size: 0.85rem;
        border-radius: 8px;
        padding: 0.4rem 0.8rem;
    }

    .btn-return:hover {
        background-color: #bd2130;
    }

    .table td, .table th {
        vertical-align: middle;
    }

</style>

<div class="container my-4">
    <div class="neumorph-container">
        <h3><i class="bi bi-journals me-2"></i>Issued Books</h3>

        <!-- Search Form -->
        <form method="GET" class="mb-4">
            <input type="text" name="search" class="form-control" placeholder="Search by title, author, ISBN or User ID">
            <button type="submit" class="btn btn-search">Search</button>
        </form>

        <!-- Issued Books Table -->
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>User ID</th>
                        <th>Issue Date</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($issuedBooks as $index => $issuedBook)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $issuedBook->title }}</td>
                            <td>{{ $issuedBook->author }}</td>
                            <td>{{ $issuedBook->user_id }}</td>
                            <td>{{ $issuedBook->issue_date }}</td>
                            <td>{{ $issuedBook->due_date }}</td>
                            <td>{{ ucfirst($issuedBook->status) }}</td>
                            <td>
                                <form action="{{ route('librarian.return.book', $issuedBook->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-return">Return</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">No issued books found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
