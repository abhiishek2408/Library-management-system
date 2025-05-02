@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h1 class="mb-3 fw-bold fs-3">
        <span class="text-gradient">📚 Librarian Dashboard</span>
    </h1>
    <p class="mb-4">
        <small class="text-muted">
            Manage library operations efficiently:
            <a href="#" class="text-decoration-underline text-primary">View Guide</a>
        </small>
    </p>

    <div class="row g-4">
        <!-- Inventory & Book Management -->
        <div class="col-md-3">
            <div class="card shadow-lg border-0 rounded-4 p-3 bg-light-subtle h-100">
                <div class="card-header bg-primary text-white p-2 rounded-3 text-center fw-semibold">
                    📚 Book Management
                </div>
                <div class="card-body p-3">
                    <a href="{{ route('librarian.addNewBook') }}" class="btn btn-outline-primary btn-sm w-100 mb-2 animate-button">Add New Book</a>
                    <a href="{{ route('librarian.updated.book.record') }}" class="btn btn-outline-primary btn-sm w-100 mb-2 animate-button">Update Book Details</a>
                    <a href="{{ route('librarian.delete.book') }}" class="btn btn-outline-primary btn-sm w-100 mb-2 animate-button">Delete Book</a>
                    <a href="{{ route('librarian.manage.categories.genres') }}" class="btn btn-outline-primary btn-sm w-100 mb-2 animate-button">Manage Categories/Genres</a>
                </div>
            </div>
        </div>

        <!-- Inventory Management -->
        <div class="col-md-3">
            <div class="card shadow-lg border-0 rounded-4 p-3 bg-white h-100">
                <div class="card-header bg-success text-white p-2 rounded-3 text-center fw-semibold">
                    📦 Inventory Management
                </div>
                <div class="card-body p-3">
                <a href="{{ route('track.available.copies') }}" class="btn btn-outline-success btn-sm w-100 mb-2 animate-button">Track Available Copies</a>
                <a href="{{ route('librarian.pending.requests') }}" class="btn btn-outline-success btn-sm w-100 mb-2 animate-button">Pending Requests</a>
                <a href="{{ route('librarian.manage.damaged.missing') }}" class="btn btn-outline-success btn-sm w-100 mb-2 animate-button">Manage Damaged/Missing Books</a>
                <a href="{{ route('librarian.reorder.new.copies') }}" class="btn btn-outline-success btn-sm w-100 mb-2 animate-button">Reorder New Copies</a>
                </div>
            </div>
        </div>

        <!-- Issue/Return and Reservation -->
        <div class="col-md-3">
            <div class="card shadow-lg border-0 rounded-4 p-3 bg-white h-100">
                <div class="card-header bg-warning text-dark p-2 rounded-3 text-center fw-semibold">
                    🔄 Issue / Return / Reservation
                </div>
                <div class="card-body p-3">
                    <a href="{{ route('librarian.manual.issue.books') }}" class="btn btn-outline-warning btn-sm w-100 mb-2 animate-button">Issue Book to User</a>
                    <a href="{{ route('librarian.return.books') }}" class="btn btn-outline-warning btn-sm w-100 mb-2 animate-button">Accept Book Return</a>
                    <a href="{{ route('librarian.manage.renewals') }}" class="btn btn-outline-warning btn-sm w-100 mb-2 animate-button">Renew Book</a>
                    <a href="{{ route('librarian.manage.reservations') }}" class="btn btn-outline-warning btn-sm w-100 mb-2 animate-button">Manage Reservations</a>
                </div>
            </div>
        </div>

        <!-- Late Fee and User Management -->
        <div class="col-md-3">
            <div class="card shadow-lg border-0 rounded-4 p-3 bg-white h-100">
                <div class="card-header bg-danger text-white p-2 rounded-3 text-center fw-semibold">
                    💵 Late Fees & Users
                </div>
                <div class="card-body p-3">
                    <a href="#" class="btn btn-outline-danger btn-sm w-100 mb-2 animate-button">Track Overdue Books</a>
                    <a href="#" class="btn btn-outline-danger btn-sm w-100 mb-2 animate-button">Calculate Late Fines</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Reports and Notifications -->
    <div class="row g-4 mt-4">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-4 p-3 h-100">
                <div class="card-header bg-info text-white p-2 rounded-3 text-center fw-semibold">
                    📈 Reports & Analytics
                </div>
                <div class="card-body p-3">
                    <a href="#" class="btn btn-outline-info btn-sm w-100 mb-2 animate-button">Issued/Returned Books Report</a>
                    <a href="#" class="btn btn-outline-info btn-sm w-100 mb-2 animate-button">Overdue Books Report</a>
                    <a href="#" class="btn btn-outline-info btn-sm w-100 mb-2 animate-button">Inventory Report</a>
                    <a href="#" class="btn btn-outline-info btn-sm w-100 mb-2 animate-button">User Activities Report</a>
                    <a href="#" class="btn btn-outline-info btn-sm w-100 mb-2 animate-button">Monthly/Yearly Summaries</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-4 p-3 h-100">
                <div class="card-header bg-secondary text-white p-2 rounded-3 text-center fw-semibold">
                    🔔 Notifications & Settings
                </div>
                <div class="card-body p-3">
                    <a href="#" class="btn btn-outline-secondary btn-sm w-100 mb-2 animate-button">Send Due Reminders</a>
                    <a href="#" class="btn btn-outline-secondary btn-sm w-100 mb-2 animate-button">Notify Reserved Book Availability</a>
                    <a href="#" class="btn btn-outline-secondary btn-sm w-100 mb-2 animate-button">Manage Lending Rules</a>
                    <a href="#" class="btn btn-outline-secondary btn-sm w-100 mb-2 animate-button">Manage Fine Policies</a>
                    <a href="#" class="btn btn-outline-secondary btn-sm w-100 mb-2 animate-button">Manage Events/Announcements</a>
                    <a href="#" class="btn btn-outline-secondary btn-sm w-100 mb-2 animate-button">Barcode/QR Code Management</a>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Custom CSS -->
<style>
    .animate-button {
        transition: all 0.3s ease;
    }
    .animate-button:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .text-gradient {
        background: linear-gradient(90deg, rgb(0, 212, 255), rgb(9, 9, 121)); 
        -webkit-background-clip: text;
        color: transparent;
    }
</style>
@endsection
