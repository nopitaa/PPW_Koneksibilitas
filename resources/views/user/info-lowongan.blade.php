<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lowongan Tersimpan | Koneksibilitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff;
            font-family: 'Poppins', sans-serif;
        }
        .nav-link.active {
            color: #0d6efd !important;
            font-weight: 600;
        }
        .card-lowongan {
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
            transition: 0.2s;
        }
        .card-lowongan:hover {
            transform: translateY(-2px);
        }
        footer {
            text-align: center;
            font-size: 14px;
            color: #555;
            margin-top: 40px;
        }
    </style>
</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#">
                <img src="{{ asset('logo.png') }}" alt="Logo" height="22" class="me-2">
                KONEKSIBILITAS
            </a>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="/">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link active" href="/user/lowongan-tersimpan">Simpan</a></li>
                    <li class="nav-item"><a class="nav-link" href="/status">Status</a></li>
                    <li class="nav-item"><a class="nav-link" href="/profile">Profile</a></li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Konten --}}
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">Informasi Lowongan</h3>
            <a href="#" class="text-primary fw-semibold">Edit</a>
        </div>

        {{-- Daftar Lowongan --}}
        <div class="list-group">
            @foreach ([
                ['posisi' => 'Admin Toko Online', 'perusahaan' => 'GlobalTrans Indo'],
                ['posisi' => 'Desain Grafis', 'perusahaan' => 'GlobalTrans Indo'],
                ['posisi' => 'Data Entry Operator', 'perusahaan' => 'GlobalTrans Indo'],
                ['posisi' => 'Admin Sosial Media', 'perusahaan' => 'GlobalTrans Indo'],
            ] as $job)
            <div class="card card-lowongan mb-3">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('company-icon.png') }}" alt="Logo" width="35" class="me-3">
                        <div>
                            <h6 class="mb-1 fw-semibold">{{ $job['posisi'] }}</h6>
                            <small class="text-muted">{{ $job['perusahaan'] }}</small>
                        </div>
                    </div>
                    <a href="#" class="btn btn-primary btn-sm px-3">Lamar</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Footer --}}
    <footer>
        © 2025 koneksibilitas. Hak cipta dilindungi
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
