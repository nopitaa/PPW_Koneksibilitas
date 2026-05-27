<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin Panel') — Koneksibilitas</title>

  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    :root {
      --sidebar-w: 240px;
      --sidebar-bg: #0f172a;
      --sidebar-hover: #1e293b;
      --sidebar-active: #2563eb;
      --brand: #2563eb;
      --brand-light: #eff6ff;
      --surface: #f8fafc;
      --border: #e2e8f0;
      --text-main: #1e293b;
      --text-muted: #64748b;
      --radius: 14px;
      --radius-sm: 8px;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      background: var(--surface);
      color: var(--text-main);
      min-height: 100vh;
    }

    /* ── Sidebar ─────────────────────────────── */
    .admin-sidebar {
      position: fixed;
      top: 0; left: 0;
      width: var(--sidebar-w);
      height: 100vh;
      background: var(--sidebar-bg);
      display: flex;
      flex-direction: column;
      z-index: 100;
      overflow-y: auto;
    }

    .sidebar-brand {
      padding: 24px 20px 20px;
      border-bottom: 1px solid rgba(255,255,255,.07);
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
    }
    .sidebar-brand .brand-icon {
      width: 34px; height: 34px;
      background: var(--brand);
      border-radius: 9px;
      display: flex; align-items: center; justify-content: center;
      color: #fff; font-size: 16px; font-weight: 800;
      flex-shrink: 0;
    }
    .sidebar-brand .brand-text {
      color: #fff;
      font-size: 13px;
      font-weight: 700;
      letter-spacing: .4px;
      line-height: 1.2;
    }
    .sidebar-brand .brand-text small {
      display: block;
      color: rgba(255,255,255,.4);
      font-size: 10px;
      font-weight: 400;
      letter-spacing: 0;
    }

    .sidebar-nav {
      padding: 16px 12px;
      flex: 1;
    }
    .sidebar-section-label {
      color: rgba(255,255,255,.3);
      font-size: 10px;
      font-weight: 600;
      letter-spacing: .8px;
      text-transform: uppercase;
      padding: 0 8px;
      margin: 16px 0 6px;
    }
    .sidebar-link {
      display: flex;
      align-items: center;
      gap: 10px;
      color: rgba(255,255,255,.65);
      text-decoration: none;
      font-size: 13.5px;
      font-weight: 500;
      padding: 10px 12px;
      border-radius: var(--radius-sm);
      transition: all .18s ease;
      margin-bottom: 2px;
    }
    .sidebar-link i {
      font-size: 16px;
      width: 20px;
      text-align: center;
      flex-shrink: 0;
    }
    .sidebar-link:hover {
      background: var(--sidebar-hover);
      color: #fff;
    }
    .sidebar-link.active {
      background: var(--brand);
      color: #fff;
      font-weight: 600;
    }

    .sidebar-footer {
      padding: 16px 12px;
      border-top: 1px solid rgba(255,255,255,.07);
    }
    .sidebar-logout {
      display: flex;
      align-items: center;
      gap: 10px;
      color: rgba(255,255,255,.5);
      text-decoration: none;
      font-size: 13px;
      font-weight: 500;
      padding: 10px 12px;
      border-radius: var(--radius-sm);
      transition: all .18s ease;
    }
    .sidebar-logout:hover {
      background: rgba(239,68,68,.15);
      color: #f87171;
    }

    /* ── Main area ───────────────────────────── */
    .admin-main {
      margin-left: var(--sidebar-w);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .admin-topbar {
      background: #fff;
      border-bottom: 1px solid var(--border);
      padding: 14px 28px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      z-index: 50;
    }
    .topbar-title {
      font-size: 16px;
      font-weight: 700;
      color: var(--text-main);
    }
    .topbar-title small {
      display: block;
      font-size: 12px;
      font-weight: 400;
      color: var(--text-muted);
      margin-top: 1px;
    }
    .admin-badge {
      display: flex;
      align-items: center;
      gap: 8px;
      background: var(--brand-light);
      border-radius: 999px;
      padding: 6px 14px 6px 8px;
    }
    .admin-badge .av {
      width: 28px; height: 28px;
      background: var(--brand);
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      color: #fff; font-size: 12px; font-weight: 700;
    }
    .admin-badge span {
      font-size: 12.5px;
      font-weight: 600;
      color: var(--brand);
    }

    .admin-content {
      padding: 28px;
      flex: 1;
    }

    /* ── Alert flash ─────────────────────────── */
    .flash-alert {
      border-radius: var(--radius-sm);
      font-size: 13.5px;
      padding: 10px 16px;
      margin-bottom: 20px;
      border: none;
    }

    /* ── Responsive ──────────────────────────── */
    @media (max-width: 768px) {
      .admin-sidebar { width: 0; overflow: hidden; }
      .admin-main { margin-left: 0; }
    }
  </style>
</head>
<body>

  {{-- ═══ SIDEBAR ═══ --}}
  <aside class="admin-sidebar">
    <a href="{{ route('dashboard') }}" class="sidebar-brand">
      <div class="brand-icon">K</div>
      <div class="brand-text">
        KONEKSIBILITAS
        <small>Admin Panel</small>
      </div>
    </a>

    <nav class="sidebar-nav">
      <div class="sidebar-section-label">Menu Utama</div>

      <a href="{{ route('dashboard') }}"
         class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <i class="bi bi-grid-1x2"></i>
        Dashboard
      </a>

      <a href="{{ route('admin.pengajuan') }}"
         class="sidebar-link {{ request()->routeIs('admin.pengajuan') ? 'active' : '' }}">
        <i class="bi bi-file-earmark-check"></i>
        Pengajuan Lowongan
      </a>

      <a href="{{ route('perusahaan') }}"
         class="sidebar-link {{ request()->routeIs('perusahaan') ? 'active' : '' }}">
        <i class="bi bi-building"></i>
        Data Perusahaan
      </a>

      <div class="sidebar-section-label">Sistem</div>

      <a href="{{ route('admin.login') }}" class="sidebar-link">
        <i class="bi bi-gear"></i>
        Pengaturan
      </a>
    </nav>

    <div class="sidebar-footer">
      <a href="{{ route('admin.logout') }}" class="sidebar-logout"
         onclick="return confirm('Yakin ingin logout?')">
        <i class="bi bi-box-arrow-left"></i>
        Keluar
      </a>
    </div>
  </aside>

  {{-- ═══ MAIN ═══ --}}
  <div class="admin-main">
    {{-- Topbar --}}
    <header class="admin-topbar">
      <div class="topbar-title">
        @yield('page-title', 'Dashboard')
        <small>@yield('page-subtitle', 'Selamat datang di panel admin Koneksibilitas')</small>
      </div>
      <div class="admin-badge">
        <div class="av">A</div>
        <span>Admin</span>
      </div>
    </header>

    {{-- Flash messages --}}
    <div class="admin-content">
      @if(session('success'))
        <div class="alert flash-alert alert-success d-flex align-items-center gap-2">
          <i class="bi bi-check-circle-fill"></i>
          {{ session('success') }}
        </div>
      @endif
      @if(session('error'))
        <div class="alert flash-alert alert-danger d-flex align-items-center gap-2">
          <i class="bi bi-exclamation-circle-fill"></i>
          {{ session('error') }}
        </div>
      @endif

      @yield('content')
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
