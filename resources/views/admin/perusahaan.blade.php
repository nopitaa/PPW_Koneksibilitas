@extends('layout')

@section('content')
<div class="container">
    <h4 class="fw-bold mb-4" style="color: #007bff;">Daftar Pengajuan Lowongan</h4>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr style="font-size: 14px;">
                <th>ID Perusahaan</th>
                <th>Nama Perusahaan</th>
                <th>Jabatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($companies as $company)
                <tr style="font-size: 14px;">
                    <td>{{ $company->company_id }}</td>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->position }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Belum ada perusahaan disetujui.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
