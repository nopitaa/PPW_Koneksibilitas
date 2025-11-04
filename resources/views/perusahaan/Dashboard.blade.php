{{-- turunan dari file master, mengadopsi layoutnya --}}
@extends('layouts_perusahaan.master')

{{-- nama halaman, nanti di yield di master --}}
@section('page-title', 'Dashboard Perusahaan')

@section('content')
<div class="row mb-4">
  <div class="col-12">
    <h4 class="fw-bold mb-1 text-white">Hai, Selamat Datang di Dashboard Perusahaan 👋</h4>
    <p class="text-white-50">Berikut aktivitas terbaru dari perusahaan kamu.</p>
  </div>
</div>

<div class="row">
  {{-- Card Jumlah Lowongan --}}
  <div class="col-xl-6 col-sm-6 mb-4">
    <div class="card p-3">
      <div class="row align-items-center">
        <div class="col-8">
          <p class="text-sm mb-0 font-weight-bold">Jumlah Lowongan</p>
          <h5 class="font-weight-bolder">12</h5> 
        </div>
        <div class="col-4 text-end">
          <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle mx-auto">
            <i class="ni ni-briefcase-24 text-white text-m opacity-100"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Card Jumlah Pelamar --}}
  <div class="col-xl-6 col-sm-6 mb-4">
    <div class="card p-3">
      <div class="row align-items-center">
        <div class="col-8">
          <p class="text-sm mb-0 font-weight-bold">Jumlah Pelamar</p>
          <h5 class="font-weight-bolder">58</h5> 
        </div>
        <div class="col-4 text-end">
          <div class="icon icon-shape bg-gradient-success shadow-primary text-center rounded-circle mx-auto">
            <i class="ni ni-single-02 text-white text-m opacity-100"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
