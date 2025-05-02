@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h1 class="mb-3 fw-bold fs-3">
        <span class="text-gradient">📖 Library Management System</span>
    </h1>
    <p class="mb-4">
        <small class="text-muted">
            How Library management system works: 
            <a href="#" class="text-decoration-underline text-danger">Resource</a>
        </small>
    </p>

    <div class="row g-4">
        <!-- Chart -->
        <div class="col-md-3">
            <div class="card shadow-lg border-0 rounded-4 p-3 bg-light-subtle h-100">
                <h6 class="card-title mb-3 text-center small text-dark-emphasis">📚 Total Borrowing Books</h6>
                <div class="text-center">
                    <canvas id="borrowingChart" height="180"></canvas>
                </div>
            </div>
        </div>

        <!-- Book Management -->
        <div class="col-md-3">
            <div class="card shadow-lg border-0 rounded-4 p-3 bg-white h-100">
                <div class="card-header bg-primary text-white p-2 rounded-3 text-center fw-semibold">
                    🍔 Book Management
                </div>
                <div class="card-body p-3">
                    <a href="#" class="btn btn-outline-primary btn-sm w-100 mb-2 animate-button">Add Books</a>
                    <a href="#" class="btn btn-outline-primary btn-sm w-100 mb-2 animate-button">Edit Books</a>
                    <a href="#" class="btn btn-outline-primary btn-sm w-100 mb-2 animate-button">Delete Books</a>
                    <a href="#" class="btn btn-outline-primary btn-sm w-100 mb-2 animate-button">View Book Details</a>
                    <a href="#" class="btn btn-outline-primary btn-sm w-100 mb-2 animate-button">Manage Renewals</a>
                    <a href="#" class="btn btn-outline-primary btn-sm w-100 animate-button">Manage Book Inventory</a>
                </div>
            </div>
        </div>

        <!-- Quick Buttons -->
        <div class="col-md-3">
            <div class="card shadow-lg border-0 rounded-4 p-3 bg-white mb-4">
                <div class="card-header bg-success text-white p-2 rounded-3 text-center fw-semibold">
                    ⚡ Quick Buttons
                </div>
                <div class="card-body p-3">
                    <a href="#" class="btn btn-success btn-sm w-100 mb-2 animate-button">+ Add Book</a>
                    <a href="#" class="btn btn-success btn-sm w-100 mb-2 animate-button">View Reservations</a>
                    <a href="#" class="btn btn-success btn-sm w-100 mb-2 animate-button">Track Stock</a>
                    <a href="#" class="btn btn-success btn-sm w-100 animate-button">Track Damaged Books</a>
                </div>
            </div>

            <!-- Database -->
            <div class="card shadow-lg border-0 rounded-4 p-3 bg-white">
                <div class="card-header bg-info text-white p-2 rounded-3 text-center fw-semibold">
                    🗃️ Database
                </div>
                <div class="card-body p-3">
                    <a href="#" class="btn btn-info btn-sm w-100 mb-2 animate-button">View Books</a>
                    <a href="#" class="btn btn-info btn-sm w-100 mb-2 animate-button">View Members</a>
                    <a href="#" class="btn btn-info btn-sm w-100 mb-2 animate-button">View Borrowers</a>
                    <a href="#" class="btn btn-info btn-sm w-100 animate-button">Manage Fines</a>
                </div>
            </div>
        </div>

        <!-- User & Library Management -->
        <div class="col-md-3">
            <div class="card shadow-lg border-0 rounded-4 p-3 bg-white mb-4">
                <div class="card-header bg-warning text-dark p-2 rounded-3 text-center fw-semibold">
                    👥 User Management
                </div>
                <div class="card-body p-3">
                    <a href="{{ route('admin.users') }}" class="btn btn-outline-warning btn-sm w-100 mb-2 animate-button">View All Users</a>
                    <a href="{{ route('admin.create.user') }}" class="btn btn-outline-success btn-sm w-100 mb-2 animate-button">Add New User</a>
                    <a href="#" class="btn btn-outline-danger btn-sm w-100 animate-button">Delete User</a>
                </div>
            </div>

            <div class="card shadow-lg border-0 rounded-4 p-3 bg-white">
                <div class="card-header bg-secondary text-white p-2 rounded-3 text-center fw-semibold">
                    📚 Library Management
                </div>
                <div class="card-body p-3">
                    <a href="{{ route('admin.librarians') }}" class="btn btn-outline-secondary btn-sm w-100 mb-2 animate-button">View Librarians</a>
                    <a href="{{ route('admin.create.librarian') }}" class="btn btn-outline-secondary btn-sm w-100 mb-2 animate-button">Add Librarians</a>
                    <a href="{{ route('admin.delete-edit-librarian') }}" class="btn btn-outline-secondary btn-sm w-100 mb-2 animate-button">Delete/Edit</a>
                    <a href="#" class="btn btn-outline-secondary btn-sm w-100 animate-button">Assign Librarian Tasks</a>
                </div>
            </div>
        </div>

    </div>

    <!-- Books and Borrowers -->
    <div class="row g-4 mt-4">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-4 p-3 h-100">
                <div class="card-header bg-light p-2 rounded-3 text-center fw-semibold">
                    📚 Books
                </div>
                <div class="card-body p-3">
                    <p class="small text-muted m-0">No books to display yet.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-4 p-3 h-100">
                <div class="card-header bg-light p-2 rounded-3 text-center fw-semibold">
                    👤 Borrower List
                </div>
                <div class="card-body p-3">
                    <p class="small text-muted m-0">No borrowers to display yet.</p>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('borrowingChart').getContext('2d');
    const borrowingChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [
                'The Catcher in the Rye',
                'Harry Potter',
                'The Lean Startup',
                'The Great Gatsby'
            ],
            datasets: [{
                label: 'Total Borrowed',
                data: [3, 4, 2, 1],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(153, 102, 255, 0.7)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#333',
                        font: {
                            size: 12
                        }
                    }
                },
                tooltip: {
                    backgroundColor: '#f8f9fa',
                    titleColor: '#333',
                    bodyColor: '#555',
                }
            }
        },
    });
</script>

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
        background: linear-gradient(90deg, rgb(235, 135, 212), rgb(85, 0, 255)); /* Gradient color */
        -webkit-background-clip: text;
        color: transparent;
    }
</style>
@endsection
