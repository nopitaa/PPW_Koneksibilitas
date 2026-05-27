@extends('admin.layout')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan data dan pengajuan lowongan')

@section('content')

{{-- ════════════════════════════════
     CARD STATISTIK
════════════════════════════════ --}}
<div class="row g-4 mb-5">

  {{-- Card: Lowongan Aktif --}}
  <div class="col-xl-3 col-md-6">
    <div class="stat-card">
      <div class="stat-icon" style="background:#eff6ff; color:#2563eb;">
        <i class="bi bi-briefcase-fill"></i>
      </div>
      <div class="stat-body">
        <p class="stat-label">Lowongan Aktif</p>
        <h2 class="stat-value" id="stat-lowongan-aktif">{{ $totalLowonganAktif }}</h2>
        <span class="stat-note">Status disetujui</span>
      </div>
    </div>
  </div>

  {{-- Card: Total Perusahaan --}}
  <div class="col-xl-3 col-md-6">
    <div class="stat-card">
      <div class="stat-icon" style="background:#f0fdf4; color:#16a34a;">
        <i class="bi bi-building-fill"></i>
      </div>
      <div class="stat-body">
        <p class="stat-label">Perusahaan Aktif</p>
        <h2 class="stat-value" id="stat-perusahaan">{{ $totalPerusahaan }}</h2>
        <span class="stat-note">Total terdaftar</span>
      </div>
    </div>
  </div>

  {{-- Card: Menunggu Review --}}
  <div class="col-xl-3 col-md-6">
    <div class="stat-card">
      <div class="stat-icon" style="background:#fffbeb; color:#d97706;">
        <i class="bi bi-hourglass-split"></i>
      </div>
      <div class="stat-body">
        <p class="stat-label">Menunggu Review</p>
        <h2 class="stat-value" id="stat-pending">{{ $totalPending }}</h2>
        <span class="stat-note">Perlu tindakan</span>
      </div>
    </div>
  </div>

  {{-- Card: Ditolak --}}
  <div class="col-xl-3 col-md-6">
    <div class="stat-card">
      <div class="stat-icon" style="background:#fef2f2; color:#dc2626;">
        <i class="bi bi-x-circle-fill"></i>
      </div>
      <div class="stat-body">
        <p class="stat-label">Ditolak</p>
        <h2 class="stat-value" id="stat-ditolak">{{ $totalDitolak }}</h2>
        <span class="stat-note">Pengajuan ditolak</span>
      </div>
    </div>
  </div>

</div>

{{-- ════════════════════════════════
     TABEL PENGAJUAN LOWONGAN
════════════════════════════════ --}}
<div class="table-card" id="pengajuan">

  {{-- Header tabel --}}
  <div class="table-card-header">
    <div>
      <h5 class="table-card-title">
        <i class="bi bi-file-earmark-check me-2"></i>
        Pengajuan Lowongan
      </h5>
      <p class="table-card-subtitle">Kelola semua pengajuan lowongan dari perusahaan</p>
    </div>

    {{-- Search --}}
    <form method="GET" action="{{ route('dashboard') }}" class="search-form">
      <div class="input-search-wrap">
        <i class="bi bi-search search-icon"></i>
        <input type="text"
               name="keyword"
               class="input-search"
               placeholder="Cari perusahaan atau posisi..."
               value="{{ request('keyword') }}">
      </div>
      <button type="submit" class="btn-search">Cari</button>
      @if(request('keyword'))
        <a href="{{ route('dashboard') }}" class="btn-reset">
          <i class="bi bi-x"></i>
        </a>
      @endif
    </form>
  </div>

  {{-- Tabel --}}
  <div class="table-responsive">
    <table class="modern-table">
      <thead>
        <tr>
          <th style="width:50px">No</th>
          <th>Perusahaan</th>
          <th>Persyaratan yang Diajukan</th>
          <th style="width:140px">Status</th>
          <th style="width:180px">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($lowongans as $index => $lowongan)
          <tr>
            {{-- No --}}
            <td class="text-center text-muted fw-500">{{ $index + 1 }}</td>

            {{-- Perusahaan --}}
            <td>
              <div class="company-cell">
                <div class="company-avatar">
                  {{ strtoupper(substr($lowongan->perusahaan->nama_perusahaan ?? 'P', 0, 1)) }}
                </div>
                <div>
                  <div class="company-name">{{ $lowongan->perusahaan->nama_perusahaan ?? '-' }}</div>
                  <div class="company-posisi">{{ $lowongan->posisi }}</div>
                </div>
              </div>
            </td>

            {{-- Persyaratan --}}
            <td>
              @if(!empty($lowongan->persyaratan) && strip_tags($lowongan->persyaratan) !== '')
                <div class="persyaratan-list">
                  {!! str_replace('&nbsp;', ' ', strip_tags($lowongan->persyaratan, '<ul><ol><li><p><br><strong><b><i><em>')) !!}
                </div>
              @else
                <span class="text-muted" style="font-size: 12.5px; font-style: italic;">Tidak ada persyaratan</span>
              @endif
            </td>

            {{-- Status Badge --}}
            <td>
              @if($lowongan->status === 'disetujui')
                <span class="status-badge badge-approved">
                  <i class="bi bi-check-circle-fill me-1"></i>Diterima
                </span>
              @elseif($lowongan->status === 'ditolak')
                <span class="status-badge badge-rejected">
                  <i class="bi bi-x-circle-fill me-1"></i>Ditolak
                </span>
              @else
                <span class="status-badge badge-pending">
                  <i class="bi bi-clock-fill me-1"></i>Pending
                </span>
              @endif
            </td>

            {{-- Aksi --}}
            <td>
              @if($lowongan->status === 'disetujui')
                <span class="text-muted" style="font-size:12px;">
                  <i class="bi bi-check2-all me-1"></i>Sudah disetujui
                </span>
              @elseif($lowongan->status === 'ditolak')
                <span class="text-muted" style="font-size:12px;">
                  <i class="bi bi-dash-circle me-1"></i>Sudah ditolak
                </span>
              @else
                <div class="aksi-group">
                  <form action="{{ route('lowongan.approve', $lowongan->lowongan_id) }}"
                        method="POST" class="status-action-form d-inline">
                    @csrf
                    <button type="submit" class="btn-aksi btn-terima"
                            onclick="return confirm('Terima pengajuan ini?')">
                      <i class="bi bi-check-lg"></i> Terima
                    </button>
                  </form>
                  <form action="{{ route('lowongan.reject', $lowongan->lowongan_id) }}"
                        method="POST" class="status-action-form d-inline">
                    @csrf
                    <button type="submit" class="btn-aksi btn-tolak"
                            onclick="return confirm('Tolak pengajuan ini?')">
                      <i class="bi bi-x-lg"></i> Tolak
                    </button>
                  </form>
                </div>
              @endif
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5">
              <div class="empty-state">
                <i class="bi bi-inbox empty-icon"></i>
                <h6>Belum ada pengajuan lowongan</h6>
                <p>Pengajuan dari perusahaan akan muncul di sini</p>
              </div>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{-- Footer info --}}
  @if($lowongans->count() > 0)
  <div class="table-card-footer">
    <span class="text-muted" style="font-size:13px;">
      Menampilkan <strong>{{ $lowongans->count() }}</strong> pengajuan
    </span>
  </div>
  @endif
</div>

{{-- ════════════════════════════════
     STYLES HALAMAN INI
════════════════════════════════ --}}
<style>
  /* ── Stat Cards ─────────────── */
  .stat-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 22px 22px;
    display: flex;
    align-items: center;
    gap: 16px;
    transition: box-shadow .2s, transform .2s;
  }
  .stat-card:hover {
    box-shadow: 0 8px 24px rgba(0,0,0,.07);
    transform: translateY(-2px);
  }
  .stat-icon {
    width: 52px; height: 52px;
    border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 22px;
    flex-shrink: 0;
  }
  .stat-label {
    font-size: 12px;
    font-weight: 600;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: .5px;
    margin-bottom: 4px;
  }
  .stat-value {
    font-size: 30px;
    font-weight: 800;
    color: #1e293b;
    line-height: 1;
    margin-bottom: 4px;
  }
  .stat-note {
    font-size: 11.5px;
    color: #94a3b8;
  }

  /* ── Table Card ─────────────── */
  .table-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    overflow: hidden;
  }
  .table-card-header {
    padding: 20px 24px;
    border-bottom: 1px solid #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    flex-wrap: wrap;
  }
  .table-card-title {
    font-size: 15px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 2px;
  }
  .table-card-subtitle {
    font-size: 12.5px;
    color: #94a3b8;
    margin: 0;
  }
  .table-card-footer {
    padding: 14px 24px;
    border-top: 1px solid #f1f5f9;
    background: #fafafa;
  }

  /* ── Search ─────────────────── */
  .search-form {
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .input-search-wrap {
    position: relative;
  }
  .search-icon {
    position: absolute;
    left: 11px; top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
    font-size: 13px;
  }
  .input-search {
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 8px 12px 8px 32px;
    font-size: 13px;
    width: 220px;
    outline: none;
    font-family: 'Plus Jakarta Sans', sans-serif;
    transition: border .2s;
  }
  .input-search:focus { border-color: #2563eb; }
  .btn-search {
    background: #2563eb;
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 8px 16px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    font-family: 'Plus Jakarta Sans', sans-serif;
    transition: background .2s;
  }
  .btn-search:hover { background: #1d4ed8; }
  .btn-reset {
    background: #f1f5f9;
    color: #64748b;
    border: none;
    border-radius: 8px;
    padding: 8px 10px;
    font-size: 14px;
    text-decoration: none;
    transition: background .2s;
    line-height: 1;
    display: inline-flex; align-items: center;
  }
  .btn-reset:hover { background: #e2e8f0; color: #1e293b; }

  /* ── Modern Table ────────────── */
  .modern-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13.5px;
    color: #334155;
  }
  .modern-table thead tr {
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
  }
  .modern-table th {
    padding: 13px 20px;
    font-size: 11.5px;
    font-weight: 700;
    color: #94a3b8;
    text-transform: uppercase;
    letter-spacing: .5px;
    white-space: nowrap;
  }
  .modern-table td {
    padding: 16px 20px;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: middle;
  }
  .modern-table tbody tr:last-child td { border-bottom: none; }
  .modern-table tbody tr:hover { background: #fafbff; }

  /* ── Company cell ────────────── */
  .company-cell {
    display: flex;
    align-items: center;
    gap: 12px;
  }
  .company-avatar {
    width: 36px; height: 36px;
    border-radius: 10px;
    background: linear-gradient(135deg, #2563eb, #7c3aed);
    color: #fff;
    font-size: 14px;
    font-weight: 700;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
  }
  .company-name {
    font-weight: 600;
    font-size: 13.5px;
    color: #1e293b;
    line-height: 1.3;
  }
  .company-posisi {
    font-size: 12px;
    color: #94a3b8;
    margin-top: 2px;
  }

  /* ── Persyaratan ─────────────── */
  .persyaratan-list {
    max-width: 320px;
    font-size: 12.5px;
    color: #475569;
    line-height: 1.6;
    word-break: break-word;
  }
  .persyaratan-list ul, .persyaratan-list ol {
    margin: 0;
    padding-left: 16px;
  }
  .persyaratan-list li {
    margin-bottom: 6px;
  }
  .persyaratan-list li:last-child {
    margin-bottom: 0;
  }

  /* ── Status Badge ────────────── */
  .status-badge {
    display: inline-flex;
    align-items: center;
    font-size: 11.5px;
    font-weight: 600;
    padding: 4px 10px;
    border-radius: 999px;
    white-space: nowrap;
  }
  .badge-approved { background: #f0fdf4; color: #16a34a; }
  .badge-rejected { background: #fef2f2; color: #dc2626; }
  .badge-pending  { background: #fffbeb; color: #d97706; }

  /* ── Aksi Buttons ────────────── */
  .aksi-group { display: flex; gap: 6px; flex-wrap: wrap; }
  .btn-aksi {
    display: inline-flex; align-items: center; gap: 4px;
    font-size: 12px; font-weight: 600;
    padding: 6px 12px;
    border-radius: 7px;
    border: none;
    cursor: pointer;
    font-family: 'Plus Jakarta Sans', sans-serif;
    transition: all .18s ease;
  }
  .btn-terima {
    background: #16a34a;
    color: #fff;
  }
  .btn-terima:hover { background: #15803d; transform: translateY(-1px); }
  .btn-tolak {
    background: #dc2626;
    color: #fff;
  }
  .btn-tolak:hover { background: #b91c1c; transform: translateY(-1px); }

  /* ── Empty State ─────────────── */
  .empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #94a3b8;
  }
  .empty-icon {
    font-size: 48px;
    display: block;
    margin-bottom: 14px;
    opacity: .4;
  }
  .empty-state h6 {
    font-size: 15px;
    font-weight: 600;
    color: #64748b;
    margin-bottom: 6px;
  }
  .empty-state p {
    font-size: 13px;
    margin: 0;
  }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const forms = document.querySelectorAll('.status-action-form');
  
  forms.forEach(form => {
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      
      const confirmMsg = this.querySelector('button').getAttribute('onclick');
      if (confirmMsg) {
        const match = confirmMsg.match(/confirm\('([^']+)'\)/);
        if (match && !confirm(match[1])) {
          return;
        }
      }
      
      const url = this.action;
      const csrfToken = this.querySelector('input[name="_token"]').value;
      const tr = this.closest('tr');
      const actionGroup = this.closest('.aksi-group');
      const tdAction = tr.querySelector('td:nth-child(5)');
      const tdStatus = tr.querySelector('td:nth-child(4)');
      
      const buttons = actionGroup.querySelectorAll('button');
      buttons.forEach(btn => {
        btn.disabled = true;
        btn.style.opacity = '0.6';
      });
      
      fetch(url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken,
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({})
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          const isApprove = url.includes('approve');
          if (isApprove) {
            tdStatus.innerHTML = `
              <span class="status-badge badge-approved">
                <i class="bi bi-check-circle-fill me-1"></i>Diterima
              </span>
            `;
            tdAction.innerHTML = `
              <span class="text-muted" style="font-size:12px;">
                <i class="bi bi-check2-all me-1 text-success"></i>Sudah disetujui
              </span>
            `;
          } else {
            tdStatus.innerHTML = `
              <span class="status-badge badge-rejected">
                <i class="bi bi-x-circle-fill me-1"></i>Ditolak
              </span>
            `;
            tdAction.innerHTML = `
              <span class="text-muted" style="font-size:12px;">
                <i class="bi bi-dash-circle me-1 text-danger"></i>Sudah ditolak
              </span>
            `;
          }
          
          if (data.stats) {
            const statAktif = document.getElementById('stat-lowongan-aktif');
            const statPerusahaan = document.getElementById('stat-perusahaan');
            const statPending = document.getElementById('stat-pending');
            const statDitolak = document.getElementById('stat-ditolak');
            
            if (statAktif) statAktif.textContent = data.stats.aktif;
            if (statPerusahaan) statPerusahaan.textContent = data.stats.perusahaan;
            if (statPending) statPending.textContent = data.stats.pending;
            if (statDitolak) statDitolak.textContent = data.stats.ditolak;
          }
        } else {
          alert('Terjadi kesalahan, silakan coba lagi.');
          buttons.forEach(btn => {
            btn.disabled = false;
            btn.style.opacity = '1';
          });
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan koneksi.');
        buttons.forEach(btn => {
          btn.disabled = false;
          btn.style.opacity = '1';
        });
      });
    });
  });
});
</script>

@endsection
