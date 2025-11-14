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
                                <tr>
                                    <td class="border-end">1</td>
                                    <td class="border-end">Backend Engineer</td>
                                    <td class="border-end text-start">
                                        - Mahir PHP dan Laravel<br>
                                        - Menguasai REST API<br>
                                        - Minimal pengalaman 1 tahun
                                    </td>
                                    <td class="border-end">Full Time</td>
                                    <td>
                                        <a href="{{ url('/detail-lowongan') }}" class="btn btn-success btn-sm me-1"
                                            title="Lihat Detail">
                                            <i class="bi bi-info-circle"></i>
                                        </a>
                                        <a href="{{ url('/edit-lowongan') }}" class="btn btn-warning btn-sm me-1 text-white"
                                            title="Edit Data">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button class="btn btn-danger btn-sm" title="Hapus Data">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="border-end">2</td>
                                    <td class="border-end">UI/UX Designer</td>
                                    <td class="border-end text-start">
                                        - Paham prinsip desain UI/UX<br>
                                        - Bisa Figma<br>
                                        - Kreatif dan komunikatif
                                    </td>
                                    <td class="border-end">Remote</td>
                                    <td>
                                        <a href="{{ url('/detail-lowongan') }}" class="btn btn-success btn-sm me-1"
                                            title="Lihat Detail">
                                            <i class="bi bi-info-circle"></i>
                                        </a>
                                        <a href="{{ url('/edit-lowongan') }}" class="btn btn-warning btn-sm me-1 text-white"
                                            title="Edit Data">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button class="btn btn-danger btn-sm" title="Hapus Data">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection
