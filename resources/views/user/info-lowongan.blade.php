@extends('layouts.user')

@section('content')
<style>.container-lowongan {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

/* Top Bar */
.top-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
}

.back-icon {
    font-size: 1.3rem;
    color: #333;
}

.judul-halaman {
    font-size: 1.2rem;
    font-weight: 600;
    margin: 0;
}

.save-icon {
    font-size: 1.4rem;
    cursor: pointer;
    color: #0d6efd;
}

/* Card */
.card-lowongan {
    background: #fff;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.06);
}

/* Header */
.header-lowongan {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 20px;
}

.header-lowongan img {
    width: 80px;
    height: 80px;
    object-fit: contain;
    border-radius: 12px;
    background: #f8f9fa;
    padding: 10px;
}

.nama-posisi {
    font-size: 1.1rem;
    font-weight: 600;
}

.nama-perusahaan {
    font-size: 0.95rem;
    color: #6c757d;
}

/* Content */
.content-lowongan {
    margin-top: 10px;
}

.section {
    margin-bottom: 16px;
}

.section-title {
    font-weight: 600;
    font-size: 0.95rem;
    margin-bottom: 4px;
    color: #343a40;
}

.section-content {
    font-size: 0.95rem;
    color: #555;
    line-height: 1.6;
}

/* Button */
.btn-lamar {
    width: 100%;
    margin-top: 24px;
    padding: 14px;
    border: none;
    border-radius: 12px;
    background: #0d6efd;
    color: #fff;
    font-size: 1rem;
    font-weight: 600;
    transition: 0.3s;
}

.btn-lamar:hover {
    background: #0b5ed7;
}
</style>
<div class="container-lowongan">

    <!-- Top Bar -->
    <div class="top-bar">
        <a href="{{ url()->previous() ?? route('home') }}" class="back-icon">
        <i class="bi bi-arrow-left"></i>
        </a>

        <h2 class="judul-halaman">Informasi Lowongan</h2>
        <i class="bi bi-bookmark save-icon" id="saveIcon"></i>
    </div>

    <!-- Card Lowongan -->
    <div class="card-lowongan">

        <div class="header-lowongan">
            <img src="{{ asset('assets/img/logoperusahaan.png') }}" alt="Logo">
            <div class="header-text">
                <div class="nama-posisi">{{ $lowongan->posisi }}</div>
                <div class="nama-perusahaan">
                    {{ optional($lowongan->perusahaan)->nama_perusahaan }}
                </div>
            </div>
        </div>

        <div class="content-lowongan">
            <div class="section">
                <div class="section-title">Lowongan tersedia</div>
                <div class="section-content">{{ $lowongan->posisi }}</div>
            </div>

            <div class="section">
                <div class="section-title">Kategori Pekerjaan</div>
                <div class="section-content">{{ $lowongan->kategori_pekerjaan }}</div>
            </div>

            <div class="section">
                <div class="section-title">Persyaratan Lowongan</div>
                <div class="section-content">
                    {!! ($lowongan->persyaratan) !!}
                </div>
            </div>
        </div>
    </div>

    <button class="btn-lamar"
        onclick="window.location.href='{{ route('lamar.step1') }}'">
        Lamar Pekerjaan
    </button>

</div>

<script>
    const saveIcon = document.getElementById('saveIcon');
    saveIcon.addEventListener('click', () => {
        saveIcon.classList.toggle('bi-bookmark');
        saveIcon.classList.toggle('bi-bookmark-fill');
    });
</script>
@endsection
