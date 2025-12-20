@extends('admin.layout')

@section('content')
<div class="container">
    <h4 class="fw-bold mb-4" style="color: #007bff;">
        Daftar Pengajuan Lowongan
    </h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- FORM PENCARIAN --}}
    <form method="GET" action="{{ route('dashboard') }}" class="mb-3">
        <div class="row g-2">
            <div class="col-md-4">
                <input type="text" name="keyword"
                    class="form-control form-control-sm"
                    placeholder="Cari nama perusahaan / posisi"
                    value="{{ request('keyword') }}">
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary btn-sm w-100">Cari</button>
            </div>
        </div>
    </form>

    {{-- TABEL --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Lowongan</th>
                <th>Nama Perusahaan</th>
                <th>Posisi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($lowongans as $lowongan)
                <tr>
                    <td>{{ $lowongan->lowongan_id }}</td>
                    <td>{{ $lowongan->perusahaan->nama_perusahaan ?? '-' }}</td>
                    <td>{{ $lowongan->posisi }}</td>
                    <td>
                        @if($lowongan->approved_at)
                            <span class="badge bg-success">
                                Disetujui
                            </span>
                        @else
                            <form action="{{ route('lowongan.approve', $lowongan->lowongan_id) }}"
                                method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-success btn-sm">
                                    Setujui
                                </button>
                            </form>

                            <form action="{{ route('lowongan.reject', $lowongan->lowongan_id) }}"
                                method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-danger btn-sm">
                                    Tolak
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">
                        Tidak ada pengajuan lowongan
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
