@extends('layouts.user')

@section('title', 'Edit Profil - Koneksibilitas')

@section('content')
<div class="profile-page" style="max-width:700px; margin:0 auto;">

    <div class="d-flex align-items-center justify-content-between mb-3">
        <h5 class="fw-bold mb-0">Edit Profil</h5>
        <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary btn-sm rounded-pill d-inline-flex align-items-center px-3">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    {{-- Error messages dari form update --}}
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

    {{-- Toast Notification --}}
    <div id="uploadToast" class="position-fixed top-0 start-50 translate-middle-x mt-3" style="z-index:1090; min-width:300px; display:none;">
        <div id="toastInner" class="alert d-flex align-items-center gap-2 shadow mb-0" role="alert">
            <i id="toastIcon" class="bi fs-5"></i>
            <span id="toastMsg"></span>
        </div>
    </div>

    @push('head')
    <style>
        .profile-card { border-radius:16px; border:1px solid #edf1f5; background:#fff; }
        .profile-left {
            text-align:center;
            padding:1.25rem 1rem;
            border-right:1px solid #f1f4f8;
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:flex-start;
            gap:.75rem;
        }
        .profile-right { padding:1.25rem 1.25rem 1rem; }
        .avatar-lg { width:96px; height:96px; border-radius:50%; object-fit:cover; border:3px solid rgba(13,110,253,.10); box-shadow:0 2px 8px rgba(0,0,0,.07); }

        /* Section labels inside edit form */
        .form-section-label {
            font-size:.7rem;
            font-weight:700;
            text-transform:uppercase;
            letter-spacing:.06em;
            color:#adb5bd;
            margin-bottom:.4rem;
            padding-bottom:.35rem;
            border-bottom:1px solid #f1f4f8;
            display:block;
        }

        /* Avatar upload zone */
        .avatar-upload-zone {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }
        .avatar-overlay {
            position: absolute;
            inset: 0;
            border-radius: 50%;
            background: rgba(13,110,253,0.65);
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity .2s;
            font-size: 0.75rem;
            font-weight: 600;
            gap: 3px;
        }
        .avatar-upload-zone:hover .avatar-overlay { opacity: 1; }
        .avatar-overlay i { font-size: 1.4rem; }

        /* Drag-over state */
        .avatar-upload-zone.drag-over .avatar-overlay { opacity: 1; background: rgba(13,110,253,0.80); }

        /* Loading spinner overlay */
        .avatar-spinner {
            position: absolute;
            inset: 0;
            border-radius: 50%;
            background: rgba(255,255,255,0.85);
            display: none;
            align-items: center;
            justify-content: center;
        }
        .avatar-spinner.show { display: flex; }

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
        .skill-btn.btn-checked, .skill-btn.active {
            background: var(--brand);
            color: #fff !important;
            border-color: var(--brand) !important;
            box-shadow: 0 2px 6px rgba(13,110,253,0.15);
        }
        .skill-btn:hover { transform: translateY(-1px); }
        .file-note { font-size:0.85rem; color:#6c757d; }

        /* File input button styling */
        .btn-upload-hidden { display:none; }
        .upload-status-text { font-size: 0.78rem; margin-top: 6px; min-height: 18px; }
    </style>
    @endpush

    {{-- FORM UPDATE PROFIL (teks, keterampilan, dokumen) --}}
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" id="profileForm">
        @csrf

        <div class="card profile-card mb-3">
            <div class="row g-0">

                {{-- ========== KOLOM KIRI: AVATAR + NAMA ========== --}}
                <div class="col-md-4 profile-left">

                    @php
                        $avatarUrl = $profile->avatar_path
                            ? asset('storage/'.$profile->avatar_path)
                            : 'https://cdn-icons-png.flaticon.com/512/847/847969.png';
                    @endphp

                    {{-- Avatar click-to-upload zone --}}
                    <div class="avatar-upload-zone mb-3" id="avatarZone" title="Klik untuk upload foto">
                        <img src="{{ $avatarUrl }}" id="avatarPreview" class="avatar-lg" alt="Foto Profil">
                        <div class="avatar-overlay" id="avatarOverlay">
                            <i class="bi bi-camera"></i>
                            Ganti Foto
                        </div>
                        <div class="avatar-spinner" id="avatarSpinner">
                            <div class="spinner-border spinner-border-sm text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>

                    {{-- Hidden file input (AJAX) --}}
                    <input type="file" id="avatarFileInput" class="btn-upload-hidden"
                           accept="image/jpeg,image/jpg,image/png">

                    <div id="uploadStatusText" class="upload-status-text text-muted text-center"></div>
                    <div class="file-note">Maks 2MB · JPG / PNG</div>

                    {{-- Nama --}}
                    <div class="w-100">
                        <label class="form-label small fw-semibold mb-1" style="font-size:.78rem;">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control form-control-sm text-center"
                               value="{{ old('name', $profile->name) }}" placeholder="Nama lengkap">
                    </div>
                </div>

                {{-- ========== KOLOM KANAN: PROFIL ========== --}}
                <div class="col-md-8 profile-right">

                    {{-- Tentang Saya --}}
                    <div class="mb-3">
                        <label class="form-section-label"><i class="bi bi-person-lines-fill me-1"></i>Tentang Saya</label>
                        <textarea name="about" rows="4" class="form-control form-control-sm"
                                  placeholder="Ceritakan secara singkat tentang diri Anda...">{{ old('about', $profile->about) }}</textarea>
                    </div>

                    {{-- Keterampilan --}}
                    <div class="mb-3">
                        <label class="form-section-label"><i class="bi bi-lightning-charge-fill me-1"></i>Keterampilan</label>
                        @php
                            $selectedSkills = old('skills', $profile->skills ?? []);
                            if (!is_array($selectedSkills)) {
                                $selectedSkills = array_filter(array_map('trim', explode(',', $selectedSkills)));
                            }
                        @endphp

                        @if(isset($allSkills) && $allSkills->count())
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($allSkills as $skill)
                                    <input type="checkbox" class="btn-check" name="skills[]"
                                           value="{{ $skill->nama_keterampilan }}"
                                           id="skill-{{ $skill->keterampilan_id }}"
                                           autocomplete="off"
                                           {{ in_array($skill->nama_keterampilan, (array) $selectedSkills) ? 'checked' : '' }}>
                                    <label class="btn btn-outline-primary rounded-pill btn-sm skill-btn"
                                           for="skill-{{ $skill->keterampilan_id }}">{{ $skill->nama_keterampilan }}</label>
                                @endforeach
                            </div>
                            <small class="text-muted d-block mt-2">Pilih satu atau beberapa keterampilan.</small>
                        @else
                            <div class="alert alert-info p-2">Belum ada daftar keterampilan.</div>
                        @endif
                    </div>

                    {{-- Dokumen --}}
                    <label class="form-section-label"><i class="bi bi-folder2-open me-1"></i>Dokumen</label>
                    <div class="row g-2 mb-2">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold mb-1">CV</label>
                            <input type="file" name="cv" class="form-control form-control-sm" accept=".pdf,.doc,.docx">
                            @if($profile->cv_path)
                                <small class="d-block mt-1 file-note"><a href="{{ route('profile.view', 'cv') }}" target="_blank"><i class="bi bi-eye me-1"></i>Lihat file</a></small>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold mb-1">Resume</label>
                            <input type="file" name="resume" class="form-control form-control-sm" accept=".pdf,.doc,.docx">
                            @if($profile->resume_path)
                                <small class="d-block mt-1 file-note"><a href="{{ route('profile.view', 'resume') }}" target="_blank"><i class="bi bi-eye me-1"></i>Lihat file</a></small>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold mb-1">Portofolio</label>
                        <input type="file" name="portfolio" class="form-control form-control-sm" accept=".pdf,.doc,.docx,.zip">
                        @if($profile->portfolio_path)
                            <small class="d-block mt-1 file-note"><a href="{{ route('profile.view', 'portfolio') }}" target="_blank"><i class="bi bi-eye me-1"></i>Lihat file</a></small>
                        @endif
                    </div>

                    <div class="d-flex justify-content-end mt-2 pt-2 border-top">
                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill fw-semibold" id="submitBtn">
                            <span class="submit-label">Simpan Perubahan</span>
                            <span class="submit-spinner d-none">
                                <span class="spinner-border spinner-border-sm me-1" role="status"></span>Menyimpan...
                            </span>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </form>

</div>
{{-- responsive: on mobile, left column has no border-right --}}
<style>
@media (max-width: 767px) {
    .profile-left { border-right: none !important; border-bottom: 1px solid #f1f4f8; padding-bottom: 1rem; }
    .profile-right { padding-top: 1rem; }
    .profile-page { padding: 0 .25rem; }
}
</style>

@push('body')
<script>
(function () {
    // ── CSRF Token ──────────────────────────────────────────────────
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content
                   || '{{ csrf_token() }}';

    // ── Element refs ────────────────────────────────────────────────
    const zone       = document.getElementById('avatarZone');
    const fileInput  = document.getElementById('avatarFileInput');
    const preview    = document.getElementById('avatarPreview');
    const spinner    = document.getElementById('avatarSpinner');
    const statusText = document.getElementById('uploadStatusText');
    const toast      = document.getElementById('uploadToast');
    const toastInner = document.getElementById('toastInner');
    const toastMsg   = document.getElementById('toastMsg');
    const toastIcon  = document.getElementById('toastIcon');

    // ── Toast helper ─────────────────────────────────────────────────
    function showToast(type, msg) {
        toastInner.className = 'alert d-flex align-items-center gap-2 shadow mb-0 alert-' + type;
        toastIcon.className  = 'bi fs-5 ' + (type === 'success' ? 'bi-check-circle-fill text-success' : 'bi-exclamation-triangle-fill text-danger');
        toastMsg.textContent = msg;
        toast.style.display  = 'block';
        clearTimeout(toast._timer);
        toast._timer = setTimeout(() => { toast.style.display = 'none'; }, 4000);
    }

    // ── Set loading state ─────────────────────────────────────────────
    function setLoading(on) {
        spinner.classList.toggle('show', on);
        zone.style.pointerEvents = on ? 'none' : '';
        statusText.textContent   = on ? 'Mengunggah...' : '';
    }

    // ── Validate file client-side ─────────────────────────────────────
    function validateFile(file) {
        const allowed = ['image/jpeg', 'image/jpg', 'image/png'];
        if (!allowed.includes(file.type)) {
            return 'Format tidak didukung. Gunakan JPG atau PNG.';
        }
        if (file.size > 2 * 1024 * 1024) {
            return 'Ukuran file melebihi 2MB.';
        }
        return null;
    }

    // ── Upload via AJAX ───────────────────────────────────────────────
    function uploadAvatar(file) {
        const error = validateFile(file);
        if (error) {
            showToast('danger', error);
            return;
        }

        // Show preview immediately
        const reader = new FileReader();
        reader.onload = (ev) => { preview.src = ev.target.result; };
        reader.readAsDataURL(file);

        setLoading(true);

        const fd = new FormData();
        fd.append('avatar', file);
        fd.append('_token', csrfToken);

        fetch('{{ route("profile.avatar.upload") }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
            body: fd,
        })
        .then(async (res) => {
            const json = await res.json();
            setLoading(false);
            if (res.ok && json.success) {
                // Update all avatar images on this page
                preview.src = json.avatar_url + '?t=' + Date.now();
                document.querySelectorAll('.avatar-lg, img.avatar').forEach(img => {
                    img.src = json.avatar_url + '?t=' + Date.now();
                });
                showToast('success', json.message || 'Foto profil berhasil diperbarui.');
                statusText.textContent = '';
            } else {
                const msg = json.message || json.errors?.avatar?.[0] || 'Upload gagal, coba lagi.';
                showToast('danger', msg);
                statusText.innerHTML = '<span class="text-danger"><i class="bi bi-exclamation-circle me-1"></i>' + msg + '</span>';
            }
        })
        .catch(() => {
            setLoading(false);
            showToast('danger', 'Terjadi kesalahan jaringan. Silakan coba lagi.');
            statusText.innerHTML = '<span class="text-danger">Gagal terhubung ke server.</span>';
        });
    }

    // ── Click to pick file ────────────────────────────────────────────
    zone.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', function () {
        if (this.files && this.files[0]) uploadAvatar(this.files[0]);
        this.value = ''; // reset so same file can be re-uploaded
    });

    // ── Drag & Drop ───────────────────────────────────────────────────
    zone.addEventListener('dragover',  (e) => { e.preventDefault(); zone.classList.add('drag-over'); });
    zone.addEventListener('dragleave', ()  => { zone.classList.remove('drag-over'); });
    zone.addEventListener('drop',      (e) => {
        e.preventDefault();
        zone.classList.remove('drag-over');
        const file = e.dataTransfer.files?.[0];
        if (file) uploadAvatar(file);
    });

    // ── Skill checkbox sync ────────────────────────────────────────────
    document.querySelectorAll('.btn-check').forEach(ch => {
        const lbl = document.querySelector('label[for="' + ch.id + '"]');
        const sync = () => {
            if (!lbl) return;
            lbl.classList.toggle('btn-checked', ch.checked);
            lbl.classList.toggle('active', ch.checked);
        };
        sync();
        ch.addEventListener('change', sync);
    });

    // ── Form submit loading spinner ────────────────────────────────────
    document.getElementById('profileForm').addEventListener('submit', function () {
        const btn = document.getElementById('submitBtn');
        btn.querySelector('.submit-label').classList.add('d-none');
        btn.querySelector('.submit-spinner').classList.remove('d-none');
        btn.disabled = true;
    });

})();
</script>
@endpush
@endsection

