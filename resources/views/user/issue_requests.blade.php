@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Page Title -->
    <div class="mb-4">
        <h2 class="fw-bold text-success">
            📝 Your Issue Requests
        </h2>
    </div>

    @if($requests->count())
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-success">
                            <tr>
                                <th>📘 Title</th>
                                <th>✍️ Author</th>
                                <th>📂 Category</th>
                                <th>📅 Reserved On</th>
                                <th>🔧 Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requests as $request)
                            <tr>
                                <td>{{ $request->book->title }}</td>
                                <td>{{ $request->book->author }}</td>
                                <td>{{ $request->book->category }}</td>
                                <td>{{ $request->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <form action="{{ route('user.cancelReservation', $request->id) }}" method="POST" onsubmit="return confirm('Cancel this reservation?');" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            <i class="bi bi-x-circle"></i> Cancel
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-warning mt-4">
            No issue requests found.
        </div>
    @endif
</div>
@endsection
