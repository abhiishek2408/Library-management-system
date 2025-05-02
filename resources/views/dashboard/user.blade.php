@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f0f2f5;
        font-family: 'Segoe UI', sans-serif;
    }

    .neumorph-box {
        background: #f0f0f3;
        border-radius: 1rem;
        box-shadow: 8px 8px 15px #d1d9e6, -8px -8px 15px #ffffff;
        transition: all 0.3s ease;
    }

    .neumorph-box:hover {
        box-shadow: inset 4px 4px 10px #d1d9e6, inset -4px -4px 10px #ffffff;
        transform: translateY(-3px);
    }

    h1, h5, h4 {
        color: #333;
    }

    .icon-box {
        font-size: 3rem;
    }

    .list-group-item {
        border: none;
        border-radius: 12px;
        margin-bottom: 0.5rem;
        background: #f8f9fc;
        box-shadow: 4px 4px 10px #d1d9e6, -4px -4px 10px #ffffff;
    }

    .white-wrapper {
        max-width: 1000px;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    footer {
    background-color: #6c757d; /* Custom grey */
  }
</style>

<div class="white-wrapper">

    <!-- Welcome Header -->
    <div class="mb-5 text-center">
        <h1 class="fw-bold">
            <i class="bi bi-person-lines-fill text-primary me-2"></i>
            Welcome, {{ Auth::user()->name }} 👋
        </h1>
        <p class="text-muted">Here’s a quick overview of your library activity.</p>
    </div>

    <!-- Dashboard Tiles -->
    <div class="row text-center mb-5">
        <div class="col-md-4 mb-4">
            <a href="{{ route('books.list') }}" class="text-decoration-none text-dark">
                <div class="p-4 neumorph-box">
                    <i class="bi bi-journal-bookmark-fill icon-box text-primary"></i>
                    <h5 class="mt-3">Review Books</h5>
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-4">
            <a href="{{ route('books.available') }}" class="text-decoration-none text-dark">
                <div class="p-4 neumorph-box">
                    <i class="bi bi-search icon-box text-success"></i>
                    <h5 class="mt-3">Available Books</h5>
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-4">
            <a href="{{ route('user.account') }}" class="text-decoration-none text-dark">
                <div class="p-4 neumorph-box">
                    <i class="bi bi-person-circle icon-box text-info"></i>
                    <h5 class="mt-3">My Account</h5>
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-4">
            <a href="{{ route('user.issuedBooks') }}" class="text-decoration-none text-dark">
                <div class="p-4 neumorph-box">
                    <i class="bi bi-book-half icon-box text-warning"></i>
                    <h5 class="mt-3">Issued Books</h5>
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-4">
            <a href="{{ route('user.reserved_requests') }}" class="text-decoration-none text-dark">
                <div class="p-4 neumorph-box">
                    <i class="bi bi-calendar-check icon-box text-primary"></i>
                    <h5 class="mt-3">Reservation Request</h5>
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-4">
            <a href="{{ route('user.issueRequests') }}" class="text-decoration-none text-dark">
                <div class="p-4 neumorph-box">
                    <i class="bi bi-journal-plus icon-box text-danger"></i>
                    <h5 class="mt-3">Issue Requests</h5>
                </div>
            </a>
        </div>
    </div>

    <!-- Categories Section -->
    <h4 class="mb-3"><i class="bi bi-tags-fill text-secondary me-2"></i>Categories</h4>
    <ul class="list-group">
    <li class="list-group-item d-flex align-items-center">
        <i class="bi bi-book-fill text-info me-3 fs-4"></i>
        <a href="{{ route('user.fictionBooks') }}" class="text-decoration-none text-dark">
            <div>
                <strong>Fiction</strong><br>
                <small>Novels and Stories</small>
            </div>
        </a>
    </li>
    <li class="list-group-item d-flex align-items-center">
        <i class="bi bi-book text-warning me-3 fs-4"></i>
        <a href="{{ route('user.nonfictionBooks') }}" class="text-decoration-none text-dark">
            <div>
                <strong>Non-Fiction</strong><br>
                <small>Biographies, Self-help, History</small>
            </div>
        </a>
    </li>
</ul>



<div class="container my-4">
    <div class="card border-0 shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">
                <i class="fas fa-gavel me-2"></i>Library Management System - Rules & Regulations
            </h4>
        </div>
        <div class="card-body p-4">
            <div class="list-group list-group-flush">
                <div class="list-group-item d-flex align-items-start">
                    <i class="fas fa-book-open text-primary me-3 mt-1"></i>
                    <span><strong>1.</strong> Each user is responsible for all books issued on their account.</span>
                </div>
                <div class="list-group-item d-flex align-items-start">
                    <i class="fas fa-calendar-times text-primary me-3 mt-1"></i>
                    <span><strong>2.</strong> Books must be returned or renewed on or before the due date to avoid fines.</span>
                </div>
                <div class="list-group-item d-flex align-items-start">
                    <i class="fas fa-exclamation-triangle text-primary me-3 mt-1"></i>
                    <span><strong>3.</strong> Lost or damaged books must be replaced or compensated as per library policy.</span>
                </div>
                <div class="list-group-item d-flex align-items-start">
                    <i class="fas fa-bookmark text-primary me-3 mt-1"></i>
                    <span><strong>4.</strong> Reserved books must be collected within 1 days to avoid cancellation.</span>
                </div>
                <div class="list-group-item d-flex align-items-start">
                    <i class="fas fa-volume-mute text-primary me-3 mt-1"></i>
                    <span><strong>5.</strong> Maintain silence within library premises at all times.</span>
                </div>
                <div class="list-group-item d-flex align-items-start">
                    <i class="fas fa-user-slash text-primary me-3 mt-1"></i>
                    <span><strong>6.</strong> Misuse of library facilities may result in suspension of privileges.</span>
                </div>
                <div class="list-group-item d-flex align-items-start">
                    <i class="fas fa-desktop text-primary me-3 mt-1"></i>
                    <span><strong>7.</strong> Use digital resources responsibly and only for academic purposes.</span>
                </div>
                <div class="list-group-item d-flex align-items-start">
                    <i class="fas fa-balance-scale text-primary me-3 mt-1"></i>
                    <span><strong>8.</strong> Disputes are resolved as per library policy; librarian’s decision is final.</span>
                </div>
            </div>
        </div>
    </div>
</div>




</div>
<!-- Footer -->


<!-- Footer -->



@endsection


