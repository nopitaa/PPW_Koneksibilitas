@extends('layouts.user')

@section('title', 'Pelajari Data Analyst')

@section('content')

<div class="container py-4">

  {{-- Tombol Back --}}
  <a href="{{ route('home') }}" 
     class="text-decoration-none mb-4 d-inline-block" 
     style="margin-top: 10px; margin-left: 5px;">
      <i class="bi bi-arrow-left fs-4"></i> 
  </a>

  {{-- HERO SECTION --}}
  <div class="row align-items-center" style="margin-top: 30px; margin-bottom: 60px;">
    <div class="col-md-6">
      <img src="{{ asset('assets/img/logopelatihan.png') }}" class="w-100 rounded shadow-sm" alt="">
    </div>

    <div class="col-md-6 ps-md-5">
      <h2 class="fw-bold">Pelajari Data Analyst</h2>
      <p class="text-muted mt-3">
Pelajari bagaimana mengolah, menganalisis, dan memahami data untuk membantu pengambilan keputusan yang lebih akurat. Cocok untuk pemula yang ingin memasuki dunia data dan memahami konsep dasar seperti data processing, data visualization, hingga basic statistics yang sering digunakan dalam pekerjaan analis data.      </p>
    </div>
  </div>

  {{-- CARD MATERI --}}
  <div class="row mt-4" style="margin-top: 40px !important;">

    {{-- Materi 1 --}}
    <div class="col-md-4 mb-4">
      <div class="card-soft p-4 h-100 d-flex flex-column">
        <h5 class="fw-semibold">Materi 1</h5>
        <p class="text-muted small flex-grow-1 mt-2">
            Pelajari tujuan utama Data Analysis: mengubah data mentah menjadi insight, memahami pola, menemukan anomali, membuat visualisasi yang mudah dibaca, serta membantu perusahaan mengambil keputusan berbasis data.        </p>
        <a href="{{ route('dataanalyst_materi1') }}" class="btn btn-primary mt-auto">Baca Materi 1</a>
      </div>
    </div>

    {{-- Materi 2 --}}
    <div class="col-md-4 mb-4">
      <div class="card-soft p-4 h-100 d-flex flex-column">
        <h5 class="fw-semibold">Materi 2</h5>
        <p class="text-muted small flex-grow-1 mt-2">
            Kenali dasar-dasar penting dalam Data Analysis seperti pengumpulan data, pembersihan data (data cleaning), eksplorasi data (EDA), penggunaan tools seperti Excel, SQL, dan Python, serta memahami cara membaca visualisasi dan membuat laporan analisis.        </p>
        <a href="{{ route('dataanalyst_materi2') }}" class="btn btn-primary mt-auto">Baca Materi 2</a>
      </div>
    </div>

    {{-- Materi 3 --}}
    <div class="col-md-4 mb-4">
      <div class="card-soft p-4 h-100 d-flex flex-column">
        <h5 class="fw-semibold">Materi 3</h5>
        <p class="text-muted small flex-grow-1 mt-2">
            Pelajari kesalahan umum yang sering dilakukan pemula dalam analisis data—seperti salah membaca grafik, tidak melakukan data cleaning, atau menarik kesimpulan terlalu cepat—serta tips agar analisis menjadi lebih akurat, rapi, dan mudah dipahami.        </p>
        <a href="{{ route('dataanalyst_materi3') }}" class="btn btn-primary mt-auto">Baca Materi 3</a>
      </div>
    </div>

  </div>
</div>

@endsection
