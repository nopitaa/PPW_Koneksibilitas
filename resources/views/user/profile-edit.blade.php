@extends('layouts.user')

@section('content')
<div class="container py-5" style="max-width:780px; margin:auto;">

    {{-- Back link --}}
    <a href="{{ route('profile.show') }}"
       class="text-decoration-none mb-3 d-inline-flex align-items-center">
        <i class="bi bi-arrow-left me-2"></i> Kembali ke Profil
    </a>

    <h3 class="fw-bold mb-4">Edit Profil</h3>

    {{-- Error messages --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <div class="fw-semibold mb-1">Periksa kembali isian berikut:</div>
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Nama --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Nama Lengkap</label>
            <input
                type="text"
                name="name"
                class="form-control"
                value="{{ old('name', $profile->name) }}"
                placeholder="Masukkan nama lengkap"
            >
        </div>

        {{-- Tentang Saya --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Tentang Saya</label>
            <textarea
                name="about"
                rows="4"
                class="form-control"
                placeholder="Ceritakan secara singkat tentang diri Anda..."
            >{{ old('about', $profile->about) }}</textarea>
        </div>

        {{-- Keterampilan --}}
        <div class="mb-4">
            <label class="form-label fw-semibold">Keterampilan</label>
            <input
                type="text"
                name="skills"
                class="form-control"
                value="{{ old('skills', $profile->skills ? implode(', ', $profile->skills) : '') }}"
                placeholder="Contoh: Web Development, Mobile Development, UI/UX Designer"
            >
            <small class="text-muted">Pisahkan dengan koma ( , )</small>
        </div>

        <hr>

        {{-- Avatar --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Foto Profil</label>
            <div class="d-flex align-items-center gap-3 mb-2">
                @php
                    $avatarUrl = $profile->avatar_path
                        ? asset('storage/'.$profile->avatar_path)
                        : 'https://cdn-icons-png.flaticon.com/512/847/847969.png';
                @endphp

                <img
                    src="{{ $avatarUrl }}"
                    alt="Avatar"
                    style="width:64px;height:64px;border-radius:50%;object-fit:cover;"
                >

                <input
                    type="file"
                    name="avatar"
                    class="form-control"
                    accept="image/*"
                >
            </div>
            <small class="text-muted">Maksimal 2MB, format JPG/PNG.</small>
        </div>

        {{-- CV --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">CV</label>
            <input
                type="file"
                name="cv"
                class="form-control"
                accept=".pdf,.doc,.docx"
            >
            @if($profile->cv_path)
                <small class="d-block mt-1">
                    File sekarang:
                    <a href="{{ route('profile.view', 'cv') }}" target="_blank">Lihat CV</a>
                </small>
            @endif
        </div>

        {{-- Resume --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Resume</label>
            <input
                type="file"
                name="resume"
                class="form-control"
                accept=".pdf,.doc,.docx"
            >
            @if($profile->resume_path)
                <small class="d-block mt-1">
                    File sekarang:
                    <a href="{{ route('profile.view', 'resume') }}" target="_blank">Lihat Resume</a>
                </small>
            @endif
        </div>

        {{-- Portofolio --}}
        <div class="mb-4">
            <label class="form-label fw-semibold">Portofolio</label>
            <input
                type="file"
                name="portfolio"
                class="form-control"
                accept=".pdf,.doc,.docx,.zip"
            >
            @if($profile->portfolio_path)
                <small class="d-block mt-1">
                    File sekarang:
                    <a href="{{ route('profile.view', 'portfolio') }}" target="_blank">Lihat Portofolio</a>
                </small>
            @endif
        </div>

        {{-- Submit --}}
        <div class="text-end">
            <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill fw-semibold">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
