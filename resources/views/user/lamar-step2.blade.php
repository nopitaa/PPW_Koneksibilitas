@extends('layouts.user')

@section('navbar') @endsection
@section('content')
<div class="container py-5" style="max-width:700px; margin:auto;">
    <a href="{{ route('lamar.step1') }}" class="text-decoration-none text-dark mb-3 d-inline-flex align-items-center">
        <i class="bi bi-arrow-left me-2"></i> Kembali
    </a>

    <div class="text-center mb-4">
        <h2 class="fw-bold">Lamar Pekerjaan</h2>
        <p class="text-primary fw-semibold mb-1">Step 2</p>
        <p class="text-dark">Riwayat Pendidikan</p>
    </div>

    <form action="#" method="POST" novalidate>
        @csrf

        <div class="mb-3">
            <label class="form-label fw-semibold">Pendidikan Terakhir <span class="text-danger">*</span></label>
            <select name="pendidikan_terakhir" class="form-select" required>
                <option value="" selected disabled>Pilih Pendidikan</option>
                <option>SD</option>
                <option>SMP</option>
                <option>SMA/SMK</option>
                <option>Diploma (D1/D2/D3)</option>
                <option>Sarjana (S1)</option>
                <option>Magister (S2)</option>
                <option>Doktor (S3)</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Nama Institusi Pendidikan Terakhir <span class="text-danger">*</span></label>
            <input type="text" name="institusi" class="form-control" placeholder="Masukkan nama institusi" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Jurusan <span class="text-danger">*</span></label>
            <input type="text" name="jurusan" class="form-control" placeholder="Masukkan jurusan" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Tahun Mulai <span class="text-danger">*</span></label>
            <input type="number" name="tahun_mulai" class="form-control" placeholder="cth: 2019"
                   min="1970" max="{{ now()->year }}" required>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">Tahun Berakhir <span class="text-danger">*</span></label>
            <input type="number" name="tahun_berakhir" class="form-control" placeholder="cth: {{ now()->year }}"
                   min="1970" max="{{ now()->year + 5 }}" required>
        </div>

        <div class="text-center">
            <button type="button"
                    onclick="window.location.href='{{ route('lamar.step3') ?? '#' }}'"
                    class="btn btn-primary px-5 py-2 rounded-pill fw-semibold">
                Lanjutkan
            </button>
        </div>
    </form>
</div>
@endsection
