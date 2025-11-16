@extends('layouts.user')

@section('title', 'Materi 1 - Pengenalan Data Analyst & Peran Pentingnya dalam Bisnis')

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

        <h5 class="text-center mb-4" style="font-weight:600;">Materi 1</h5>

        <p>
            Data Analyst adalah profesi yang bertugas mengolah, menganalisis, dan 
            menginterpretasikan data dari berbagai sumber seperti database, laporan bisnis, 
            hingga aktivitas pengguna untuk mendapatkan insight yang membantu pengambilan keputusan 
            yang lebih akurat dan strategis.
        </p>

        <p>
            Tujuan utama dari Data Analyst meliputi mengubah data mentah menjadi informasi yang 
            bermakna, menemukan pola atau tren penting, mendukung pengambilan keputusan berbasis data, 
            meningkatkan efisiensi proses bisnis, hingga membantu perusahaan menentukan strategi yang 
            lebih tepat dan terukur.        </p>

        <p>
            Dalam Data Analysis, data adalah elemen paling penting. Data yang lengkap, akurat, 
            dan terstruktur dengan baik akan menghasilkan analisis yang lebih tepat, mempermudah 
            menemukan pola, serta membantu perusahaan memahami kondisi bisnis secara lebih jelas.        
        </p>

        <p>
            Selain itu, pemahaman terhadap metode analisis dan cara kerja berbagai model 
            data juga penting. Teknik dan algoritma analisis akan mengolah data untuk menampilkan 
            informasi yang relevan dan akurat. Karena itu, kualitas data, proses pembersihan data, 
            serta pemilihan metode analisis yang tepat sangat berpengaruh terhadap hasil akhir.        
        </p>

        <p>
            Pada materi pertama ini, kamu akan mempelajari dasar-dasar Data Analysis, bagaimana 
            data dapat memberikan insight penting untuk bisnis, serta bagaimana membangun fondasi 
            analisis yang kuat melalui pengolahan, pembersihan, dan interpretasi data yang tepat.        
        </p>

    </div>

</div>

@endsection
