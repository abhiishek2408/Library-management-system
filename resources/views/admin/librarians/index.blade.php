@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2>All Librarians</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($librarians as $index => $librarian)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $librarian->name }}</td>
                        <td>{{ $librarian->email }}</td>
                        <td>{{ $librarian->role }}</td>
                        <td>
                            <a href="{{ route('admin.librarian.edit', $librarian->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{ route('admin.librarian.delete', $librarian->id) }}" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
