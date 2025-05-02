@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- <h3 class="mb-4">Issue Book to User</h3>

        <form method="GET" class="mb-3">
            <input type="text" name="search" class="form-control" placeholder="Search by title, author, or ISBN">
            <button type="submit" class="btn btn-primary mt-2 w-100">Search</button>
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Book Title</th>
                    <th>User</th>
                    <th>Issue Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($issuedBooks as $index => $issuedBook)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $issuedBook->book->title }}</td>
                        <td>{{ $issuedBook->user->name }}</td>
                        <td>{{ $issuedBook->issue_date ? $issuedBook->issue_date->format('d M Y') : '-' }}</td>
                        <td>{{ ucfirst($issuedBook->status) }}</td>
                        <td>
                            <form action="{{ route('librarian.return.book', $issuedBook->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Return</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No books found with "issued" status.</td>
                    </tr>
                @endforelse
            </tbody>
        </table> -->
    </div>
@endsection
