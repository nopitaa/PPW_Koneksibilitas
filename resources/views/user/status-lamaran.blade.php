@extends('layouts.user')

@section('title', 'Status Lamaran - Koneksibilitas')

@section('content')
    <section class="mt-4 px-4">
        @php $currentStatus = request('status', 'Semua'); @endphp

        <div class="d-flex border-bottom pb-2 mb-4 overflow-auto">
            {{-- Link untuk Semua --}}
            <a href="{{ route('status.lamaran', ['status' => 'Semua']) }}" 
               class="nav-link me-4 {{ $currentStatus == 'Semua' ? 'text-dark fw-bold border-bottom border-primary border-3 pb-2' : 'text-muted' }}">
               Semua
            </a>

            {{-- Link untuk Terkirim --}}
            <a href="{{ route('status.lamaran', ['status' => 'Terkirim']) }}" 
               class="nav-link me-4 {{ $currentStatus == 'Terkirim' ? 'text-dark fw-bold border-bottom border-primary border-3 pb-2' : 'text-muted' }}">
               Terkirim
            </a>

            {{-- Link untuk Diproses --}}
            <a href="{{ route('status.lamaran', ['status' => 'Diproses']) }}" 
               class="nav-link me-4 {{ $currentStatus == 'Diproses' ? 'text-dark fw-bold border-bottom border-primary border-3 pb-2' : 'text-muted' }}">
               Diproses
            </a>

            {{-- Link untuk Ditolak --}}
            <a href="{{ route('status.lamaran', ['status' => 'Ditolak']) }}" 
               class="nav-link me-4 {{ $currentStatus == 'Ditolak' ? 'text-dark fw-bold border-bottom border-primary border-3 pb-2' : 'text-muted' }}">
               Ditolak
            </a>
        </div>
    </section>

    {{-- LIST STATUS LAMARAN --}}
    <section class="px-4 mb-5">
        <div class="row">
            @forelse ($data as $item)
                <div class="col-12 mb-3">
                    <div class="card border-0 shadow-sm rounded-4 p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded-3 p-2 me-3" style="width: 50px; height: 50px;">
                                    <img src="{{ asset('assets/img/logoperusahaan.png') }}" class="img-fluid" alt="logo">
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0">{{ $item->lowongan->posisi }}</h6>
                                    <small class="text-muted">{{ $item->lowongan->perusahaan->nama_perusahaan }}</small>
                                </div>
                            </div>
                            <div>
                                @if($item->status == 'Terkirim')
                                    <span class="badge rounded-pill px-3 py-2" style="background-color: #E3F2FD; color: #2196F3;">Terkirim</span>
                                @elseif($item->status == 'Diproses')
                                    <span class="badge rounded-pill px-3 py-2" style="background-color: #E8F5E9; color: #4CAF50;">Diproses</span>
                                @elseif($item->status == 'Ditolak')
                                    <span class="badge rounded-pill px-3 py-2" style="background-color: #FFEBEE; color: #F44336;">Ditolak</span>
                                @else
                                    <span class="badge bg-secondary rounded-pill px-3 py-2">{{ $item->status }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Tidak ada lamaran dengan status "{{ $currentStatus }}".</p>
                    @if($currentStatus !== 'Semua')
                        <a href="{{ route('status.lamaran') }}" class="btn btn-outline-primary btn-sm">Lihat Semua Lamaran</a>
                    @else
                        <a href="{{ route('home') }}" class="btn btn-primary">Cari Lowongan</a>
                    @endif
                </div>
            @endforelse
        </div>
    </section>
@endsection