@extends('layouts.user')

@section('title', 'Profil Saya - Koneksibilitas')

@section('content')

{{-- Success toast --}}
@if(session('success'))
    <div id="notifBar" class="position-fixed top-0 start-50 translate-middle-x pt-3" style="z-index:1080; pointer-events:none;">
        <div class="alert alert-success d-flex align-items-center gap-2 shadow-sm mb-0 px-4 py-2" role="alert" style="border-radius:999px; font-size:.9rem;">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
    </div>
    @push('body')
    <script>
    (function(){
        const bar = document.getElementById('notifBar');
        if (!bar) return;
        setTimeout(function(){ bar.style.opacity='0'; bar.style.transition='opacity .4s'; }, 1800);
        setTimeout(function(){ if (bar && bar.parentNode) bar.parentNode.removeChild(bar); }, 2300);
    })();
    </script>
    @endpush
@endif

@push('head')
<style>
    /* ── Page wrapper ──────────────────────────────── */
    .profile-page { max-width: 700px; margin: 0 auto; }

    /* ── Profile hero card ─────────────────────────── */
    .profile-hero {
        background: #fff;
        border: 1px solid #edf1f5;
        border-radius: 18px;
        padding: 1.75rem 1.5rem 1.25rem;
        text-align: center;
        margin-bottom: 1.25rem;
    }
    .profile-hero .avatar-wrap {
        display: inline-block;
        margin-bottom: .85rem;
    }
    .profile-hero img.p-avatar {
        width: 96px; height: 96px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid rgba(13,110,253,.12);
        box-shadow: 0 2px 10px rgba(0,0,0,.07);
    }
    .profile-hero h4 { font-size: 1.15rem; font-weight: 700; margin-bottom: .2rem; }
    .profile-hero .actions { margin-top: .9rem; display: flex; gap: .5rem; justify-content: center; }

    /* ── Section card ──────────────────────────────── */
    .profile-section {
        background: #fff;
        border: 1px solid #edf1f5;
        border-radius: 14px;
        padding: 1rem 1.25rem;
        margin-bottom: 1rem;
    }
    .profile-section-header {
        display: flex;
        align-items: center;
        gap: .5rem;
        margin-bottom: .65rem;
        padding-bottom: .55rem;
        border-bottom: 1px solid #f1f4f8;
    }
    .profile-section-header i { font-size: 1rem; color: var(--brand); }
    .profile-section-header h6 { font-size: .9rem; font-weight: 700; margin: 0; }

    /* ── Skill badge ───────────────────────────────── */
    .skill-pill {
        display: inline-block;
        background: rgba(13,110,253,.08);
        color: var(--brand);
        border-radius: 999px;
        padding: .28rem .85rem;
        font-size: .8rem;
        font-weight: 600;
    }

    /* ── Doc row ───────────────────────────────────── */
    .doc-item {
        display: flex;
        align-items: center;
        gap: .75rem;
        padding: .55rem .75rem;
        background: #f8f9fb;
        border-radius: 10px;
        text-decoration: none;
        color: #222;
        transition: background .15s;
    }
    .doc-item:hover { background: #eef3ff; }
    .doc-item .doc-icon { font-size: 1.25rem; color: var(--brand); flex-shrink: 0; }
    .doc-item .doc-info { flex: 1; min-width: 0; }
    .doc-item .doc-info strong { font-size: .85rem; display: block; }
    .doc-item .doc-info small { font-size: .75rem; color: #6c757d; }
    .doc-item .doc-arrow { color: #adb5bd; font-size: .85rem; }

    /* ── Empty state ───────────────────────────────── */
    .empty-state { padding: .5rem 0; color: #adb5bd; font-size: .85rem; }

    /* ── Danger zone (logout) ──────────────────────── */
    .danger-zone {
        text-align: right;
        margin-top: .25rem;
    }
</style>
@endpush

<div class="profile-page">

    {{-- ── HERO: avatar + nama + aksi ── --}}
    <div class="profile-hero">
        @php
            $avatarUrl = $profile->avatar_path
                ? asset('storage/'.$profile->avatar_path)
                : 'https://cdn-icons-png.flaticon.com/512/847/847969.png';
        @endphp

        <div class="avatar-wrap">
            <img src="{{ $avatarUrl }}" class="p-avatar" alt="Foto Profil">
        </div>

        <h4>{{ $profile->name ?? 'Profil Anda' }}</h4>

        @if(!empty($profile->about))
            <p class="text-muted mb-0" style="font-size:.85rem; line-height:1.5;">
                {{ Str::limit($profile->about, 100) }}
            </p>
        @endif

        <div class="actions">
            <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm rounded-pill px-4 fw-semibold">
                <i class="bi bi-pencil me-1"></i>Edit Profil
            </a>
        </div>
    </div>

    {{-- ── Tentang Saya ── --}}
    <div class="profile-section">
        <div class="profile-section-header">
            <i class="bi bi-person-lines-fill"></i>
            <h6>Tentang Saya</h6>
        </div>
        @if(!empty($profile->about))
            <p class="mb-0" style="font-size:.88rem; line-height:1.65; color:#333;">{{ $profile->about }}</p>
        @else
            <p class="empty-state mb-0"><i class="bi bi-dash me-1"></i>Belum ada informasi yang ditambahkan.</p>
        @endif
    </div>

    {{-- ── Keterampilan ── --}}
    <div class="profile-section">
        <div class="profile-section-header">
            <i class="bi bi-lightning-charge-fill"></i>
            <h6>Keterampilan</h6>
        </div>
        @if(!empty($profile->skills) && count($profile->skills))
            <div class="d-flex flex-wrap gap-2">
                @foreach($profile->skills as $skill)
                    <span class="skill-pill">{{ $skill }}</span>
                @endforeach
            </div>
        @else
            <p class="empty-state mb-0"><i class="bi bi-dash me-1"></i>Belum ada keterampilan.</p>
        @endif
    </div>

    {{-- ── Dokumen ── --}}
    <div class="profile-section">
        <div class="profile-section-header">
            <i class="bi bi-folder2-open"></i>
            <h6>Dokumen</h6>
        </div>
        @if(!$profile->cv_path && !$profile->resume_path && !$profile->portfolio_path)
            <p class="empty-state mb-0"><i class="bi bi-dash me-1"></i>Belum ada dokumen yang diunggah.</p>
        @else
            <div class="d-flex flex-column gap-2">
                @if($profile->cv_path)
                    <a href="{{ asset('storage/'.$profile->cv_path) }}" target="_blank" class="doc-item">
                        <i class="bi bi-file-earmark-person doc-icon"></i>
                        <div class="doc-info">
                            <strong>CV</strong>
                            <small>Daftar riwayat hidup terbaru</small>
                        </div>
                        <i class="bi bi-box-arrow-up-right doc-arrow"></i>
                    </a>
                @endif
                @if($profile->resume_path)
                    <a href="{{ asset('storage/'.$profile->resume_path) }}" target="_blank" class="doc-item">
                        <i class="bi bi-file-earmark-text doc-icon"></i>
                        <div class="doc-info">
                            <strong>Resume</strong>
                            <small>Ringkasan 1 halaman untuk lamaran kerja</small>
                        </div>
                        <i class="bi bi-box-arrow-up-right doc-arrow"></i>
                    </a>
                @endif
                @if($profile->portfolio_path)
                    <a href="{{ asset('storage/'.$profile->portfolio_path) }}" target="_blank" class="doc-item">
                        <i class="bi bi-folder2 doc-icon"></i>
                        <div class="doc-info">
                            <strong>Portofolio</strong>
                            <small>Kumpulan karya &amp; studi kasus</small>
                        </div>
                        <i class="bi bi-box-arrow-up-right doc-arrow"></i>
                    </a>
                @endif
            </div>
        @endif
    </div>

    {{-- ── Danger zone: logout ── --}}
    <div class="danger-zone">
        <button type="button" class="btn btn-outline-danger btn-sm rounded-pill px-3"
                data-bs-toggle="modal" data-bs-target="#logoutModal">
            <i class="bi bi-box-arrow-right me-1"></i>Logout
        </button>
        <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
    </div>

</div>

{{-- Logout Modal --}}
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content" style="border-radius:16px; overflow:hidden;">
            <div class="modal-body text-center pt-4 pb-3 px-4">
                <div class="mb-3">
                    <i class="bi bi-box-arrow-right" style="font-size:2rem; color:#dc3545;"></i>
                </div>
                <h6 class="fw-bold mb-1">Konfirmasi Logout</h6>
                <p class="text-muted mb-0" style="font-size:.85rem;">Apakah Anda yakin ingin keluar?</p>
            </div>
            <div class="modal-footer border-0 justify-content-center gap-2 pt-0 pb-3">
                <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                <button type="button" id="confirmLogout" class="btn btn-sm btn-danger rounded-pill px-4">Logout</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('body')
<script>
document.addEventListener('DOMContentLoaded', function(){
    const btn = document.getElementById('confirmLogout');
    if (btn) btn.addEventListener('click', function(){
        document.getElementById('logoutForm').submit();
    });
});
</script>
@endpush
