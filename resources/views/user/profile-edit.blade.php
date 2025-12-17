@extends('layouts.user')

@section('content')
<div class="container py-5" style="max-width:780px; margin:auto;">

        <div class="d-flex align-items-center justify-content-between mb-3">
        <h3 class="fw-bold mb-0">Edit Profil</h3>
        <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary btn-sm d-inline-flex align-items-center">
            Kembali ke Profil <i class="bi bi-arrow-right ms-2"></i>
        </a>
    </div>

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
                {{-- Redesigned two-column card layout --}}
                @push('head')
                <style>
                    .profile-card { border-radius:18px; border:1px solid #eef2f6; background:#fff; }
                    .profile-left { text-align:center; padding:1.25rem; border-right:1px solid #f1f4f8; }
                    .profile-right { padding:1.25rem; }
                    .avatar-lg { width:120px; height:120px; border-radius:50%; object-fit:cover; border:4px solid rgba(13,110,253,0.08); }
                    /* Skill pills */
                    .skill-btn {
                        padding: .35rem .9rem;
                        font-size: .85rem;
                        border-radius: 999px;
                        cursor: pointer;
                        transition: all .12s ease-in-out;
                        display: inline-flex;
                        align-items: center;
                        gap: .35rem;
                        border-width: 1.25px;
                    }
                    .skill-btn.btn-checked,
                    .skill-btn.active {
                        background: var(--brand);
                        color: #fff !important;
                        border-color: var(--brand) !important;
                        box-shadow: 0 2px 6px rgba(13,110,253,0.15);
                    }
                    .skill-btn:hover { transform: translateY(-1px); }
                    .file-note { font-size:0.85rem; color:#6c757d; }
                </style>
                @endpush

                <div class="card profile-card mb-4">
                    <div class="row g-0">
                        <div class="col-md-4 profile-left d-flex flex-column align-items-center justify-content-center">
                            @php
                                    $avatarUrl = $profile->avatar_path
                                            ? asset('storage/'.$profile->avatar_path)
                                            : 'https://cdn-icons-png.flaticon.com/512/847/847969.png';
                            @endphp

                            <img src="{{ $avatarUrl }}" id="avatarPreview" class="avatar-lg mb-3" alt="Avatar preview">

                            <div class="w-100 px-3">
                                <label class="form-label fw-semibold small">Upload Foto</label>
                                <input type="file" name="avatar" class="form-control form-control-sm" accept="image/*">
                                <div class="file-note mt-2">Ukuran maksimal 2MB. Format JPG/PNG.</div>
                            </div>

                            <div class="w-100 mt-3 px-3">
                                <label class="form-label fw-semibold small">Nama</label>
                                <input type="text" name="name" class="form-control form-control-sm text-center" value="{{ old('name', $profile->name ?? (Auth::check() ? trim(Auth::user()->nama_depan . ' ' . (Auth::user()->nama_belakang ?? '')) : '')) }}" placeholder="Nama lengkap">
                            </div>
                        </div>

                        <div class="col-md-8 profile-right">
                            {{-- Tentang Saya --}}
                            <div class="mb-3">
                                    <label class="form-label fw-semibold">Tentang Saya</label>
                                    <textarea name="about" rows="5" class="form-control" placeholder="Ceritakan secara singkat tentang diri Anda...">{{ old('about', $profile->about) }}</textarea>
                            </div>

                            {{-- Keterampilan --}}
                            <div class="mb-4">
                                    <label class="form-label fw-semibold">Keterampilan</label>
                                    @php
                                            $selectedSkills = old('skills', $profile->skills ?? []);
                                            if (!is_array($selectedSkills)) {
                                                    $selectedSkills = array_filter(array_map('trim', explode(',', $selectedSkills)));
                                            }
                                    @endphp

                                        @if(isset($allSkills) && $allSkills->count())
                                            <div class="d-flex flex-wrap gap-2">
                                                    @foreach($allSkills as $skill)
                                                            <input type="checkbox" class="btn-check" name="skills[]" value="{{ $skill->nama_keterampilan }}" id="skill-{{ $skill->keterampilan_id }}" autocomplete="off" {{ in_array($skill->nama_keterampilan, (array) $selectedSkills) ? 'checked' : '' }}>
                                                            <label class="btn btn-outline-primary rounded-pill btn-sm skill-btn" for="skill-{{ $skill->keterampilan_id }}">{{ $skill->nama_keterampilan }}</label>
                                                    @endforeach
                                            </div>
                                            <small class="text-muted d-block mt-2">Pilih satu atau beberapa keterampilan.</small>
                                        @else
                                            <div class="alert alert-info p-2">Belum ada daftar keterampilan. Hubungi admin untuk menambahkan pilihan keterampilan.</div>
                                        @endif
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">CV</label>
                                    <input type="file" name="cv" class="form-control" accept=".pdf,.doc,.docx">
                                    @if($profile->cv_path)
                                            <small class="d-block mt-1 file-note">File sekarang: <a href="{{ route('profile.view', 'cv') }}" target="_blank">Lihat CV</a></small>
                                    @endif
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Resume</label>
                                    <input type="file" name="resume" class="form-control" accept=".pdf,.doc,.docx">
                                    @if($profile->resume_path)
                                            <small class="d-block mt-1 file-note">File sekarang: <a href="{{ route('profile.view', 'resume') }}" target="_blank">Lihat Resume</a></small>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Portofolio</label>
                                <input type="file" name="portfolio" class="form-control" accept=".pdf,.doc,.docx,.zip">
                                @if($profile->portfolio_path)
                                        <small class="d-block mt-1 file-note">File sekarang: <a href="{{ route('profile.view', 'portfolio') }}" target="_blank">Lihat Portofolio</a></small>
                                @endif
                            </div>

                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill fw-semibold">Simpan Perubahan</button>
                            </div>
                        </div>
                    </div>
                </div>

        {{-- (Form fields included in redesigned card above) --}}
    </form>
</div>

@push('body')
<script>
    (function(){
        const input = document.querySelector('input[name="avatar"]');
        const img = document.getElementById('avatarPreview');
        if (!input || !img) return;

        input.addEventListener('change', function(e){
            const file = this.files && this.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(ev){
                img.src = ev.target.result;
            };
            reader.readAsDataURL(file);
        });
    })();
</script>
<script>
    // sync btn-check state with label visual active class
    (function(){
        const checks = document.querySelectorAll('.btn-check');
        if (!checks.length) return;
        checks.forEach(ch => {
            const lbl = document.querySelector('label[for="'+ch.id+'"]');
            const sync = () => {
                if (!lbl) return;
                if (ch.checked) {
                    lbl.classList.add('btn-checked', 'active');
                } else {
                    lbl.classList.remove('btn-checked', 'active');
                }
            };
            // init
            sync();
            ch.addEventListener('change', sync);
        });
    })();
</script>
@endpush
@endsection
