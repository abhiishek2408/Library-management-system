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

    h2 {
        background-color: #007bff;
        color: #fff;
        padding: 0.8rem; /* Slightly reduced padding */
        border-radius: 12px;
        text-align: center;
        margin-bottom: 1.5rem; /* Reduced margin */
        font-size: 1.5rem; /* Slightly smaller font size */
    }

    label {
        font-weight: 500;
        font-size: 0.9rem; /* Reduced font size */
    }

    .form-control {
        border-radius: 10px;
        box-shadow: inset 2px 2px 6px #d1d9e6, inset -2px -2px 6px #ffffff;
        padding: 0.5rem 1rem; /* Reduced padding */
        font-size: 0.9rem; /* Reduced font size */
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
        border-radius: 10px;
        padding: 0.5rem 1rem;
        font-size: 0.85rem; /* Reduced font size */
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .badge {
        font-size: 0.8rem; /* Reduced badge font size */
        padding: 0.45em 0.75em;
        border-radius: 8px;
    }

    .table th, .table td {
        vertical-align: middle;
        font-size: 0.9rem; /* Reduced table font size */
    }

    .table td {
        font-size: 0.9rem; /* Reduced font size for table cells */
    }

</style>

<div class="container my-4">
    <div class="neumorph-container">
        <h2><i class="bi bi-exclamation-triangle me-2"></i>Manage Damaged / Missing Books</h2>

        <!-- Filter Form -->
        <form action="{{ route('librarian.manage.damaged.missing') }}" method="GET" class="mb-4">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="availability">Filter by Availability</label>
                    <select name="availability" id="availability" class="form-control">
                        <option value="">All Statuses</option>
                        <option value="damaged" {{ request('availability') == 'damaged' ? 'selected' : '' }}>Damaged</option>
                        <option value="missing" {{ request('availability') == 'missing' ? 'selected' : '' }}>Missing</option>
                        <option value="available" {{ request('availability') == 'available' ? 'selected' : '' }}>Available</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </div>
        </form>

        <!-- Books Table -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered shadow-sm">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Availability</th>
                        <th>Update Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $index => $book)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->category }}</td>
                        <td>
                            <span class="badge 
                                @if($book->availability == 'damaged') bg-warning text-dark 
                                @elseif($book->availability == 'missing') bg-danger text-white 
                                @else bg-success text-white 
                                @endif">
                                {{ ucfirst($book->availability) }}
                            </span>
                        </td>
                        <td>
                            <form action="{{ route('librarian.update.availability', $book->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="availability" class="form-control" onchange="this.form.submit()">
                                    <option value="available" {{ $book->availability == 'available' ? 'selected' : '' }}>Available</option>
                                    <option value="damaged" {{ $book->availability == 'damaged' ? 'selected' : '' }}>Damaged</option>
                                    <option value="missing" {{ $book->availability == 'missing' ? 'selected' : '' }}>Missing</option>
                                </select>
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
