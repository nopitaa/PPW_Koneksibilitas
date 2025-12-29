@extends('layouts.user')

@section('content')
<div class="container mt-3">

    <h3 class="fw-semibold mb-4">Lowongan Tersimpan</h3>

    @if ($lowongan->isEmpty())
        <div class="text-muted text-center">
            Belum ada lowongan yang disimpan
        </div>
    @else
        @foreach ($lowongan as $item)
            <div class="card-soft p-3 mb-3 d-flex align-items-center justify-content-between">

                {{-- KIRI: Logo + Info --}}
                <div class="d-flex align-items-center gap-3">
                    <img src="{{ asset('assets/img/logoperusahaan.png') }}"
                         alt="Logo Perusahaan"
                         width="42"
                         height="42"
                         class="rounded-circle bg-light p-1">

                    <div>
                        <div class="fw-semibold" style="font-size: 0.9rem;">
                            {{ $item->posisi }}
                        </div>
                        <div class="text-muted" style="font-size: 0.8rem;">
                            {{ optional($item->perusahaan)->nama_perusahaan }}
                        </div>
                    </div>
                </div>

                {{-- KANAN: Tombol Lamar --}}
                <a href="{{ route('lamar.step1', ['lowongan' => $item->lowongan_id]) }}"
                   class="btn btn-primary rounded-pill px-4"
                   style="font-size: 0.8rem; padding: 6px 14px;">
                    Lamar
                </a>

            </div>
        @endforeach
    @endif

</div>
@endsection
