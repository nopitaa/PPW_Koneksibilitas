@extends('layouts.user')

@section('title', 'Copywriting untuk Pemula')

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
      <h2 class="fw-bold">Copywriting untuk Pemula</h2>
      <p class="text-muted mt-3">
        Pelajari bagaimana membuat tulisan yang mampu mempengaruhi, membangun emosi, dan mendorong pembaca untuk mengambil tindakan.
        Copywriting digunakan dalam berbagai bentuk konten seperti caption, iklan, landing page, email marketing, hingga sales page.
        Cocok untuk pemula yang ingin memahami teknik menulis yang persuasif, menarik, dan efektif digunakan dalam pemasaran digital.
      </p>
    </div>
  </div>

  {{-- CARD MATERI --}}
  <div class="row mt-4" style="margin-top: 40px !important;">

    {{-- Materi 1 --}}
    <div class="col-md-4 mb-4">
      <div class="card-soft p-4 h-100 d-flex flex-column">
        <h5 class="fw-semibold">Materi 1</h5>
        <p class="text-muted small flex-grow-1 mt-2">
        Pelajari tujuan utama Copywriting: membangun perhatian, menciptakan ketertarikan, memicu keinginan, dan mendorong tindakan.        </p>
        <a href="{{ route('copywritting_materi1') }}" class="btn btn-primary mt-auto">Baca Materi 1</a>
      </div>
    </div>

    {{-- Materi 2 --}}
    <div class="col-md-4 mb-4">
      <div class="card-soft p-4 h-100 d-flex flex-column">
        <h5 class="fw-semibold">Materi 2</h5>
        <p class="text-muted small flex-grow-1 mt-2">
        Kenali strategi dasar Copywriting seperti memahami audiens secara mendalam, menentukan pesan utama, memilih gaya bahasa yang tepat dan membangun struktur tulisan yang kuat        </p>
        <a href="{{ route('copywritting_materi2') }}" class="btn btn-primary mt-auto">Baca Materi 2</a>
      </div>
    </div>

    {{-- Materi 3 --}}
    <div class="col-md-4 mb-4">
      <div class="card-soft p-4 h-100 d-flex flex-column">
        <h5 class="fw-semibold">Materi 3</h5>
        <p class="text-muted small flex-grow-1 mt-2">
        Pelajari kesalahan umum yang sering dilakukan pemula dalam copywriting — seperti penggunaan kalimat yang bertele-tele, pesan yang tidak jelas, terlalu fokus pada penjualan, atau tidak memahami kebutuhan audiens        </p>
        <a href="{{ route('copywritting_materi3') }}" class="btn btn-primary mt-auto">Baca Materi 3</a>
      </div>
    </div>

  </div>
</div>

@endsection
