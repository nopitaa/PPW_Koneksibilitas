@extends('layouts.user')

@section('title', 'Beranda - Koneksibilitas')

@section('content')

    {{-- HERO --}}
    <section class="text-center py-4 px-4">
        <h1 class="text-3xl fw-bold">
            Gunakan Kesempatanmu <span class="text-primary">Di Koneksibilitas</span>
        </h1>
        <p class="text-muted mt-2">
            Temukan lowongan pekerjaan yang tersedia untuk kamu
        </p>
    </section>

    {{-- REKOMENDASI --}}
    <section class="mt-5">


        <div class="row g-4">

            <div class="row" id="lowongan-list">
                @foreach ($data as $index => $item)
                    <div class="col-md-4 mb-4 lowongan-item {{ $index >= 6 ? 'd-none' : '' }}">
                        <div class="card-soft p-4 text-center h-100">
                            <img src="{{ asset('assets/img/logoperusahaan.png') }}" class="w-25 mx-auto mb-3"
                                alt="">

                            <h5 class="fw-semibold">
                                {{ $item->posisi }}
                            </h5>

                            <p class="text-muted small mb-3">
                                {{ $item->perusahaan->nama_perusahaan }}
                            </p>

                            <a href="{{ route('lowongan.detail', $item->lowongan_id) }}" class="btn btn-primary w-100">
                                Info
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Button Baca Selengkapnya --}}
            @if (count($data) > 6)
                <div class="text-center mt-3">
                    <button class="btn btn-outline-primary" id="btnShowAll">
                        Baca Selengkapnya
                    </button>
                </div>
            @endif
            <script>
                document.getElementById('btnShowAll')?.addEventListener('click', function() {
                    document.querySelectorAll('.lowongan-item').forEach(item => {
                        item.classList.remove('d-none');
                    });

                    this.style.display = 'none';
                });
            </script>


        </div>
    </section>

    {{-- PELATIHAN --}}
    <section class="mt-5 mb-5">
        <h2 class="h5 fw-semibold mb-3">Pelatihan Online</h2>

        <div class="row g-4">

            {{-- SEO --}}
            <div class="col-md-3">
                <div class="card-soft overflow-hidden h-100 d-flex flex-column">
                    <img src="{{ asset('assets/img/logopelatihan.png') }}" class="w-100" alt="">
                    <div class="p-3 d-flex flex-column flex-grow-1">
                        <h6 class="fw-semibold">Belajar dasar-dasar SEO</h6>
                        <p class="text-muted small flex-grow-1">
                            Kelas memahami konsep dasar Search Engine Optimization (SEO)
                        </p>
                        <a href="{{ route('seo') }}" class="btn btn-primary w-100 btn-sm mt-auto">
                            Ikuti Pelatihan
                        </a>
                    </div>
                </div>
            </div>

            {{-- Social Media Marketing --}}
            <div class="col-md-3">
                <div class="card-soft overflow-hidden h-100 d-flex flex-column">
                    <img src="{{ asset('assets/img/logopelatihan.png') }}" class="w-100" alt="">
                    <div class="p-3 d-flex flex-column flex-grow-1">
                        <h6 class="fw-semibold">Social Media Marketing</h6>
                        <p class="text-muted small flex-grow-1">
                            Kelas ini membahas strategi social media marketing
                        </p>
                        <a href="{{ route('marketing') }}" class="btn btn-primary w-100 btn-sm mt-auto">
                            Ikuti Pelatihan
                        </a>
                    </div>
                </div>
            </div>

            {{-- Copywriting --}}
            <div class="col-md-3">
                <div class="card-soft overflow-hidden h-100 d-flex flex-column">
                    <img src="{{ asset('assets/img/logopelatihan.png') }}" class="w-100" alt="">
                    <div class="p-3 d-flex flex-column flex-grow-1">
                        <h6 class="fw-semibold">Copywriting untuk Pemula</h6>
                        <p class="text-muted small flex-grow-1">
                            Kelas ini membahas cara membuat tulisan persuasif untuk iklan.
                        </p>
                        <a href="{{ route('copywritting') }}" class="btn btn-primary w-100 btn-sm mt-auto">
                            Ikuti Pelatihan
                        </a>
                    </div>
                </div>
            </div>

            {{-- Data Analyst --}}
            <div class="col-md-3">
                <div class="card-soft overflow-hidden h-100 d-flex flex-column">
                    <img src="{{ asset('assets/img/logopelatihan.png') }}" class="w-100" alt="">
                    <div class="p-3 d-flex flex-column flex-grow-1">
                        <h6 class="fw-semibold">Dasar-Dasar Data Analyst</h6>
                        <p class="text-muted small flex-grow-1">
                            Kelas ini membahas konsep data, serta pengantar tools seperti Google Sheet.
                        </p>
                        <a href="{{ route('dataanalyst') }}" class="btn btn-primary w-100 btn-sm mt-auto">
                            Ikuti Pelatihan
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Cek apakah ada session "success" yang dikirim dari Login
        @if (session('success'))
            Swal.fire({
                title: "Login Berhasil",
                text: "{{ session('success') }}", // Mengambil pesan dari Controller
                icon: "success"
            });
        @endif
    </script>

@endsectionE
