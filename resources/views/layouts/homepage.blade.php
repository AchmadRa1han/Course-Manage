<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>University Website</title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }
        .footer {
            padding: 20px 0;
        }
        .footer p {
            margin-bottom: 5px;
        }
        .section-title {
            text-align: center;
            margin-bottom: 40px;
        }
        .course-card {
            transition: transform 0.2s;
        }
        .course-card:hover {
            transform: scale(1.05);
        }
        .hero-section {
            position: relative;
            color: white;
        }
        .hero-section img {
            width: 100%;
            height: 600px;
            object-fit: cover;
        }
        .hero-section .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Gelap dengan transparansi */
            z-index: 1; /* Pastikan overlay berada di atas gambar */
        }
        .carousel-caption {
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            position: absolute; /* Agar teks berada di atas overlay */
            z-index: 2; /* Pastikan teks berada di atas overlay */
        }
    </style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('homepage') }}">
            <img alt="University Logo" height="50" src="{{ asset('images/logo.png') }}" width="150"/>
        </a>
        <button aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-bs-target="#navbarNav" data-bs-toggle="collapse" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                @if (Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'teacher' || Auth::user()->role === 'student'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a> <!-- Tautan untuk dashboard -->
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('courses.index') }}">Course Catalog</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                @if (Auth::check())
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="btn btn-outline-light me-2" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-warning" href="{{ route('register') }}">Register</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>


<!-- Hero Section -->
<div class="carousel slide hero-section" data-bs-ride="carousel" id="heroCarousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img alt="Student with books" src="https://assets-us-01.kc-usercontent.com/95d47d95-36b6-00af-a24c-b886ecdfc4a2/c6c84bca-94d9-497a-a90b-620c11fd362d/online_learning.jpg" class="img-fluid"/>
            <div class="overlay"></div> <!-- Overlay -->
            <div class="carousel-caption">
                <h1>Welcome To Our Website</h1>
                <p>We believe nothing is more important than education. The best learning place.</p>
            </div>
        </div>
    </div>
</div>

    
    <!-- Popular Courses Section -->
    <section class="container my-5">
        <div class="section-title">
            <h2>Popular Courses</h2>
            <p>Ini adalah beberapa course yang populer!</p>
        </div>
        <div class="row">
            @foreach ($popularCourses as $course)
                <div class="col-md-4">
                    <div class="card course-card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $course->name }}</h5>
                            <p class="card-text">{{ $course->description }}</p>
                            <p class="card-text">Enrolled Students: {{ $course->enrollments_count }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Learn Online Section -->
    <section class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <h2>Learn Online Courses</h2>
                <p>Only Patience &amp; Persistence Give Good Result</p>
                <p>Bergabunglah dengan kami untuk menjelajahi dunia pengetahuan yang tak terbatas. Kursus kami dirancang untuk membantu Anda mengembangkan keterampilan baru dan mencapai tujuan pribadi serta profesional.</p>
                <a class="btn btn-primary" href="{{ route('courses.index') }}">Read More</a>
            </div>
            <div class="col-md-6">
                <img alt="Student studying online" src="https://storage.googleapis.com/a1aa/image/qhAb0PoRQG60FhXq1G9C4VfFqGTp72KQdIXlOytiHSf9S02TA.jpg" class="img-fluid"/>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer bg-dark text-white">
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <p class="mb-0">Copyright &copy; Sigmarse 2024. All rights reserved.</p>
                    <p>Email: info@sigmarse.com | Phone: +1 234 567 890</p>
                </div>
            </div>
        </div>
    </footer>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</body>
</html>
