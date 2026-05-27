@extends('admin.layout')

@section('title', 'Data Perusahaan')
@section('page-title', 'Data Perusahaan')
@section('page-subtitle', 'Daftar Perusahaan Bergabung')

@section('content')

<div class="table-card">
  <div class="table-card-header">
    <div>
      <h5 class="table-card-title">
        <i class="bi bi-building me-2"></i>
        Lowongan Disetujui
      </h5>
      <p class="table-card-subtitle">Semua Data Perusahaan Yang Sudah Bergabung</p>
    </div>
    <span class="count-badge">
      {{ $lowongans->count() }} lowongan
    </span>
  </div>

  <div class="table-responsive">
    <table class="modern-table">
      <thead>
        <tr>
          <th style="width:50px">No</th>
          <th>Perusahaan</th>
          <th>Posisi / Jabatan</th>
          <th style="width:130px">Status</th>
        </tr>
      </thead>
      <tbody>
        @forelse($lowongans as $index => $company)
          <tr>
            <td class="text-center text-muted">{{ $index + 1 }}</td>

            {{-- Perusahaan --}}
            <td>
              <div class="company-cell">
                <div class="company-avatar">
                  {{ strtoupper(substr($company->perusahaan->nama_perusahaan ?? 'P', 0, 1)) }}
                </div>
                <div>
                  <div class="company-name">{{ $company->perusahaan->nama_perusahaan ?? '-' }}</div>
                  <div class="company-id">ID: {{ $company->perusahaan->perusahaan_id ?? '-' }}</div>
                </div>
              </div>
            </td>

            {{-- Posisi --}}
            <td>
              <span class="posisi-pill">{{ $company->posisi }}</span>
            </td>

            {{-- Status --}}
            <td>
              <span class="status-badge badge-approved">
                <i class="bi bi-check-circle-fill me-1"></i>Disetujui
              </span>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4">
              <div class="empty-state">
                <i class="bi bi-building empty-icon"></i>
                <h6>Belum ada lowongan disetujui</h6>
                <p>Lowongan yang disetujui dari dashboard akan muncul di sini</p>
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
      Total <strong>{{ $lowongans->count() }}</strong> lowongan disetujui
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

  .count-badge {
    background: #eff6ff;
    color: #2563eb;
    font-size: 12px;
    font-weight: 700;
    padding: 6px 14px;
    border-radius: 999px;
  }

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
  }
  .modern-table td {
    padding: 16px 20px;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: middle;
  }
  .modern-table tbody tr:last-child td { border-bottom: none; }
  .modern-table tbody tr:hover { background: #fafbff; }

  .company-cell {
    display: flex; align-items: center; gap: 12px;
  }
  .company-avatar {
    width: 38px; height: 38px;
    border-radius: 10px;
    background: linear-gradient(135deg, #2563eb, #7c3aed);
    color: #fff;
    font-size: 15px; font-weight: 700;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
  }
  .company-name {
    font-weight: 600; font-size: 13.5px; color: #1e293b;
  }
  .company-id {
    font-size: 11.5px; color: #94a3b8; margin-top: 2px;
  }

  .posisi-pill {
    background: #f1f5f9;
    color: #475569;
    font-size: 12.5px;
    font-weight: 600;
    padding: 5px 12px;
    border-radius: 999px;
  }

  .status-badge {
    display: inline-flex; align-items: center;
    font-size: 11.5px; font-weight: 600;
    padding: 4px 10px; border-radius: 999px;
  }
  .badge-approved { background: #f0fdf4; color: #16a34a; }

  .empty-state {
    text-align: center; padding: 60px 20px; color: #94a3b8;
  }
  .empty-icon {
    font-size: 48px; display: block; margin-bottom: 14px; opacity: .4;
  }
  .empty-state h6 {
    font-size: 15px; font-weight: 600; color: #64748b; margin-bottom: 6px;
  }
  .empty-state p { font-size: 13px; margin: 0; }
</style>

@endsection
