<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Koneksibilitas Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f7fbff;
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
      color: #007bff;
      text-decoration: none;
      font-weight: 500;
      padding: 8px 20px;
      transition: all 0.3s;
    }

    .sidebar a.active {
      color: #000;
      font-weight: 600;
    }

    .sidebar a:hover {
      color: #000;
    }

    .logout {
      color: red;
      text-decoration: none;
      font-weight: 500;
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
      color: #007bff;
      font-weight: 600;
      font-size: 14px;
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

      <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">Beranda</a>
      <a href="{{ route('perusahaan') }}" class="{{ request()->is('perusahaan') ? 'active' : '' }}">Perusahaan</a>
    </div>

    <!-- Main content -->
    <div class="col-10 p-4">
      <div class="d-flex justify-content-end mb-3">
      <a href="#" class="text-danger fw-bold text-decoration-none" onclick="confirmLogout()">Logout</a>

      <script>
        function confirmLogout() {
          if (confirm('Apakah Anda yakin ingin logout?')) {
            window.location.href = '{{ route('login') }}';
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
