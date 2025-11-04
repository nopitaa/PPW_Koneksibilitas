@extends('layouts.user')

@section('title', 'Beranda - Koneksibilitas')

{{-- Optional: kalau mau muncul search bar di navbar --}}
@section('search')
  <input type="text" placeholder="Cari pekerjaan..." class="search-input" />
@endsection

@section('content')
  <section class="text-center py-4 px-4">
    <h1 class="text-3xl fw-bold">
      Gunakan Kesempatanmu <span class="text-primary">Di Koneksibilitas</span>
    </h1>
    <p class="text-muted mt-2">
      Saatnya tunjukkan kemampuanmu dan dapatkan peluang kerja yang setara.
    </p>
  </section>

  <section class="mt-5">
    <h2 class="h5 fw-semibold mb-3">Rekomendasi untuk kamu</h2>
    <div class="row g-4">

      <div class="col-md-4">
        <div class="card-soft p-4 text-center">
          <img src="{{ asset('assets/img/logoperusahaan.png') }}" class="w-25 mx-auto mb-3" alt="">
          <h5 class="fw-semibold">Admin Sosial Media</h5>
          <p class="text-muted small mb-3">GlobalTrans Indo · Full-time</p>
          <a href="{{route('info_lowongan')}}" class="btn btn-primary w-100">Info</a>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card-soft p-4 text-center">
          <img src="{{ asset('assets/img/logoperusahaan.png') }}" class="w-25 mx-auto mb-3" alt="">
          <h5 class="fw-semibold">Desain Grafis</h5>
          <p class="text-muted small mb-3">GlobalTrans Indo · Full-time</p>
          <a href="{{route('info_lowongan')}}" class="btn btn-primary w-100">Info</a>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card-soft p-4 text-center">
          <img src="{{ asset('assets/img/logoperusahaan.png') }}" class="w-25 mx-auto mb-3" alt="">
          <h5 class="fw-semibold">Copy Writing</h5>
          <p class="text-muted small mb-3">GlobalTrans Indo · Full-time</p>
          <a href="{{route('info_lowongan')}}" class="btn btn-primary w-100">Info</a>
        </div>
      </div>

    </div>
  </section>

  <section class="mt-5 mb-5">
    <h2 class="h5 fw-semibold mb-3">Pelatihan Online</h2>
    <div class="row g-4">

      <div class="col-md-3">
        <div class="card-soft overflow-hidden">
          <img src="{{ asset('assets/img/logopelatihan.png') }}" class="w-100" alt="">
          <div class="p-3">
            <h6 class="fw-semibold">Belajar dasar-dasar SEO</h6>
            <p class="text-muted small">Kelas memahami konsep dasar Search Engine Optimization (SEO)</p>
            <button class="btn btn-primary w-100 btn-sm">Ikuti Pelatihan</button>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card-soft overflow-hidden">
          <img src="{{ asset('assets/img/logopelatihan.png') }}" class="w-100" alt="">
          <div class="p-3">
            <h6 class="fw-semibold">Desain Grafis untuk Pemula</h6>
            <p class="text-muted small">Pelajari dasar desain visual dengan tools populer</p>
            <button class="btn btn-primary w-100 btn-sm">Ikuti Pelatihan</button>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card-soft overflow-hidden">
          <img src="{{ asset('assets/img/logopelatihan.png') }}" class="w-100" alt="">
          <div class="p-3">
            <h6 class="fw-semibold">Copywriting yang Menjual</h6>
            <p class="text-muted small">Teknik menulis iklan yang menarik perhatian pembaca</p>
            <button class="btn btn-primary w-100 btn-sm">Ikuti Pelatihan</button>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card-soft overflow-hidden">
          <img src="{{ asset('assets/img/logopelatihan.png') }}" class="w-100" alt="">
          <div class="p-3">
            <h6 class="fw-semibold">Dasar-Dasar Digital Marketing</h6>
            <p class="text-muted small">Kuasai strategi pemasaran digital efektif untuk bisnis</p>
            <button class="btn btn-primary w-100 btn-sm">Ikuti Pelatihan</button>
          </div>
        </div>
      </div>

    </div>
  </section>
@endsection
