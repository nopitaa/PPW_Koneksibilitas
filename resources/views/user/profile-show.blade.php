@extends('layouts.user')

{{-- kalau mau halaman ini tanpa navbar, aktifkan ini --}}
{{-- @section('navbar') @endsection --}}

@section('content')
<div class="container py-5" style="max-width:780px; margin:auto;">

    @if(session('success'))
        <div id="notifBar" class="position-fixed top-0 start-50 translate-middle-x p-3" style="z-index:1080;">
            <div class="alert alert-success fade show mb-0" role="alert">
                {{ session('success') }}
            </div>
        </div>

        @push('body')
        <script>
        (function(){
            const bar = document.getElementById('notifBar');
            if (!bar) return;
            // auto-dismiss after 1.5 seconds
            setTimeout(function(){
                if (bar && bar.parentNode) bar.parentNode.removeChild(bar);
            }, 1500);
        })();
        </script>
        @endpush
    @endif

    <div class="text-center mb-4">
        {{-- avatar default kalau belum ada --}}
        @php
            $avatarUrl = $profile->avatar_path
                ? asset('storage/'.$profile->avatar_path)
                : 'https://cdn-icons-png.flaticon.com/512/847/847969.png';
        @endphp

        <img src="{{ $avatarUrl }}"
             class="avatar mb-3"
             style="width:120px; height:120px; border-radius:50%; object-fit:cover;">

        <h4 class="fw-bold mb-1">
            {{ $profile->name ?? 'Profil Anda' }}
        </h4>
        {{-- subtitle dikosongkan sesuai permintaan --}}
    </div>

    <div class="text-center mb-4">
        <a href="{{ route('profile.edit') }}"
           class="btn btn-primary px-4 py-2 rounded-pill fw-semibold">
            Edit Profil
        </a>
    </div>

    {{-- Tentang Saya --}}
    <div class="mb-4">
        <h5 class="fw-semibold">Tentang Saya</h5>
        <div class="card-soft p-3">
            @if(!empty($profile->about))
                <p class="m-0">{{ $profile->about }}</p>
            @else
                <p class="text-muted m-0">Belum ada informasi yang ditambahkan.</p>
            @endif
        </div>
    </div>

    {{-- Keterampilan --}}
    <div class="mb-4">
        <h5 class="fw-semibold">Keterampilan</h5>
        @if(!empty($profile->skills) && count($profile->skills))
            <div class="d-flex flex-wrap gap-2">
                @foreach($profile->skills as $skill)
                    <span class="badge bg-primary rounded-pill px-3 py-2">{{ $skill }}</span>
                @endforeach
            </div>
        @else
            <div class="card-soft p-3 text-muted">
                Belum ada keterampilan.
            </div>
        @endif
    </div>

    {{-- Dokumen --}}
    <div class="mb-4">
        <h5 class="fw-semibold">Dokumen</h5>

        @if(!$profile->cv_path && !$profile->resume_path && !$profile->portfolio_path)
            <div class="card-soft p-3 text-muted">
                Belum ada dokumen yang diunggah.
            </div>
        @else
            <div class="d-flex flex-column gap-2">
                @if($profile->cv_path)
                    <a href="{{ asset('storage/'.$profile->cv_path) }}" target="_blank" class="doc-row text-decoration-none text-dark">
                        <strong>CV</strong><br>
                        <small class="text-muted">Daftar riwayat hidup terbaru (PDF)</small>
                    </a>
                @endif
                @if($profile->resume_path)
                    <a href="{{ asset('storage/'.$profile->resume_path) }}" target="_blank" class="doc-row text-decoration-none text-dark">
                        <strong>Resume</strong><br>
                        <small class="text-muted">Ringkasan 1 halaman untuk lamaran kerja</small>
                    </a>
                @endif
                @if($profile->portfolio_path)
                    <a href="{{ asset('storage/'.$profile->portfolio_path) }}" target="_blank" class="doc-row text-decoration-none text-dark">
                        <strong>Portofolio</strong><br>
                        <small class="text-muted">Kumpulan karya & studi kasus</small>
                    </a>
                @endif
            </div>
        @endif
    </div>

        {{-- Logout button below portfolio --}}
        <div class="mb-4 d-flex justify-content-end">
            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#logoutModal">
                Logout
            </button>

            {{-- hidden logout form to be submitted when user confirms --}}
            <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>

        {{-- Logout confirmation modal --}}
        <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin logout dari aplikasi?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" id="confirmLogout" class="btn btn-danger">Logout</button>
                    </div>
                </div>
            </div>
        </div>

</div>
@endsection

@push('body')
<script>
document.addEventListener('DOMContentLoaded', function(){
    const btn = document.getElementById('confirmLogout');
    if (!btn) return;
    btn.addEventListener('click', function(){
        const form = document.getElementById('logoutForm');
        if (form) form.submit();
    });
});
</script>
@endpush
