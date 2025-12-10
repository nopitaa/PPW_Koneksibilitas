    @extends('layouts_perusahaan.master')

    @section('page-title', 'Daftar Lowongan Pekerjaan')

    @section('content')
        <div class="card shadow-lg mx-4 card-profile-top mt-4">
            <div class="card-body p-3">
                <div class="row gx-5">
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1 text-black">Daftar Lowongan Pekerjaan</h5>
                        </div>
                    </div>
                    <div class="col text-end">
                        <a href="{{ url('/tambah-lowongan') }}" class="btn btn-light fw-semibold text-primary border"
                            style="border-color:#0b5ed7">
                            <i class="bi bi-plus-circle me-1"></i> Tambah Lowongan
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid py-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-center border"
                            style="border-collapse: separate; border-spacing: 0;">
                            <thead class="table-success">
                                <tr>
                                    <th class="border-end">No</th>
                                    <th class="border-end">Posisi Lowongan</th>
                                    <th class="border-end">Persyaratan</th>
                                    <th class="border-end">Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($lowongan as $index => $l)
                                    <tr>
                                        <td class="border-end">{{ $index + 1 }}</td>

                                        <td class="border-end">{{ $l->posisi }}</td>

                                        <td class="border-end text-start">
                                            {!!(Str::limit($l->persyaratan, 50)) !!}
                                        </td>

                                        <td class="border-end">{{ $l->kategori_pekerjaan }}</td>

                                        <td>
                                            <a href="{{ url('/detail-lowongan/' . $l->lowongan_id) }}"
                                                class="btn btn-success btn-sm me-1" title="Lihat Detail">
                                                <i class="bi bi-info-circle"></i>
                                            </a>

                                            <a href="{{ route('edit-lowongan', $l->lowongan_id) }}"
                                                class="btn btn-warning btn-sm me-1 text-white" title="Edit Data">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            <button class="btn btn-danger btn-sm" title="Hapus Data">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">Belum ada lowongan</td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection
