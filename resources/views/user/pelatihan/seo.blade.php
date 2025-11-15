@extends('layouts.user')

@section('title', 'Belajar Dasar-Dasar SEO')

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
      <h2 class="fw-bold">Belajar Dasar–Dasar SEO</h2>
      <p class="text-muted mt-3">
        Pelajari cara membuat website mudah ditemukan di Google lewat langkah-langkah sederhana seperti memilih kata kunci
        yang tepat dan mengoptimasi konten. Cocok untuk pemula yang ingin memahami cara kerja mesin pencari dan meningkatkan 
        traffic website.
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
          Materi ini membahas pengertian SEO menurut para ahli dan bagaimana SEO membantu website muncul di halaman pertama Google.
        </p>
        <a href="{{ route('materi1') }}" class="btn btn-primary mt-auto">Baca Materi 1</a>
      </div>
    </div>

    {{-- Materi 2 --}}
    <div class="col-md-4 mb-4">
      <div class="card-soft p-4 h-100 d-flex flex-column">
        <h5 class="fw-semibold">Materi 2</h5>
        <p class="text-muted small flex-grow-1 mt-2">
          Penjelasan mengenai berbagai jenis konten seperti video, blog, artikel, keyword, dan cara optimasinya.
        </p>
        <a href="{{ route('materi2') }}" class="btn btn-primary mt-auto">Baca Materi 2</a>
      </div>
    </div>

    {{-- Materi 3 --}}
    <div class="col-md-4 mb-4">
      <div class="card-soft p-4 h-100 d-flex flex-column">
        <h5 class="fw-semibold">Materi 3</h5>
        <p class="text-muted small flex-grow-1 mt-2">
          Membahas komponen penting SEO seperti on-page, off-page, backlink, crawling, indexing, dan ranking.
        </p>
        <a href="{{ route('materi3') }}" class="btn btn-primary mt-auto">Baca Materi 3</a>
      </div>
    </div>

  </div>
</div>

@endsection
