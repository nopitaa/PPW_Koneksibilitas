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

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Perusahaan</th>
                <th>Nama Perusahaan</th>
                <th>Posisi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($companies as $company)
                <tr>
                    <td>{{ $company->company_id }}</td>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->position }}</td>
                    <td>
                        <form action="{{ route('companies.approve', $company->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-success btn-sm">Setujui</button>
                        </form>

                        <form action="{{ route('companies.reject', $company->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-danger btn-sm">Tolak</button>
                        </form>
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
