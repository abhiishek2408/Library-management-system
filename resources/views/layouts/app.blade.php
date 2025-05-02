<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library System</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Custom Font -->
    <link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">

    <!-- Optional: Your own CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        .navbar {
            background: #007bff !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

   

      

        .navbar-nav .nav-link {
            font-weight: 500;
            font-size: 0.9rem;
            color: #fff !important;
            text-transform: lowercase;
            transition: color 0.3s ease-in-out;
        }

        .navbar-nav .nav-link:hover {
            color: #ff6347 !important;
            text-decoration: underline;
        }

        .navbar-nav .nav-item {
            margin-left: 15px;
        }

        .navbar-collapse {
            justify-content: flex-end;
        }

        .bi-bell-fill {
            font-size: 1.2rem;
            color: #ffc107;
        }

        .nav-link:hover .bi-bell-fill {
            color: #fff066;
        }

        .notification-badge {
            position: absolute;
            top: 2px;
            right: 0px;
            background-color: red;
            color: white;
            font-size: 0.6rem;
            padding: 2px 5px;
            border-radius: 50%;
        }

footer {
    background-color:rgb(0, 0, 0); /* Custom grey */
  }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">

    
    <img src="{{ asset('layouts/Logonav.png') }}" alt="Library Logo"
     height="50" width="70"
     style="margin-top: 0; margin-bottom: 0; margin-left: 20px;"
     class="d-inline-block align-text-top">


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto">
                    @if(auth()->check())
                    @php
                    $role = auth()->user()->role;
                    @endphp

                    @if($role === 'user')
                    <li class="nav-item"><a class="nav-link" href="{{ url('/user/dashboard') }}">dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/user/books') }}">books</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/user/issued') }}">issued</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/user/reserved') }}">reserved</a></li>
                    <li class="nav-item position-relative">
                        <a class="nav-link" href="{{ url('/user/notifications') }}">
                            <i class="bi bi-bell-fill"></i>
                            <span class="notification-badge">3</span> {{-- You can make this dynamic --}}
                        </a>
                    </li>

                    @elseif($role === 'librarian')
                    <li class="nav-item"><a class="nav-link" href="{{ url('/librarian/dashboard') }}">dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/librarian/books') }}">manage</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/librarian/issued') }}">issued</a></li>

                    @elseif($role === 'admin')
                    <li class="nav-item"><a class="nav-link" href="{{ url('/admin/dashboard') }}">admin</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/admin/users') }}">users</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/admin/settings') }}">settings</a></li>
                    @endif

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/logout') }}">logout</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/login') }}">login</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->


    <footer class="bg-dark text-white py-4 w-100 m-0">
  <div class="container-fluid px-5">
    <div class="row">
      <!-- About Section -->
      <div class="col-md-3">
        <h5 >About LMS</h5>
        <p style="font-size: small;">
        Our Library Management System (LMS) streamlines book tracking, reservations, and user management to ensure a smooth experience for students, librarians, and administrators alike.
        </p>
      </div>

      <!-- Links Section -->
      <div class="col-md-3">
        <h5>Quick Links</h5>
        <ul style="font-size: small;" class="list-unstyled">
          <li><a href="#" class="text-white">Home</a></li>
          <li><a href="#" class="text-white">Books</a></li>
          <li><a href="#" class="text-white">Reserve Books</a></li>
          <li><a href="#" class="text-white">User Dashboard</a></li>
          <li><a href="#" class="text-white">Admin Dashboard</a></li>
        </ul>
      </div>

      <!-- Contact Section -->
      <div class="col-md-3">
        <h5>Contact Us</h5>
        <ul style="font-size: small;" class="list-unstyled">
          <li><i class="bi bi-geo-alt-fill"></i> 123 Library Street, City</li>
          <li><i class="bi bi-telephone-fill"></i> +123 456 7890</li>
          <li><i class="bi bi-envelope-fill"></i> contact@lms.com</li>
        </ul>
      </div>

      <!-- Social Media Section -->
      <div style="font-size: small;" class="col-md-3">
        <h5>Follow Us</h5>
        <a href="#" class="text-white me-2"><i class="bi bi-facebook"></i></a>
        <a href="#" class="text-white me-2"><i class="bi bi-twitter"></i></a>
        <a href="#" class="text-white me-2"><i class="bi bi-instagram"></i></a>
        <a href="#" class="text-white me-2"><i class="bi bi-linkedin"></i></a>
      </div>
    </div>

    <!-- Copyright -->
    <div class="row mt-4">
      <div class="col text-center">
        <p style="font-size: small;">&copy; 2025 LMS. All Rights Reserved.</p>
      </div>
    </div>
  </div>
</footer>

<!-- Add Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>