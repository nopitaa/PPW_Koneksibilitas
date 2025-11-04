@extends('layouts.user')

@section('content')
<div class="container-lowongan my-4">
    <div class="top-bar d-flex align-items-center mb-4">
        <a href="{{ route('home') }}" class="back-icon me-3"><i class="bi bi-arrow-left"></i></a>
        <h2 class="judul-halaman mb-0">Lowongan Tersimpan</h2>
    </div>

    {{-- Daftar Lowongan --}}
    <div class="list-group">
        @foreach ($jobs as $job)
        <div class="card card-lowongan mb-3 border-0 shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('company-icon.png') }}" alt="Logo" width="40" class="me-3 rounded-circle">
                    <div>
                        <h6 class="mb-1 fw-semibold">{{ $job['title'] }}</h6>
                        <small class="text-muted">{{ $job['company'] }}</small>
                    </div>
                </div>
                <button class="btn btn-primary btn-sm px-3" onclick="window.location.href='{{ route('lamar.step1') }}'">
                    Lamar
                </button>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    const saveIcon = document.getElementById('saveIcon');
    if (saveIcon) {
        saveIcon.addEventListener('click', () => {
            saveIcon.classList.toggle('bi-bookmark');
            saveIcon.classList.toggle('bi-bookmark-fill');
        });
    }
</script>
@endsection
