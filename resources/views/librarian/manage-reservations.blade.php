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
        <h3><i class="bi bi-journal-bookmark-fill me-2"></i>Manage Book Reservations</h3>

        <!-- Search -->
        <form method="GET" class="mb-4">
            <input type="text" name="search" class="form-control" placeholder="Search by title, author or user" value="{{ request('search') }}">
            <button class="btn btn-primary mt-2 w-100">Search</button>
        </form>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped shadow-sm">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Book</th>
                        <th>Author</th>
                        <th>Reserved By</th>
                        <th>User ID</th>
                        <th>Reserved At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservations as $index => $res)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $res->title }}</td>
                            <td>{{ $res->author }}</td>
                            <td>{{ $res->user ? $res->user->name : 'Unknown' }}</td>
                            <td>{{ $res->user_id }}</td>
                            <td>
                                {{ $res->reserved_at ? \Carbon\Carbon::parse($res->reserved_at)->format('d M Y h:i A') : 'N/A' }}
                            </td>
                            <td class="d-flex gap-1">
                                <!-- Approve -->
                                <form action="{{ route('librarian.approve.reservation', $res->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Issue</button>
                                </form>
                                <!-- Reject -->
                                <form action="{{ route('librarian.reject.reservation', $res->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No reservations found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
