@extends('layouts.user')

@section('content')
<h3 class="fw-semibold mb-4">Lowongan Tersimpan</h3>

@if ($lowongan->isEmpty())
    <div class="text-muted">Belum ada lowongan yang disimpan</div>
@else
    @foreach ($lowongan as $item)
        <div class="card-soft p-3 mb-3 d-flex align-items-center justify-content-between">

            {{-- KIRI: Logo + Info --}}
            <div class="d-flex align-items-center gap-3">
                <img src="{{ asset('assets/img/logoperusahaan.png') }}"
                     alt="Logo"
                     width="42"
                     height="42"
                     class="rounded-circle">

                <div>
                    <div class="fw-medium small">
                        {{ $item->posisi }}
                    </div>
                    <div class="text-muted" style="font-size: 0.8rem;">
                        {{ optional($item->perusahaan)->nama_perusahaan }}
                    </div>
                </div>
            </div>

            {{-- KANAN: Tombol --}}
            <a href="{{ route('lamar.step1', $item->lowongan_id) }}"
               class="btn btn-primary rounded-pill px-4"
               style="font-size: 0.8rem; padding-top:6px; padding-bottom:6px;">
                Lamar
            </a>

        </div>
    @endforeach
@endif
@endsection
