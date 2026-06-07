@extends('layouts_perusahaan.master')

@section('page-title', 'Data Pelamar')

@section('content')

<style>
    /* ── Warna header halaman ── */
    .page-header-card {
        background: linear-gradient(135deg, #1a56db 0%, #0b3fa8 100%);
        border-radius: 16px;
        padding: 1.5rem 2rem;
        color: #fff;
        margin-bottom: 1.5rem;
    }
    .page-header-card h4 { font-weight: 700; margin: 0; }
    .page-header-card p  { margin: .25rem 0 0; opacity: .85; font-size: .92rem; }

    /* ── Alert sukses ── */
    .alert-success-custom {
        background: #d1fae5; color: #065f46;
        border-left: 4px solid #10b981;
        border-radius: 10px; padding: .85rem 1.2rem;
        display: flex; align-items: center; gap: .65rem;
        font-weight: 500; margin-bottom: 1.25rem;
    }

    /* ── Accordion lowongan ── */
    .lowongan-block {
        border-radius: 14px;
        border: 1px solid #e5e7eb;
        background: #fff;
        box-shadow: 0 2px 8px rgba(255, 255, 255, 0.06);
        margin-bottom: 1.25rem;
        overflow: hidden;
    }
    .lowongan-header {
        display: flex; align-items: center; justify-content: space-between;
        padding: 1rem 1.4rem;
        background: #f8faff;
        cursor: pointer;
        user-select: none;
        border-bottom: 1px solid #e5e7eb;
        transition: background .2s;
    }
    .lowongan-header:hover { background: #eef2ff; }
    .lowongan-title {
        font-size: 1rem; font-weight: 700; color: #1e3a8a;
        display: flex; align-items: center; gap: .55rem;
    }
    .badge-kategori {
        background: #ede9fe; color: #6d28d9;
        font-size: .72rem; font-weight: 600;
        padding: 3px 10px; border-radius: 20px;
    }
    .badge-jumlah {
        background: #dbeafe; color: #1d4ed8;
        font-size: .75rem; font-weight: 600;
        padding: 4px 12px; border-radius: 20px;
        white-space: nowrap;
    }
    .chevron { transition: transform .3s; font-size: 1.1rem; color: #6b7280; }
    .chevron.open { transform: rotate(180deg); }

    .lowongan-body { padding: 0; }

    /* ── Tabel pelamar ── */
    .table-pelamar { margin: 0; }
    .table-pelamar thead th {
        background: #f1f5f9; color: #374151;
        font-size: .78rem; font-weight: 700;
        text-transform: uppercase; letter-spacing: .04em;
        padding: .75rem 1rem; border: none;
    }
    .table-pelamar tbody td {
        padding: .75rem 1rem; vertical-align: middle;
        border-bottom: 1px solid #f0f0f0; font-size: .88rem;
    }
    .table-pelamar tbody tr:last-child td { border-bottom: none; }
    .table-pelamar tbody tr:hover { background: #f9fafb; }

    /* ── Status badge ── */
    .status-badge {
        display: inline-block;
        padding: 4px 12px; border-radius: 20px;
        font-size: .75rem; font-weight: 600;
    }
    .status-terkirim  { background:#dbeafe; color:#1d4ed8; }
    .status-diproses   { background:#fef3c7; color:#d97706; }
    .status-diterima   { background:#d1fae5; color:#065f46; }
    .status-ditolak    { background:#fee2e2; color:#b91c1c; }

    /* ── Form update status ── */
    .status-form { display: flex; align-items: center; gap: .5rem; flex-wrap: nowrap; }
    .status-select {
        font-size: .82rem; padding: .35rem .6rem;
        border: 1px solid #d1d5db; border-radius: 8px;
        background: #fff; color: #374151;
        cursor: pointer; min-width: 155px;
    }
    .status-select:focus { outline: none; border-color: #6366f1; box-shadow: 0 0 0 2px rgba(99,102,241,.15); }
    .btn-update-status {
        padding: .35rem .8rem; font-size: .8rem; font-weight: 600;
        border-radius: 8px; border: none; cursor: pointer;
        background: linear-gradient(135deg,#4f46e5,#7c3aed);
        color: #fff; transition: opacity .2s;
        white-space: nowrap;
    }
    .btn-update-status:hover { opacity: .88; }

    /* ── Timestamp ── */
    .update-time { font-size: .75rem; color: #9ca3af; white-space: nowrap; }

    /* ── Empty state ── */
    .empty-state {
        text-align: center; padding: 2.5rem 1rem; color: #9ca3af;
    }
    .empty-state i { font-size: 2.5rem; margin-bottom: .5rem; display: block; }
</style>

{{-- ── HEADER ── --}}
<div class="page-header-card mx-2">
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h4><i class="bi bi-people-fill me-2"></i>Data Pelamar</h4>
            <p>Kelola lamaran masuk berdasarkan lowongan pekerjaan Anda</p>
        </div>
        <div class="text-end">
            <span style="background:rgba(255,255,255,.15);border-radius:10px;padding:6px 14px;font-size:.85rem;">
                {{ $perusahaan->nama_perusahaan }}
            </span>
        </div>
    </div>
</div>

<div class="mx-2">

    {{-- ── Alert sukses ── --}}
    @if(session('success'))
        <div class="alert-success-custom">
            <i class="bi bi-check-circle-fill"></i>
            {{ session('success') }}
        </div>
    @endif

    @if($lowongans->isEmpty())
        {{-- Belum ada lowongan --}}
        <div class="lowongan-block">
            <div class="empty-state">
                <i class="bi bi-briefcase"></i>
                <p class="mb-0 fw-semibold text-muted">Anda belum memiliki lowongan pekerjaan.</p>
                <a href="{{ route('tambah-lowongan') }}" class="btn btn-primary btn-sm mt-3">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Lowongan
                </a>
            </div>
        </div>
    @else
        @foreach($lowongans as $i => $lowongan)
            @php $jumlah = $lowongan->lamaran->count(); @endphp

            <div class="lowongan-block">

                {{-- ── Header accordion ── --}}
                <div class="lowongan-header" onclick="toggleBlock({{ $i }})">
                    <div class="lowongan-title">
                        <i class="bi bi-briefcase-fill" style="color:#4f46e5;"></i>
                        {{ $lowongan->posisi }}
                        <span class="badge-kategori">{{ $lowongan->kategori_pekerjaan }}</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge-jumlah">
                            <i class="bi bi-person-fill me-1"></i>{{ $jumlah }} Pelamar
                        </span>
                        <i class="bi bi-chevron-down chevron" id="chevron-{{ $i }}"></i>
                    </div>
                </div>

                {{-- ── Body accordion ── --}}
                <div class="lowongan-body" id="block-{{ $i }}" style="display:none;">
                    @if($jumlah === 0)
                        <div class="empty-state">
                            <i class="bi bi-inbox"></i>
                            <p class="mb-0">Belum ada pelamar untuk lowongan ini.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-pelamar">
                                <thead>
                                    <tr>
                                        <th style="width:42px;">No</th>
                                        <th>Nama Lengkap</th>
                                        <th>Email</th>
                                        <th>No HP</th>
                                        <th>Pendidikan</th>
                                        <th>Status</th>
                                        <th>Terakhir Diperbarui</th>
                                        <th>Ubah Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($lowongan->lamaran as $j => $lmr)
                                        <tr>
                                            <td class="text-center text-muted">{{ $j + 1 }}</td>

                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                                                         style="width:34px;height:34px;background:#ede9fe;flex-shrink:0;">
                                                        <i class="bi bi-person-fill" style="color:#6d28d9;font-size:.9rem;"></i>
                                                    </div>
                                                    <div>
                                                        <div class="fw-semibold" style="font-size:.87rem;line-height:1.2;">
                                                            {{ $lmr->nama_lengkap }}
                                                        </div>
                                                        <div style="font-size:.74rem;color:#9ca3af;">
                                                            {{ $lmr->jenis_kelamin ?? '-' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>{{ $lmr->email }}</td>

                                            <td>{{ $lmr->nomor_hp ?? '-' }}</td>

                                            <td>
                                                {{ $lmr->pendidikan ?? '-' }}
                                                @if($lmr->nama_institusi)
                                                    <div style="font-size:.74rem;color:#9ca3af;">
                                                        {{ $lmr->nama_institusi }}
                                                    </div>
                                                @endif
                                            </td>

                                            {{-- Status badge --}}
                                            <td>
                                                @php
                                                    $statusClass = match($lmr->status) {
                                                        'Diproses' => 'status-diproses',
                                                        'Diterima' => 'status-diterima',
                                                        'Ditolak'  => 'status-ditolak',
                                                        default    => 'status-terkirim',
                                                    };
                                                @endphp
                                                <span class="status-badge {{ $statusClass }}">
                                                    {{ $lmr->status ?? 'Terkirim' }}
                                                </span>
                                            </td>

                                            {{-- Terakhir diperbarui --}}
                                            <td>
                                                <span class="update-time">
                                                    <i class="bi bi-clock me-1"></i>
                                                    {{ $lmr->updated_at ? $lmr->updated_at->locale('id')->diffForHumans() : '-' }}
                                                </span>
                                                <div class="update-time" style="color:#d1d5db;">
                                                    {{ $lmr->updated_at ? $lmr->updated_at->format('d M Y, H:i') : '' }}
                                                </div>
                                            </td>

                                            {{-- Form ubah status --}}
                                            <td>
                                                <form method="POST"
                                                      action="{{ route('update-status-lamaran', $lmr->lamaran_id) }}"
                                                      class="status-form">
                                                    @csrf
                                                    <select name="status" class="status-select">
                                                        @foreach(['Terkirim','Diproses','Diterima','Ditolak'] as $opt)
                                                            <option value="{{ $opt }}"
                                                                {{ ($lmr->status ?? 'Terkirim') === $opt ? 'selected' : '' }}>
                                                                {{ $opt === 'Diproses' ? 'Sedang Diproses' : $opt }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <button type="submit" class="btn-update-status">
                                                        <i class="bi bi-check2 me-1"></i>Simpan
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>{{-- /lowongan-body --}}

            </div>{{-- /lowongan-block --}}
        @endforeach
    @endif

</div>

@endsection

@section('scripts')
<script>
    function toggleBlock(i) {
        const body    = document.getElementById('block-' + i);
        const chevron = document.getElementById('chevron-' + i);
        const isOpen  = body.style.display !== 'none';
        body.style.display = isOpen ? 'none' : 'block';
        chevron.classList.toggle('open', !isOpen);
    }

    // Buka accordion yang punya pelamar secara default
    document.addEventListener('DOMContentLoaded', function () {
        @foreach($lowongans as $i => $lowongan)
            @if($lowongan->lamaran->count() > 0)
                toggleBlock({{ $i }});
            @endif
        @endforeach
    });
</script>
@endsection
