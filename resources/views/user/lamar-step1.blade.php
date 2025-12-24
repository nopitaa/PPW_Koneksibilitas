@extends('layouts.user')

@section('navbar') @endsection

@section('content')
<div class="container py-5" style="max-width:700px; margin:auto;">

    <a href="{{ route('home') }}"
       class="text-decoration-none text-dark mb-3 d-inline-flex align-items-center">
        <i class="bi bi-arrow-left me-2"></i> Kembali
    </a>

    <div class="text-center mb-4">
        <h2 class="fw-bold">Lamar Pekerjaan</h2>
        <p class="text-primary fw-semibold mb-1">Step 1</p>
        <p class="text-dark">Data Pribadi</p>
    </div>

    {{-- FORM STEP 1 (WAJIB POST) --}}
<form method="POST"
      action="{{ route('lamar.step1.store', $lowongan->lowongan_id) }}">
    @csrf

        {{-- Nama --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">
                Nama Lengkap (Sesuai KTP) <span class="text-danger">*</span>
            </label>
            <input type="text"
                   class="form-control"
                   name="nama"
                   placeholder="Masukkan nama lengkap"
                   value="{{ old('nama', Auth::user()->nama_depan . ' ' . (Auth::user()->nama_belakang ?? '')) }}"
                   required>
        </div>

        {{-- Jenis Kelamin --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">
                Jenis Kelamin <span class="text-danger">*</span>
            </label>
            <div class="d-flex gap-4 mt-1">
                <div class="form-check">
                    <input class="form-check-input"
                           type="radio"
                           name="gender"
                           value="Laki-laki"
                           {{ old('gender', Auth::user()->jenis_kelamin) == 'Laki-laki' ? 'checked' : '' }}>
                    <label class="form-check-label">Laki-laki</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input"
                           type="radio"
                           name="gender"
                           value="Perempuan"
                           {{ old('gender', Auth::user()->jenis_kelamin) == 'Perempuan' ? 'checked' : '' }}>
                    <label class="form-check-label">Perempuan</label>
                </div>
            </div>
        </div>

        {{-- Nomor HP --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">
                Nomor HP <span class="text-danger">*</span>
            </label>
            <input type="text"
                   class="form-control"
                   name="no_hp"
                   placeholder="Masukkan nomor HP aktif"
                   value="{{ old('no_hp') }}"
                   required>
        </div>

        {{-- Alamat --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">
                Alamat Lengkap <span class="text-danger">*</span>
            </label>
            <textarea class="form-control"
                      name="alamat"
                      rows="2"
                      required>{{ old('alamat') }}</textarea>
        </div>

        {{-- Email --}}
        <div class="mb-4">
            <label class="form-label fw-semibold">
                Email <span class="text-danger">*</span>
            </label>
            <input type="email"
                   class="form-control"
                   name="email"
                   value="{{ old('email', Auth::user()->email) }}"
                   required>
        </div>

        {{-- BUTTON --}}
        <div class="text-center">
            <button type="submit"
                class="btn btn-primary px-5 py-2 rounded-pill fw-semibold">
                Lanjutkan
            </button>
        </div>

    </form>
</div>
@endsection
