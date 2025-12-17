@extends('layouts.user')

@section('navbar') @endsection

@section('content')
<div class="container py-5" style="max-width:760px; margin:auto;">

    {{-- Tombol kembali --}}
    <a href="{{ route('lamar.step2', ['lowongan' => $lowongan]) }}"
       class="text-decoration-none text-dark mb-3 d-inline-flex align-items-center">
        <i class="bi bi-arrow-left me-2"></i> Kembali
    </a>

    <div class="text-center mb-4">
        <h2 class="fw-bold">Lamar Pekerjaan</h2>
        <p class="text-primary fw-semibold mb-1">Step 3</p>
        <p class="text-dark">Informasi Lain</p>
    </div>

    {{-- Error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <div class="fw-semibold mb-1">Periksa kembali input kamu:</div>
            <ul class="mb-0">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM --}}
    <form action="{{ route('lamar.submit', ['lowongan' => $lowongan->lowongan_id]) }}"
          method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Jenis Disabilitas --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">
                Jenis Disabilitas <span class="text-danger">*</span>
            </label>
            <div class="d-flex gap-4">
                <div class="form-check">
                    <input class="form-check-input" type="radio"
                           name="jenis_disabilitas"
                           value="tuna_rungu_wicara" checked>
                    <label class="form-check-label">
                        Tuna Rungu / Tuna Wicara
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio"
                           name="jenis_disabilitas"
                           value="lainnya">
                    <label class="form-check-label">Lainnya</label>
                </div>
            </div>
        </div>

        {{-- Alat Bantu --}}
        <div class="mb-4">
            <label class="form-label fw-semibold">Alat Bantu</label>
            <input type="text" class="form-control"
                   name="alat_bantu"
                   placeholder="Contoh: Alat bantu dengar">
        </div>

        {{-- CV --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">
                CV
                @if(!$profile || !$profile->cv_path)
                    <span class="text-danger">*</span>
                @endif
            </label>

            @if($profile && $profile->cv_path)
                <div class="alert alert-info py-2">
                    Menggunakan CV dari profil:
                    <a href="{{ route('profile.view', 'cv') }}" target="_blank">
                        {{ basename($profile->cv_path) }}
                    </a>
                    <div class="small text-muted">
                        Upload ulang jika ingin mengganti
                    </div>
                </div>
            @endif

            <input type="file"
                   name="cv"
                   class="form-control"
                   accept=".pdf,.doc,.docx">
        </div>

        {{-- Portofolio --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Portofolio</label>

            @if($profile && $profile->portfolio_path)
                <div class="alert alert-info py-2">
                    Portofolio dari profil:
                    <a href="{{ route('profile.view', 'portfolio') }}" target="_blank">
                        {{ basename($profile->portfolio_path) }}
                    </a>
                </div>
            @endif

            <input type="file"
                   name="portofolio"
                   class="form-control"
                   accept=".pdf,.doc,.docx,.zip">
        </div>

        {{-- Dokumen Tambahan --}}
        <div class="mb-4">
            <label class="form-label fw-semibold">Dokumen Tambahan</label>
            <input type="file"
                   name="dokumen_tambahan[]"
                   class="form-control"
                   multiple
                   accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.zip">
        </div>

        {{-- Submit --}}
        <div class="text-center">
            <button type="submit"
                    class="btn btn-primary px-5 py-2 rounded-pill fw-semibold">
                Kirim Lamaran
            </button>
        </div>
    </form>
</div>
@endsection

@push('body')
    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            text: '{{ session('success') }}',
            confirmButtonText: 'OK'
        });
    </script>
    @endif
@endpush
