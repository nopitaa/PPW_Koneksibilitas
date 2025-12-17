@extends('layouts.user')

@section('title', 'Lowongan Tersimpan')

@section('content')

<h2 class="fw-semibold mb-4">Informasi Lowongan</h2>

<div class="d-flex flex-column gap-3">

  @foreach ($lowongan as $item)
    <a href="{{ route('lowongan.detail', $item->lowongan_id) }}"
    class="text-decoration-none text-dark">

    <div class="card-soft px-4 py-3">
        <div class="d-flex align-items-center justify-content-between">

        <div class="d-flex align-items-center gap-3">
            <img src="{{ asset('assets/img/logoperusahaan.png') }}"
                width="40" height="40" class="rounded-circle">

            <div>
            <div class="fw-semibold small">
                {{ $item->posisi }}
            </div>
            <div class="text-muted small">
                {{ $item->perusahaan->nama_perusahaan ?? 'Perusahaan' }}
            </div>
            </div>
        </div>

        <span class="btn btn-sm btn-outline-primary rounded-pill px-3">
            Lamar
        </span>

        </div>
    </div>

    </a>
    @endforeach


</div>

@endsection
