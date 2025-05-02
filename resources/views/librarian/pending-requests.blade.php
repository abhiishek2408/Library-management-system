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

    h4 {
        background-color: #007bff;
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

    .btn-success {
        background-color: #007bff;
        color: white;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
    }

    .btn-success:hover {
        background-color:rgb(20, 83, 151);
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .table th, .table td {
        vertical-align: middle;
    }

    .badge {
        text-transform: capitalize;
    }
</style>

<div class="container py-4">
    <div class="neumorph-container">
        <h4><i class="bi bi-bookmark-fill me-2"></i>Pending Book Reservations</h4>

        <!-- Pending Reservations Table -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered shadow-sm">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Book Title</th>
                        <th>User</th>
                        <th>Price</th>
                        <th>Issued By</th>
                        <th>Status</th>
                        <th>Action</th> <!-- New column -->
                    </tr>
                </thead>
                <tbody>
                    @forelse($issuedBooks as $index => $issuedBook)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $issuedBook->book->title }}</td>
                            <td>{{ $issuedBook->user->name ?? 'N/A' }}</td>
                            <td>{{ $issuedBook->cost_of_issue }}</td>
                            <td>{{ $issuedBook->user_id }}</td>
                            <td>
                                <span class="badge bg-warning text-dark text-capitalize">
                                    {{ $issuedBook->status }}
                                </span>
                            </td>
                            <td class="d-flex gap-1">
                                <form action="{{ route('librarian.approve', $issuedBook->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    <button class="btn btn-sm btn-success" type="submit">Approve</button>
                                </form>
                                <form action="{{ route('librarian.reject', $issuedBook->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    <button class="btn btn-sm btn-danger" type="submit">Reject</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No pending reservations found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
