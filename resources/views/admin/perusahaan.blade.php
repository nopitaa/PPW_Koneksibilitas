@extends('admin.layout')

@section('content')
<div class="container">
    <h4 class="fw-bold mb-4" style="color: #007bff;">
        Daftar Lowongan Disetujui
    </h4>

    <table class="table table-bordered mt-3">
        <thead>
            <tr style="font-size: 14px;">
                <th>ID Perusahaan</th>
                <th>Nama Perusahaan</th>
                <th>Jabatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($lowongans as $company)
                <tr style="font-size: 14px;">
                    <td>{{ $company->perusahaan->perusahaan_id }}</td>
                    <td>{{ $company->perusahaan->nama_perusahaan }}</td>
                    <td>{{ $company->posisi }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">
                        Belum ada lowongan yang disetujui
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
