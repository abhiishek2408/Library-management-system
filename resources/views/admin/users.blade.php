@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4">User Management</h2>

    <!-- Users Table -->
    <div class="card shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Users List</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <!-- Edit User Link -->
                            <a href="{{ route('admin.edit.user', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.librarians.delete', $librarian->id) }}" method="POST" onsubmit="return confirm('Delete this librarian?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection