@extends('layouts.app')

@section('content')
<style>
    .manage-wrapper {
        max-width: 850px;
        margin: 30px auto;
        padding: 20px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 25px rgba(0, 0, 0, 0.08);
    }
    .table-title {
        font-size: 1.75rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 20px;
        color: #343a40;
    }
    .table thead th {
        background-color: #007bff;
        font-weight: 600;
        text-align: center;
    }
    .table tbody td {
        vertical-align: middle;
        text-align: center;
    }
    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.35rem 0.65rem;
        font-size: 0.9rem;
        border-radius: 5px;
        transition: all 0.2s ease-in-out;
    }
    .btn-action i {
        margin-right: 4px;
    }
    .btn-edit {
        background-color: #ffc107;
        color: #fff;
    }
    .btn-edit:hover {
        background-color: #e0a800;
        transform: translateY(-1px);
    }
    .btn-delete {
        background-color: #dc3545;
        color: #fff;
    }
    .btn-delete:hover {
        background-color: #c82333;
        transform: translateY(-1px);
    }
</style>

<div class="manage-wrapper">
    <h3 class="table-title">Manage Librarians</h3>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover shadow-sm mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Verified At</th>
                    <th>Role</th>
                    <th>Created</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @forelse($librarians as $index => $librarian)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $librarian->name }}</td>
                        <td>{{ $librarian->email }}</td>
                        <td>{{ $librarian->email_verified_at ?? 'N/A' }}</td>
                        <td>{{ ucfirst($librarian->role) }}</td>
                        <td>{{ $librarian->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('admin.edit-librarian', $librarian->id) }}" class="btn-action btn-edit">
                                <i class="bi bi-pencil-square"></i>Edit
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('admin.delete-librarian', $librarian->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this librarian?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete">
                                    <i class="bi bi-trash"></i>Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No librarians found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
