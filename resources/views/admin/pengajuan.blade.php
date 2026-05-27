@extends('admin.layout')

@section('title', 'Pengajuan Lowongan')
@section('page-title', 'Pengajuan Lowongan')
@section('page-subtitle', 'Kelola semua pengajuan lowongan dari perusahaan')

@section('content')

<div class="table-card">
  <div class="table-card-header">
    <div>
      <h5 class="table-card-title">
        <i class="bi bi-file-earmark-check me-2"></i>
        Daftar Pengajuan Lowongan
      </h5>
      <p class="table-card-subtitle">Terima atau tolak pengajuan lowongan dari perusahaan</p>
    </div>

    {{-- Search --}}
    <form method="GET" action="{{ route('admin.pengajuan') }}" class="search-form">
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
        <a href="{{ route('admin.pengajuan') }}" class="btn-reset">
          <i class="bi bi-x"></i>
        </a>
      @endif
    </form>
  </div>

  <div class="table-responsive">
    <table class="modern-table">
      <thead>
        <tr>
          <th style="width:50px">No</th>
          <th>Nama Perusahaan</th>
          <th>Persyaratan yang Diajukan</th>
          <th style="width:140px">Status Pengajuan</th>
          <th style="width:200px">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($lowongans as $index => $lowongan)
          <tr>
            <td class="text-center text-muted">{{ $index + 1 }}</td>

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
                  <i class="bi bi-check2-all me-1 text-success"></i>Sudah disetujui
                </span>
              @elseif($lowongan->status === 'ditolak')
                <span class="text-muted" style="font-size:12px;">
                  <i class="bi bi-dash-circle me-1 text-danger"></i>Sudah ditolak
                </span>
              @else
                <div class="aksi-group">
                  <form action="{{ route('lowongan.approve', $lowongan->lowongan_id) }}"
                        method="POST" class="status-action-form d-inline"
                        data-type="approve"
                        data-company="{{ $lowongan->perusahaan->nama_perusahaan ?? 'perusahaan ini' }}">
                    @csrf
                    <button type="button" class="btn-aksi btn-terima btn-action-trigger">
                      <i class="bi bi-check-lg"></i> Terima
                    </button>
                  </form>
                  <form action="{{ route('lowongan.reject', $lowongan->lowongan_id) }}"
                        method="POST" class="status-action-form d-inline"
                        data-type="reject"
                        data-company="{{ $lowongan->perusahaan->nama_perusahaan ?? 'perusahaan ini' }}">
                    @csrf
                    <button type="button" class="btn-aksi btn-tolak btn-action-trigger">
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

  @if($lowongans->count() > 0)
  <div class="table-card-footer">
    <span class="text-muted" style="font-size:13px;">
      Menampilkan <strong>{{ $lowongans->count() }}</strong> pengajuan
    </span>
  </div>
  @endif
</div>

<style>
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

  .search-form { display: flex; align-items: center; gap: 8px; }
  .input-search-wrap { position: relative; }
  .search-icon {
    position: absolute; left: 11px; top: 50%;
    transform: translateY(-50%); color: #94a3b8; font-size: 13px;
  }
  .input-search {
    border: 1px solid #e2e8f0; border-radius: 8px;
    padding: 8px 12px 8px 32px; font-size: 13px; width: 220px;
    outline: none; font-family: 'Plus Jakarta Sans', sans-serif;
    transition: border .2s;
  }
  .input-search:focus { border-color: #2563eb; }
  .btn-search {
    background: #2563eb; color: #fff; border: none;
    border-radius: 8px; padding: 8px 16px; font-size: 13px;
    font-weight: 600; cursor: pointer;
    font-family: 'Plus Jakarta Sans', sans-serif; transition: background .2s;
  }
  .btn-search:hover { background: #1d4ed8; }
  .btn-reset {
    background: #f1f5f9; color: #64748b; border: none;
    border-radius: 8px; padding: 8px 10px; font-size: 14px;
    text-decoration: none; transition: background .2s; line-height: 1;
    display: inline-flex; align-items: center;
  }
  .btn-reset:hover { background: #e2e8f0; color: #1e293b; }

  .modern-table { width: 100%; border-collapse: collapse; font-size: 13.5px; color: #334155; }
  .modern-table thead tr { background: #f8fafc; border-bottom: 1px solid #e2e8f0; }
  .modern-table th {
    padding: 13px 20px; font-size: 11.5px; font-weight: 700;
    color: #94a3b8; text-transform: uppercase; letter-spacing: .5px;
  }
  .modern-table td {
    padding: 16px 20px; border-bottom: 1px solid #f1f5f9; vertical-align: middle;
  }
  .modern-table tbody tr:last-child td { border-bottom: none; }
  .modern-table tbody tr:hover { background: #fafbff; }

  .company-cell { display: flex; align-items: center; gap: 12px; }
  .company-avatar {
    width: 38px; height: 38px; border-radius: 10px;
    background: linear-gradient(135deg, #2563eb, #7c3aed);
    color: #fff; font-size: 15px; font-weight: 700;
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
  }
  .company-name { font-weight: 600; font-size: 13.5px; color: #1e293b; }
  .company-posisi { font-size: 12px; color: #94a3b8; margin-top: 2px; }

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

  .status-badge {
    display: inline-flex; align-items: center;
    font-size: 11.5px; font-weight: 600;
    padding: 4px 10px; border-radius: 999px; white-space: nowrap;
  }
  .badge-approved { background: #f0fdf4; color: #16a34a; }
  .badge-rejected { background: #fef2f2; color: #dc2626; }
  .badge-pending  { background: #fffbeb; color: #d97706; }

  .aksi-group { display: flex; gap: 6px; flex-wrap: wrap; }
  .btn-aksi {
    display: inline-flex; align-items: center; gap: 4px;
    font-size: 12px; font-weight: 600; padding: 6px 12px;
    border-radius: 7px; border: none; cursor: pointer;
    font-family: 'Plus Jakarta Sans', sans-serif; transition: all .18s ease;
  }
  .btn-terima { background: #16a34a; color: #fff; }
  .btn-terima:hover { background: #15803d; transform: translateY(-1px); }
  .btn-tolak { background: #dc2626; color: #fff; }
  .btn-tolak:hover { background: #b91c1c; transform: translateY(-1px); }

  .empty-state { text-align: center; padding: 60px 20px; color: #94a3b8; }
  .empty-icon { font-size: 48px; display: block; margin-bottom: 14px; opacity: .4; }
  .empty-state h6 { font-size: 15px; font-weight: 600; color: #64748b; margin-bottom: 6px; }
  .empty-state p { font-size: 13px; margin: 0; }
</style>

{{-- SweetAlert2 CDN --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<style>
  /* Custom SweetAlert2 overrides to match admin theme */
  .swal2-popup {
    font-family: 'Plus Jakarta Sans', sans-serif !important;
    border-radius: 20px !important;
    padding: 32px 28px !important;
    box-shadow: 0 20px 60px rgba(0,0,0,0.12) !important;
  }
  .swal2-title {
    font-size: 18px !important;
    font-weight: 700 !important;
    color: #1e293b !important;
  }
  .swal2-html-container {
    font-size: 13.5px !important;
    color: #64748b !important;
    margin-top: 6px !important;
  }
  .swal2-actions { gap: 10px !important; margin-top: 24px !important; }
  .swal-btn-terima {
    background: #16a34a !important;
    color: #fff !important;
    border: none !important;
    border-radius: 10px !important;
    font-size: 13px !important;
    font-weight: 700 !important;
    padding: 10px 22px !important;
    font-family: 'Plus Jakarta Sans', sans-serif !important;
    transition: background .2s !important;
  }
  .swal-btn-terima:hover { background: #15803d !important; }
  .swal-btn-tolak {
    background: #dc2626 !important;
    color: #fff !important;
    border: none !important;
    border-radius: 10px !important;
    font-size: 13px !important;
    font-weight: 700 !important;
    padding: 10px 22px !important;
    font-family: 'Plus Jakarta Sans', sans-serif !important;
    transition: background .2s !important;
  }
  .swal-btn-tolak:hover { background: #b91c1c !important; }
  .swal-btn-cancel {
    background: #f1f5f9 !important;
    color: #475569 !important;
    border: none !important;
    border-radius: 10px !important;
    font-size: 13px !important;
    font-weight: 600 !important;
    padding: 10px 22px !important;
    font-family: 'Plus Jakarta Sans', sans-serif !important;
    transition: background .2s !important;
  }
  .swal-btn-cancel:hover { background: #e2e8f0 !important; }
  .swal2-icon { margin-bottom: 12px !important; border: none !important; }
  .swal2-icon.swal2-question { border-color: #2563eb !important; color: #2563eb !important; }
  .swal2-icon.swal2-warning { border-color: #d97706 !important; color: #d97706 !important; }

  /* Toast notification */
  .admin-toast {
    position: fixed;
    bottom: 28px;
    right: 28px;
    z-index: 99999;
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 20px;
    border-radius: 14px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.13);
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13.5px;
    font-weight: 600;
    color: #fff;
    opacity: 0;
    transform: translateY(16px);
    transition: opacity .35s ease, transform .35s ease;
    pointer-events: none;
  }
  .admin-toast.show { opacity: 1; transform: translateY(0); }
  .admin-toast.toast-success { background: linear-gradient(135deg, #16a34a, #15803d); }
  .admin-toast.toast-error   { background: linear-gradient(135deg, #dc2626, #b91c1c); }
  .admin-toast i { font-size: 18px; }
</style>

{{-- Toast container --}}
<div id="admin-toast" class="admin-toast"></div>

<script>
document.addEventListener('DOMContentLoaded', function () {

  /* ─── Toast helper ─────────────────────────────── */
  function showToast(message, type = 'success') {
    const toast = document.getElementById('admin-toast');
    const icon = type === 'success'
      ? '<i class="bi bi-check-circle-fill"></i>'
      : '<i class="bi bi-exclamation-circle-fill"></i>';
    toast.className = `admin-toast toast-${type}`;
    toast.innerHTML = icon + message;
    requestAnimationFrame(() => {
      toast.classList.add('show');
      setTimeout(() => {
        toast.classList.remove('show');
      }, 3200);
    });
  }

  /* ─── Do AJAX action ───────────────────────────── */
  function doAction(form, isApprove) {
    const url = form.action;
    const csrfToken = form.querySelector('input[name="_token"]').value;
    const tr = form.closest('tr');
    const tdAction = tr.querySelector('td:nth-child(5)');
    const tdStatus = tr.querySelector('td:nth-child(4)');
    const buttons = tr.querySelectorAll('.btn-action-trigger');

    /* Loading state */
    buttons.forEach(btn => {
      btn.disabled = true;
      btn.innerHTML = isApprove
        ? '<span class="spinner"></span> Memproses...'
        : '<span class="spinner"></span> Memproses...';
      btn.style.opacity = '0.75';
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
    .then(r => r.json())
    .then(data => {
      if (data.success) {
        if (isApprove) {
          tdStatus.innerHTML = `
            <span class="status-badge badge-approved">
              <i class="bi bi-check-circle-fill me-1"></i>Diterima
            </span>`;
          tdAction.innerHTML = `
            <span class="text-muted" style="font-size:12px;">
              <i class="bi bi-check2-all me-1 text-success"></i>Sudah disetujui
            </span>`;
          showToast('Lowongan berhasil diterima!', 'success');
        } else {
          tdStatus.innerHTML = `
            <span class="status-badge badge-rejected">
              <i class="bi bi-x-circle-fill me-1"></i>Ditolak
            </span>`;
          tdAction.innerHTML = `
            <span class="text-muted" style="font-size:12px;">
              <i class="bi bi-dash-circle me-1 text-danger"></i>Sudah ditolak
            </span>`;
          showToast('Pengajuan lowongan ditolak.', 'error');
        }
      } else {
        showToast('Terjadi kesalahan, coba lagi.', 'error');
        buttons.forEach(btn => { btn.disabled = false; btn.style.opacity = '1'; });
      }
    })
    .catch(() => {
      showToast('Koneksi gagal, coba lagi.', 'error');
      buttons.forEach(btn => { btn.disabled = false; btn.style.opacity = '1'; });
    });
  }

  /* ─── Trigger buttons ──────────────────────────── */
  document.querySelectorAll('.btn-action-trigger').forEach(btn => {
    btn.addEventListener('click', function () {
      const form = this.closest('.status-action-form');
      const type = form.dataset.type;       // 'approve' | 'reject'
      const company = form.dataset.company;
      const isApprove = type === 'approve';

      Swal.fire({
        title: isApprove ? 'Terima Pengajuan?' : 'Tolak Pengajuan?',
        html: isApprove
          ? `Apakah Anda yakin ingin <strong>menerima</strong> pengajuan lowongan dari <strong>${company}</strong>?`
          : `Apakah Anda yakin ingin <strong>menolak</strong> pengajuan lowongan dari <strong>${company}</strong>?`,
        iconHtml: isApprove
          ? '<svg width="38" height="38" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="12" fill="#f0fdf4"/><path d="M7 12.5l3.5 3.5 6.5-7" stroke="#16a34a" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>'
          : '<svg width="38" height="38" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="12" fill="#fef2f2"/><path d="M15 9l-6 6M9 9l6 6" stroke="#dc2626" stroke-width="2.2" stroke-linecap="round"/></svg>',
        customClass: {
          icon: 'border-0 mt-0',
          confirmButton: isApprove ? 'swal-btn-terima' : 'swal-btn-tolak',
          cancelButton: 'swal-btn-cancel',
        },
        confirmButtonText: isApprove ? '<i class="bi bi-check-lg me-1"></i> Ya, Terima' : '<i class="bi bi-x-lg me-1"></i> Ya, Tolak',
        cancelButtonText: 'Batal',
        showCancelButton: true,
        buttonsStyling: false,
        focusConfirm: false,
        reverseButtons: true,
        showClass: { popup: 'animate__animated animate__fadeInDown animate__faster' },
        hideClass: { popup: 'animate__animated animate__fadeOutUp animate__faster' },
      }).then(result => {
        if (result.isConfirmed) {
          doAction(form, isApprove);
        }
      });
    });
  });

});
</script>

@endsection
