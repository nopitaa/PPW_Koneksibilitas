@extends('layouts.user')

@section('title', 'Materi 3 - Kesalahan Umum & Tips Menjadi Data Analyst yang Lebih Efektif')

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

        <h5 class="text-center mb-4" style="font-weight:600;">Materi 3</h5>

        <p>
        Dalam proses menjadi Data Analyst, banyak pemula yang melakukan beberapa kesalahan yang dapat menghambat proses analisis maupun hasil yang diperoleh. Beberapa kesalahan umum tersebut antara lain:        </p>

        <p>
        1. Terlalu fokus pada tools dan lupa konsep analisis
        Banyak pemula mengejar belajar Python, SQL, atau Power BI, tetapi tidak memahami logika statistik dan analisis.        </p>

        <p>
        2. Mengabaikan data cleaning
        Langsung menganalisis data mentah tanpa memastikan kualitas data.        </p>

        <p>
        3. Tidak memahami konteks bisnis
        Analisis yang bagus tetap tidak berguna jika tidak sesuai dengan kebutuhan perusahaan.        </p>

        <p>
        4. Visualisasi yang rumit dan membingungkan
        Grafik yang tidak jelas membuat insight sulit dipahami.        </p>

    </div>

</div>

@endsection
