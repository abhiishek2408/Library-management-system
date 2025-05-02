@extends('layouts.app')

@section('content')
<style>
    .neumorph-card {
        background: #f0f0f3;
        border-radius: 1rem;
        box-shadow: 8px 8px 15px #d1d9e6, -8px -8px 15px #ffffff;
        transition: all 0.3s ease;
    }

    .neumorph-card:hover {
        box-shadow: inset 4px 4px 10px #d1d9e6, inset -4px -4px 10px #ffffff;
    }

    .table-neumorph {
        background-color: #f8f9fa;
        border-radius: 1rem;
        overflow: hidden;
    }

    .table thead {
        background-color: #0d6efd;
        color: white;
    }

    .table tbody tr:hover {
        background-color: #e6f0ff;
    }
</style>

<div class="container mt-5">

    <!-- Page Header -->
    <div class="mb-4 d-flex align-items-center">
        <i class="bi bi-person-circle fs-1 text-primary me-3"></i>
        <div>
            <h2 class="fw-bold mb-0">My Account</h2>
            <small class="text-muted">Welcome, {{ $user->name }} 👋</small>
        </div>
    </div>

    <!-- Profile Info -->
    <div class="card neumorph-card mb-4 p-4 border-0">
        <h5 class="text-primary mb-3"><i class="bi bi-info-circle me-2"></i>Profile Information</h5>
        <ul class="list-group list-group-flush bg-transparent">
            <li class="list-group-item bg-transparent border-0">
                <i class="bi bi-person-fill me-2 text-muted"></i><strong>Name:</strong> {{ $user->name }}
            </li>
            <li class="list-group-item bg-transparent border-0">
                <i class="bi bi-envelope-fill me-2 text-muted"></i><strong>Email:</strong> {{ $user->email }}
            </li>
            <li class="list-group-item bg-transparent border-0">
                <i class="bi bi-calendar-check-fill me-2 text-muted"></i><strong>Member Since:</strong> {{ $user->created_at->format('d M Y') }}
            </li>
        </ul>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="neumorph-card text-center p-4">
                <i class="bi bi-journal-bookmark-fill text-primary fs-1 mb-2"></i>
                <h6 class="text-muted">Issued Books</h6>
                <h3 class="fw-bold text-primary">{{ $issuedCount }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="neumorph-card text-center p-4">
                <i class="bi bi-bookmark-plus-fill text-success fs-1 mb-2"></i>
                <h6 class="text-muted">Reserved</h6>
                <h3 class="fw-bold text-success">{{ $reservedCount }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="neumorph-card text-center p-4">
                <i class="bi bi-exclamation-triangle-fill text-danger fs-1 mb-2"></i>
                <h6 class="text-muted">Overdue</h6>
                <h3 class="fw-bold text-danger">{{ $overdueCount }}</h3>
            </div>
        </div>
    </div>

    <!-- Recent Activity Table -->
    <div class="neumorph-card p-4">
        <h5 class="text-primary mb-3">
            <i class="bi bi-clock-history me-2"></i>Recent Activity
        </h5>
        <div class="table-responsive table-neumorph">
            <table class="table table-hover mb-0 align-middle">
                <thead>
                    <tr>
                        <th><i class="bi bi-book me-1"></i>Book</th>
                        <th><i class="bi bi-flag-fill me-1"></i>Status</th>
                        <th><i class="bi bi-calendar-plus me-1"></i>Issued</th>
                        <th><i class="bi bi-calendar-event me-1"></i>Due</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentIssued as $entry)
                    <tr>
                        <td>{{ $entry->book->title ?? '-' }}</td>
                        <td>
                            <span class="badge bg-{{ $entry->status == 'issued' ? 'primary' : 'warning' }}">
                                {{ ucfirst($entry->status) }}
                            </span>
                        </td>
                        <td>{{ $entry->issue_date ? \Carbon\Carbon::parse($entry->issue_date)->format('d M Y') : '-' }}</td>
                        <td>{{ $entry->due_date ? \Carbon\Carbon::parse($entry->due_date)->format('d M Y') : '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">No recent activity found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
