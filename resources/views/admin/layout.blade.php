<!DOCTYPE html>
<html lang="id">
<head>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Koneksibilitas Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
.nav-link {
    color: #000;
    padding: 10px 15px;
    display: block;
    border-radius: 6px;
    text-decoration: none;
}

.nav-link.active {
    background-color: #007bff;
    color: #fff;
    font-weight: 600;
}
body {
      background-color: #f7fbff;
      font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .sidebar {
      height: 100vh;
      background-color: #f3f8ff;
      padding-top: 30px;
      display: flex;
      flex-direction: column;
      gap: 15px;
    }
    .sidebar a {
      display: block; 
      font-family: 'Plus Jakarta Sans', sans-serif;             /* biar klik area rapi */
      color: #007bff;
      text-decoration: none;
      font-weight: 500;
      font-size: 14px;             /* ⬅️ diperkecil */
      padding: 8px 16px;           /* ⬅️ tinggi & lebar lebih ramping */
      margin-bottom: 6px;          /* jarak antar menu */
      border-radius: 6px;
      transition: all 0.25s ease;
    }

    /* Hover */
    .sidebar a:hover {
      background-color: #e9f2ff;
      color: #007bff;
    }

    /* Menu aktif */
    .sidebar a.active {
      background-color: #007bff;   /* ⬅️ biru saat aktif */
      color: #fff;
      font-weight: 600;
    }
    .text-sm {
        font-size: 13px;
    }

    .sidebar a:hover {
      color: #007bff;
    }

    .brand {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-left: 20px;
    }

    .brand img {
      width: 28px;
      height: 28px;
    }

    .brand span {
      font-family: 'Plus Jakarta Sans', sans-serif;
      color: #007bff;
      font-weight: 600;
      font-size: 14px;
    }
    table {
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #007bff;
        font-size: 14px;
        vertical-align: middle;
    }

    .table-custom th {
        background-color: #f8f9fa;
    }

    .table-custom .badge {
        font-size: 13px;
        font-weight: 600;
    }
  </style>
</head>
<body>
  <div class="d-flex">
    <!-- Sidebar -->
    <div class="col-2 sidebar">
      <div class="brand mb-4">
        <img src="{{ asset('logo.png') }}" alt="Logo">
        <span>KONEKSIBILITAS</span>
      </div>

      <a href="{{ route('dashboard') }}"
        class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        Beranda
      </a>

      <a href="{{ route('perusahaan') }}"
        class="nav-link {{ request()->routeIs('perusahaan') ? 'active' : '' }}">
        Perusahaan
      </a>

    </div>

    <!-- Main content -->
    <div class="col-10 p-4">
      <div class="d-flex justify-content-end mb-3">
      <a href="#" class="text-danger fw-bold text-decoration-none text-sm" onclick="confirmLogout()">Logout</a>

      <script>
        function confirmLogout() {
          if (confirm('Apakah Anda yakin ingin logout?')) {
            window.location.href = '{{ route('admin.login') }}';
          }
        }
      </script>
      </div>

      @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      @if(session('error'))
          <div class="alert alert-danger">{{ session('error') }}</div>
      @endif

      @yield('content')
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</body>
</html>
