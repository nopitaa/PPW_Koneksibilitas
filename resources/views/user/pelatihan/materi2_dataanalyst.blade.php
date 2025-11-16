@extends('layouts.user')

@section('title', 'Materi 2 - Strategi & Teknik Dasar dalam Analisis Data')

@section('content')

<div class="container py-3">

    {{-- Back Button --}}
    <a href="{{ route('dataanalyst') }}" class="text-decoration-none mb-3 d-inline-flex align-items-center"
       style="font-size: 15px;">
        <i class="bi bi-arrow-left me-1"></i> 
    </a>

    {{-- Content Card --}}
    <div class="card shadow-sm p-4"
         style="max-width: 850px; margin:auto; border-radius:14px; border:1px solid #eee;">

        <h5 class="text-center mb-4" style="font-weight:600;">Materi 2</h5>

        <p>
            Pada tahap ini, kamu akan mulai memahami strategi dasar yang digunakan Data Analyst dalam bekerja. Proses analisis data biasanya mencakup beberapa langkah utama seperti:
        <p>
            1. Mengumpulkan Data
            Data dapat berasal dari berbagai sumber seperti database, API, laporan internal, survei, spreadsheet, hingga log aktivitas pengguna.
        <p>
            2. Membersihkan dan Menyiapkan Data
            Tahapan ini mencakup menghapus duplikasi, memperbaiki format, menangani data kosong (missing value), dan memastikan data dapat diproses dengan benar.
        <p>
            3. Menganalisis Data
            Teknik analisis dapat berupa statistik dasar, segmentasi, korelasi, pengelompokan, hingga penggunaan model prediktif sederhana.
        <p>
            4. Menginterpretasikan Temuan
            Data Analyst tidak hanya mencari angka—mereka harus dapat menjelaskan makna dari hasil analisis tersebut.
    </div>

</div>

@endsection
