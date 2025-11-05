@extends('admin.layout')

@section('content')
<div class="container-fluid" style="background-color: #f5f9ff; min-height: 100vh; padding: 30px;">
    <div class="mx-auto p-4 shadow-sm" style="max-width: 95%; background-color: white; border-radius: 16px;">

        <h4 class="fw-bold mb-4" style="color: #007bff;">Daftar Pengajuan Lowongan</h4>

        {{-- Notifikasi --}}
        @if(session('success'))
            <div class="alert alert-success small">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger small">{{ session('error') }}</div>
        @endif

        {{-- Filter Bar (vertikal) --}}
        <form method="GET" action="{{ route('dashboard') }}" class="mb-4">
          <div class="row align-items-end">
              <div class="col-md-4 mb-2">
                  <label class="form-label mb-1">ID Perusahaan</label>
                  <input 
                      type="text" 
                      name="company_id" 
                      class="form-control form-control-sm" 
                      placeholder="Masukkan ID Perusahaan"
                      value="{{ request('company_id') }}"
                  >
              </div>

              <div class="col-md-4 mb-2">
                  <label class="form-label mb-1">Status</label>
                  <select name="status" class="form-select form-select-sm">
                      <option {{ request('status') == 'Semua' ? 'selected' : '' }}>Semua</option>
                      <option value="Pengajuan" {{ request('status') == 'Pengajuan' ? 'selected' : '' }}>Pengajuan</option>
                      <option value="Disetujui" {{ request('status') == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                      <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                  </select>
              </div>

              <div class="col-md-4 mb-2 d-flex justify-content-end">
                  <div class="d-flex w-50 gap-2">
                      <button type="submit" class="btn btn-primary btn-sm w-50">Cari</button>
                      <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-sm w-50">Reset</a>
                  </div>
              </div>
          </div>
      </form>



        {{-- Tabel Data --}}
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle mb-0">
                <thead style="background-color: #007bff; color: white;">
                    <tr style="font-size: 14px;">
                        <th>ID Perusahaan</th>
                        <th>Nama Perusahaan</th>
                        <th>Jabatan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($companies as $company)
                    <tr style="font-size: 14px;">
                        <td>{{ $company->company_id }}</td>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->position }}</td>
                        <td>
                            @if($company->status == 'Pengajuan')
                                <span class="badge bg-warning text-dark">Pengajuan</span>
                            @elseif($company->status == 'Ditolak')
                                <span class="badge bg-danger">Ditolak</span>
                            @elseif($company->status == 'Disetujui')
                                <span class="badge bg-success">Disetujui</span>
                            @endif
                        </td>
                        <td>
                            @if(in_array($company->status, ['Pengajuan', 'Ditolak']))
                                <form action="{{ route('companies.approve', $company->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Setuju</button>
                                </form>
                                <form action="{{ route('companies.reject', $company->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                </form>
                            @else
                                <span class="text-muted small">Sudah {{ $company->status }}</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
