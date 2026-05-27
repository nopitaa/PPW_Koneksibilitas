@extends('layouts.user')

@section('title', 'Karir - Koneksibilitas')

@section('content')

{{-- HERO --}}
<section class="text-center py-4 px-4">
    <h1 class="text-3xl fw-bold">
        Temukan Karirmu <span class="text-primary">Bersama Kami</span>
    </h1>
    <p class="text-muted mt-2">
        {{ number_format($totalLowongan) }} lowongan tersedia dari berbagai perusahaan terpercaya
    </p>
</section>

{{-- SEARCH & FILTER --}}
<section class="mt-3 mb-4">
    <form method="GET" action="{{ route('karir') }}" id="search-filter-form">
        <div class="row g-3 align-items-end">

            {{-- Search Input --}}
            <div class="col-md-6">
                <label class="form-label fw-semibold small text-muted mb-1">Cari Lowongan</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input
                        type="text"
                        name="search"
                        id="search-input"
                        class="form-control border-start-0 ps-0"
                        placeholder="Posisi, kategori, atau perusahaan..."
                        value="{{ request('search') }}"
                        style="border-radius: 0 10px 10px 0;"
                    >
                </div>
            </div>

            {{-- Filter Kategori --}}
            <div class="col-md-4">
                <label class="form-label fw-semibold small text-muted mb-1">Kategori</label>
                <select name="kategori" id="kategori-select" class="form-select" style="border-radius:10px;">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori }}" {{ request('kategori') === $kategori ? 'selected' : '' }}>
                            {{ $kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Submit & Reset --}}
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100" style="border-radius:10px;">
                    <i class="bi bi-funnel me-1"></i>Filter
                </button>
                @if(request('search') || request('kategori'))
                    <a href="{{ route('karir') }}" class="btn btn-outline-secondary" style="border-radius:10px;" title="Reset filter">
                        <i class="bi bi-x-lg"></i>
                    </a>
                @endif
            </div>

        </div>
    </form>

    {{-- Active filter pills --}}
    @if(request('search') || request('kategori'))
        <div class="d-flex gap-2 mt-3 flex-wrap align-items-center">
            <span class="text-muted small">Filter aktif:</span>
            @if(request('search'))
                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2" style="border-radius:999px;">
                    <i class="bi bi-search me-1"></i>{{ request('search') }}
                </span>
            @endif
            @if(request('kategori'))
                <span class="badge bg-success bg-opacity-10 text-success px-3 py-2" style="border-radius:999px;">
                    <i class="bi bi-tag me-1"></i>{{ request('kategori') }}
                </span>
            @endif
            <span class="text-muted small">— {{ $lowongan->total() }} hasil ditemukan</span>
        </div>
    @endif
</section>

{{-- HASIL LOWONGAN --}}
<section class="mt-2">

    @if($lowongan->count() > 0)

        {{-- Info jumlah & pagination --}}
        <div class="row g-4">
            @foreach($lowongan as $item)
                <div class="col-md-4 col-sm-6">
                    <div class="card-soft p-4 h-100 d-flex flex-column karir-card" style="transition: transform .2s, box-shadow .2s;">
                        {{-- Logo + Nama Perusahaan --}}
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <img
                                src="{{ asset('assets/img/logoperusahaan.png') }}"
                                alt="{{ $item->perusahaan->nama_perusahaan }}"
                                style="width:44px; height:44px; border-radius:10px; object-fit:cover; border:1px solid #edf1f5;"
                            >
                            <div class="flex-grow-1 overflow-hidden">
                                <p class="fw-semibold mb-0 text-truncate small">{{ $item->perusahaan->nama_perusahaan }}</p>
                                @if($item->perusahaan->alamat)
                                    <p class="text-muted mb-0" style="font-size:0.72rem;">
                                        <i class="bi bi-geo-alt me-1"></i>{{ Str::limit($item->perusahaan->alamat, 30) }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        {{-- Posisi --}}
                        <h5 class="fw-bold mb-2" style="font-size:1rem;">{{ $item->posisi }}</h5>

                        {{-- Kategori badge --}}
                        @if($item->kategori_pekerjaan)
                            <span class="badge bg-primary bg-opacity-10 text-primary mb-3" style="border-radius:999px; width:fit-content; font-size:0.72rem; padding:.35rem .85rem;">
                                <i class="bi bi-briefcase me-1"></i>{{ $item->kategori_pekerjaan }}
                            </span>
                        @endif

                        {{-- Spacer --}}
                        <div class="flex-grow-1"></div>

                        {{-- Footer card --}}
                        <div class="d-flex align-items-center justify-content-between mt-3 pt-3 border-top">
                            <span class="text-muted" style="font-size:0.72rem;">
                                <i class="bi bi-clock me-1"></i>{{ $item->created_at->diffForHumans() }}
                            </span>
                            <a
                                href="{{ route('lowongan.detail', $item->lowongan_id) }}"
                                class="btn btn-primary btn-sm px-3"
                                style="border-radius:8px; font-size:0.8rem;"
                            >
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- PAGINATION --}}
        <div class="d-flex justify-content-center mt-5">
            {{ $lowongan->links('pagination::bootstrap-5') }}
        </div>

    @else
        {{-- Empty state --}}
        <div class="text-center py-5">
            <div class="mb-4">
                <i class="bi bi-search" style="font-size:3.5rem; color:#dee2e6;"></i>
            </div>
            <h5 class="fw-semibold text-muted">Tidak Ada Lowongan Ditemukan</h5>
            <p class="text-muted small mt-2">
                @if(request('search') || request('kategori'))
                    Coba ubah kata kunci atau filter yang kamu gunakan.
                @else
                    Belum ada lowongan tersedia saat ini. Coba lagi nanti.
                @endif
            </p>
            @if(request('search') || request('kategori'))
                <a href="{{ route('karir') }}" class="btn btn-outline-primary mt-2 pill px-4">
                    <i class="bi bi-arrow-left me-2"></i>Lihat Semua Lowongan
                </a>
            @endif
        </div>
    @endif

</section>

{{-- Hover effect --}}
<style>
    .karir-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(13,110,253,.12) !important;
    }
    .input-group .form-control:focus {
        box-shadow: none;
        border-color: #0d6efd;
    }
    .input-group:focus-within {
        outline: 2px solid #0d6efd;
        border-radius: 10px;
    }
    .input-group:focus-within .input-group-text,
    .input-group:focus-within .form-control {
        border-color: #0d6efd;
    }
    @media (max-width: 576px) {
        .col-sm-6 { flex: 0 0 100%; max-width: 100%; }
    }
</style>

@endsection
