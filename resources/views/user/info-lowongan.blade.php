@extends('layouts.user')
@section('content')
    <div class="container-lowongan">
        <div class="top-bar">
            <a href="{{route('home')}}" class="back-icon"><i class="bi bi-arrow-left"></i></a>
            <h2 class="judul-halaman">Informasi Lowongan</h2>
            <i class="bi bi-bookmark save-icon" id="saveIcon"></i>
        </div>

        <div class="card-lowongan">
            <div class="header-lowongan">
                <img src="assets/logo.png" alt="Logo" class="logo-lowongan">
                <div>
                    <div class="nama-posisi">Admin Sosial Media</div>
                    <div class="nama-perusahaan">GlobalTrans Indo</div>
                </div>
            </div>

            <div class="section-title">Lowongan tersedia</div>
            <div>Customer Support Specialist</div>

            <div class="section-title">Kategori Pekerjaan</div>
            <div>Fulltime</div>

            <div class="section-title mt-3">Persyaratan Lowongan</div>
                FreshGraduate atau memiliki pengalaman minimal 1th
                Siap bekerja dibawah tekanan
                Pelamar wajib melampirkan dokumen pendukung seperti CV dan Portofolio.
            </div>

            <button class="btn-lamar" onclick="window.location.href='{{ route('lamar.step1') }}'">Lamar Pekerjaan</button>



        </div>
    </div>

    <script>
        const saveIcon = document.getElementById('saveIcon');
        saveIcon.addEventListener('click', () => {
            saveIcon.classList.toggle('bi-bookmark');
            saveIcon.classList.toggle('bi-bookmark-fill');
        });
    </script>
@endsection
