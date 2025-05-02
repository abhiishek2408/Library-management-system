@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <!-- Page Title -->
    <div class="mb-4">
        <h1 class="fw-bold fs-3 text-primary">
            📘 My Issued Books
        </h1>
    </div>

    <!-- Issued Books Table -->
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-3">Books You've Issued</h5>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>📗 Title</th>
                            <th>✍️ Author</th>
                            <th>📅 Issue Date</th>
                            <th>💰 Cost</th>
                            <th>⭐ Rating</th>
                            <th>📊 Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($issuedBooks as $issuedBook)
                            @php
                                $book = $issuedBook->book;
                                $title = $issuedBook->title ?? $book?->title ?? '-';
                                $author = $issuedBook->author ?? $book?->author ?? '-';
                                $issueDate = $issuedBook->issue_date 
                                    ? \Carbon\Carbon::parse($issuedBook->issue_date)->format('d M Y h:i A') 
                                    : '-';
                                $cost = $issuedBook->cost_of_issue 
                                    ? '₹' . number_format($issuedBook->cost_of_issue, 2) 
                                    : '-';
                                $avgRating = $book?->reviews?->count() > 0 
                                    ? number_format($book->reviews->avg('rating'), 1) 
                                    : null;
                                $status = $issuedBook->status ?? '-';
                            @endphp
                            <tr>
                                <td>{{ $title }}</td>
                                <td>{{ $author }}</td>
                                <td>{{ $issueDate }}</td>
                                <td>{{ $cost }}</td>
                                <td>
                                    @if($avgRating)
                                        {{ $avgRating }} / 5
                                    @else
                                        <span class="text-muted">No rating</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($status !== '-')
                                        <span class="badge 
                                            {{ 
                                                $status === 'issued' ? 'bg-success' : 
                                                ($status === 'returned' ? 'bg-secondary' : 
                                                'bg-warning text-dark') 
                                            }}">
                                            {{ ucfirst($status) }}
                                        </span>
                                    @else
                                        <span class="badge bg-light text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No issued books found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
