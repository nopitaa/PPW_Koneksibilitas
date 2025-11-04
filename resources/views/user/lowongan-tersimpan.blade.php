<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Lowongan | Koneksibilitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
        }
        .navbar {
            border-bottom: 1px solid #e5e5e5;
        }
        .card-job {
            transition: all 0.2s ease;
        }
        .card-job:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        .btn-lamar {
            background-color: #e8f1ff;
            color: #0d6efd;
            border: none;
        }
        .btn-lamar:hover {
            background-color: #d6e7ff;
        }
    </style>
</head>
<body class="bg-white">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-white">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#">KONEKSIBILITAS</a>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav gap-3 fw-medium">
                    <li class="nav-item"><a class="nav-link text-secondary" href="/">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link text-primary fw-semibold border-bottom border-primary" href="/user/lowongan-tersimpan">Simpan</a></li>
                    <li class="nav-item"><a class="nav-link text-secondary" href="/status">Status</a></li>
                    <li class="nav-item"><a class="nav-link text-secondary" href="/profile">Profile</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main content -->
    <main class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-semibold">Informasi Lowongan</h1>
            <a href="#" class="text-primary fw-semibold text-decoration-none">Edit</a>
        </div>

        <div class="row g-3">
            @foreach ($jobs as $job)
            <div class="col-12">
                <div class="card card-job shadow-sm border-0 rounded-4 p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('assets/img/logoperusahaan.png') }}" class="w-25 mx-auto mb-3" alt="">
                            <div>
                                <h5 class="fw-semibold mb-0">{{ $job['title'] }}</h5>
                                <small class="text-muted">{{ $job['company'] }}</small>
                            </div>
                        </div>
                        <button class="btn btn-lamar rounded-pill px-4 py-2 fw-medium">Lamar</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <footer class="text-center text-muted mt-5 small">
            © 2025 koneksibilitas. Hak cipta dilindungi
        </footer>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



