@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #eef2f7;
        font-family: 'Segoe UI', sans-serif;
    }

    .neumorph-wrapper {
        max-width: 1000px;
        margin: 2rem auto;
        padding: 1rem;
    }

    .neumorph-card {
        background: #f0f0f3;
        border-radius: 20px;
        box-shadow: 8px 8px 16px #d1d9e6, -8px -8px 16px #ffffff;
        padding: 2rem;
    }

    .neumorph-card h4 {
        font-weight: 600;
        margin-bottom: 1.5rem;
        color: #fff;
        background: #007bff;
        padding: 0.75rem 1.25rem;
        border-radius: 12px;
        box-shadow: inset 4px 4px 6px rgba(0,0,0,0.1);
    }

    .form-control {
        height: 2.4rem;
        border-radius: 12px;
        box-shadow: inset 2px 2px 4px #d1d9e6, inset -2px -2px 4px #ffffff;
        font-size: 0.95rem;
        margin-bottom: 1rem;
    }

    .table {
        background: #ffffff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 6px 12px rgba(0,0,0,0.05);
    }

    .table th {
        background: #007bff;
        color: white;
        font-weight: 600;
        text-align: center;
    }

    .table td {
        vertical-align: middle;
        text-align: center;
        font-size: 0.9rem;
    }

    .table-hover tbody tr:hover {
        background-color: #e9f2ff;
    }

    .btn-delete {
        background-color: #007bff;
        border: none;
        color: #fff;
        border-radius: 8px;
        font-size: 0.8rem;
        padding: 0.4rem 0.9rem;
        transition: 0.3s ease;
    }

    .btn-delete:hover {
        background-color: #0056b3;
    }
</style>

<div class="neumorph-wrapper">
    <div class="neumorph-card">
        <h4><i class="bi bi-trash3-fill me-2"></i>Delete Books</h4>

        <form method="GET" action="{{ route('librarian.delete.book') }}">
            <input type="text" name="search" class="form-control" placeholder="🔍 Search Books...">
        </form>

        <div class="table-responsive">
            <table class="table table-hover table-bordered mt-3">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>📖 Title</th>
                        <th>👨‍🏫 Author</th>
                        <th>🏷️ Category</th>
                        <th>📘 ISBN</th>
                        <th>🗑️ Action</th>
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
                        <td>
                            <form action="{{ route('librarian.delete.book.action', $book->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-delete">
                                    <i class="bi bi-trash-fill me-1"></i>Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-muted">No books found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
