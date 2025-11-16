@extends('layouts.user')

@section('title', 'Social Media Marketing')

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
      <h2 class="fw-bold">Belajar Social Media Marketing</h2>
      <p class="text-muted mt-3">
      Pelajari bagaimana memanfaatkan berbagai platform media 
      sosial seperti Instagram, TikTok, Facebook untuk membangun 
      brand, meningkatkan engagement, dan menarik lebih banyak 
      pelanggan. Cocok untuk pemula yang ingin memahami strategi 
      pemasaran digital yang efektif dan mudah diterapkan.
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
        Pelajari tujuan utama Social Media Marketing: meningkatkan brand awareness, engagement, traffic, komunitas, hingga konversi dan penjualan.
        </p>
        <a href="{{ route('marketing_materi1') }}" class="btn btn-primary mt-auto">Baca Materi 1</a>
      </div>
    </div>

    {{-- Materi 2 --}}
    <div class="col-md-4 mb-4">
      <div class="card-soft p-4 h-100 d-flex flex-column">
        <h5 class="fw-semibold">Materi 2</h5>
        <p class="text-muted small flex-grow-1 mt-2">
        Kenali strategi dasar dari Belajarlagi seperti riset audiens, pemilihan platform, pembuatan konten menarik, branding konsisten, dan pemanfaatan insight/analytics.
        </p>
        <a href="{{ route('marketing_materi2') }}" class="btn btn-primary mt-auto">Baca Materi 2</a>
      </div>
    </div>

    {{-- Materi 3 --}}
    <div class="col-md-4 mb-4">
      <div class="card-soft p-4 h-100 d-flex flex-column">
        <h5 class="fw-semibold">Materi 3</h5>
        <p class="text-muted small flex-grow-1 mt-2">
        Belajar kesalahan yang sering dilakukan pemula (seperti tidak punya strategi, tidak konsisten, atau terlalu “jualan”), plus tips agar kampanye sosial media lebih efektif.
        </p>
        <a href="{{ route('marketing_materi3') }}" class="btn btn-primary mt-auto">Baca Materi 3</a>
      </div>
    </div>

  </div>
</div>

@endsection
