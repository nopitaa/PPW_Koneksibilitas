@extends('layouts.user')

@section('navbar') @endsection

@section('content')
<div class="container py-5" style="max-width:700px; margin:auto;">
    <a href="{{ route('home') }}" class="text-decoration-none text-dark mb-3 d-inline-flex align-items-center">
        <i class="bi bi-arrow-left me-2"></i> Kembali
    </a>

    <div class="text-center mb-4">
        <h2 class="fw-bold">Lamar Pekerjaan</h2>
        <p class="text-primary fw-semibold mb-1">Step 1</p>
        <p class="text-dark">Data Pribadi</p>
    </div>

    <form action="#" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-semibold">Nama Lengkap (Sesuai KTP) <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="nama" placeholder="Masukkan nama lengkap" value="Ruby Chan" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Jenis Kelamin <span class="text-danger">*</span></label>
            <div class="d-flex gap-4 mt-1">
                <div>
                    <input class="form-check-input" type="radio" name="gender" id="laki" value="Laki-laki">
                    <label class="form-check-label" for="laki">Laki-laki</label>
                </div>
                <div>
                    <input class="form-check-input" type="radio" name="gender" id="perempuan" value="Perempuan" checked>
                    <label class="form-check-label" for="perempuan">Perempuan</label>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Nomor Hp <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="no_hp" placeholder="Masukkan nomor HP aktif" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Alamat Lengkap <span class="text-danger">*</span></label>
            <textarea class="form-control" name="alamat" rows="2" required>Jl. Pandjaitan No. 111, Kec. Purwokerto, Kab. Banyumas</textarea>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control" name="email" placeholder="Masukkan email aktif" required>
        </div>
         <div class="text-center">
            <button type="button"
        class="btn btn-primary px-5 py-2 rounded-pill fw-semibold"
        onclick="window.location.href='{{ route('lamar.step2') }}'">Lanjutkan</button>
        </div>
    </form>
</div>
@endsection
