<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>@yield('title','KONEKSIBILITAS')</title>

  {{-- Bootstrap CDN --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  {{-- Font Plus Jakarta Sans --}}
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    :root{
      --brand:#0d6efd;
      --muted:#6c757d;
      --surface:#f8f9fb;
      --radius:18px;
      --radius-sm:12px;
      --content-w:980px;
    }
    body {
      font-family:'Plus Jakarta Sans',sans-serif;
      background-color:#fff;
    }
    .container-narrow{ max-width: var(--content-w); margin:0 auto; }
    .brand { font-weight:700; letter-spacing:.3px; color:var(--brand); }
    .brand:hover { color:#0b5ed7; text-decoration:none; }
    .nav-link {
      font-weight:500;
      color:#333;
      font-size: 0.875rem;
      transition: all .2s;
    }
    .nav-link:hover {
      color: var(--brand);
    }
    .nav-link.active,
    .nav-link:focus,
    .nav-link:active {
      color: var(--brand) !important;
      font-weight:600;
    }
    .avatar{ width:120px; height:120px; border-radius:50%; object-fit:cover; }
    .card-soft{ background:#fff; border:1px solid #edf1f5; border-radius: var(--radius); }
    .pill{ border-radius:999px; padding:.45rem 1rem; font-weight:500; }
    .doc-row{ background:var(--surface); border-radius: var(--radius-sm); padding:1rem 1.25rem; }
    .doc-row + .doc-row{ margin-top:.85rem; }
    .footer-min{ color:var(--muted); font-size:.95rem; }
    .page-gutter{ padding-inline: min(5vw, 24px); }
    .search-input {
      border: 1px solid #ccc;
      border-radius: 8px;
      padding: 6px 12px;
      font-size: 0.9rem;
      width: 240px;
    }
    .search-input:focus {
      outline: 2px solid var(--brand);
    }
  </style>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
        }

        .container-lowongan {
            max-width: 700px;
            margin: 60px auto;
            background-color: white;
            position: relative;
        }

        .top-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
            padding: 0 10px;
        }

        .back-icon, .save-icon {
            font-size: 24px;
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .judul-halaman {
            font-size: 24px;
            font-weight: 600;
            text-align: center;
            flex-grow: 1;
            margin: 0;
        }

        .card-lowongan {
            border: none;
            background: transparent;
        }

        .header-lowongan {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .logo-lowongan {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 12px;
        }

        .nama-posisi {
            font-size: 20px;
            font-weight: 600;
            line-height: 1.2;
        }

        .nama-perusahaan {
            color: #555;
            font-size: 16px;
        }

        .section-title {
            font-weight: 600;
            font-size: 18px;
            margin-top: 20px;
        }

        .persyaratan {
            white-space: pre-line;
            margin-top: 5px;
        }

        .btn-lamar {
            display: block;
            width: 250px;
            margin: 60px auto 0;
            background-color: #007bff;
            border: none;
            color: white;
            padding: 12px;
            font-size: 16px;
            border-radius: 8px;
            transition: 0.3s;
        }

        .btn-lamar:hover {
            background-color: #0056b3;
        }
    </style>
  @stack('head')
</head>

<body class="bg-white">

{{-- Navbar (bisa di-override) --}}
@section('navbar')
<nav class="navbar navbar-expand-md bg-white border-bottom shadow-sm sticky-top">
  <div class="container page-gutter d-flex align-items-center justify-content-between">
    {{-- Logo --}}
    <a class="navbar-brand d-flex align-items-center gap-2" href="/">
      <span class="text-primary fs-4">✦</span>
      <span class="brand">KONEKSIBILITAS</span>
    </a>

    {{-- Search (Hanya muncul jika @section('search') didefinisikan) --}}
    @hasSection('search')
      <div class="d-none d-md-block">
        @yield('search')
      </div>
    @endif

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navMain">
      <ul class="navbar-nav gap-2">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
        </li>
        <li class="nav-item"><a class="nav-link {{ request()->is('saved') ? 'active' : '' }}" href="#">Simpan</a></li>
        <li class="nav-item"><a class="nav-link {{ request()->is('status') ? 'active' : '' }}" href="#">Status</a></li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}" href="{{ route('profile.show') }}">Profile</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
@show

  {{-- Main Content --}}
  <main class="py-5 page-gutter">
    <div class="container-narrow">
      @yield('content')
    </div>
  </main>


  {{-- Footer --}}
  <footer class="py-4 border-top">
    <div class="container text-center footer-min">
      © 2025 koneksibilitas. Hak cipta dilindungi
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  @stack('body')
</body>
</html>
