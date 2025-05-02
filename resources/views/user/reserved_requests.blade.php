@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <!-- Page Title -->
    <div class="mb-4">
        <h1 class="fw-bold fs-3 text-success">
            📌 Reserved Book Requests
        </h1>
    </div>

    <!-- Reserved Books Table -->
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-3">My Reserved Requests</h5>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>📘 Title</th>
                            <th>✍️ Author</th>
                            <th>⏰ Pickup Timing</th>
                            <th>⏳ Timer</th>
                            <th>🔧 Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reservedRequests as $issue)
                        @php
                        // Parse the pickup_timing as it's already in Indian Time (IST)
                        $pickupTiming = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $issue->pickup_timing, 'Asia/Kolkata');
                        $now = now('Asia/Kolkata');
                        $remainingSeconds = $now->diffInSeconds($pickupTiming, false);

                        @endphp
                        <tr>
                            <td>{{ $issue->title ?? ($issue->book->title ?? '-') }}</td>
                            <td>{{ $issue->author ?? ($issue->book->author ?? '-') }}</td>
                            <td>
                                {{ $pickupTiming
                                    ? $pickupTiming->format('d M Y h:i A') 
                                    : '-' }}
                            </td>
                            <td>
                            @if ($remainingSeconds > 0)
                                <span class="text-success">
                                    {{ $pickupTiming->diff($now)->format('%d days, %h hours, %i minutes left') }}
                                </span>
                            @else
                                <span class="text-danger">Pickup time passed!</span>
                            @endif
                       
                            </td>
                            <td>
                                <form action="{{ route('user.renew', $issue->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btn-sm mb-1">
                                        <i class="bi bi-arrow-clockwise"></i> Renew
                                    </button>
                                </form>
                                <form action="{{ route('user.cancelReservation', $issue->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-x-circle"></i> Cancel
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No reserved books found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection